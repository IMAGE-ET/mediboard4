<?php
/**
 * $Id: CLDAP.class.php 20359 2013-09-12 11:07:19Z kgrisel $
 *
 * @package    Mediboard
 * @subpackage admin
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20359 $
 */

/**
 * LDAP authentication class
 */
class CLDAP {
  /**
   * Log a user in
   *
   * @param CUser  $user      The user logging in
   * @param string $ldap_guid The user's LDAP GUID
   *
   * @return CUser The user
   */
  static function login(CUser $user, $ldap_guid) {
    if (!$ldap_guid || $user->_user_password) {
      $source_ldap = self::bind($user);
    }
    else {
      $ldaprdn  = CAppUI::conf("admin LDAP ldap_user");
      $ldappass = CAppUI::conf("admin LDAP ldap_password");
      
      $source_ldap = self::bind($user, $ldaprdn, $ldappass);
    }

    // Login succesful
    if ($user->_bound) {
      $user = self::searchAndMap($user, $source_ldap, $source_ldap->_ldapconn);
      CAppUI::$instance->auth_method = "ldap";
    }

    return $user;
  }

  /**
   * @throws CMbException
   * @return CSourceLDAP
   */
  static function connect() {
    $source_ldap = new CSourceLDAP();

    /** @var CSourceLDAP[] $sources_ldap */
    $sources_ldap = $source_ldap->loadList(null, "priority DESC");

    if (empty($sources_ldap)) {
      throw new CMbException("CSourceLDAP_undefined");
    }

    foreach ($sources_ldap as $_source) {
      try {
        $ldapconn = $_source->ldap_connect();
        $_source->_ldapconn = $ldapconn;
        return $_source;
      }
      catch(CMbException $e) {
        CAppUI::setMsg($e->getMessage(), UI_MSG_WARNING);
      }
    }

    return false;
  }

  /**
   * Binds a user to the LDAP server
   *
   * @param CUser $user     The user to bind to the LDAP server
   * @param null  $ldaprdn  Relative Distinguished Name
   * @param null  $ldappass LDAP password
   *
   * @throws CMbException
   * @return CSourceLDAP
   */
  static function bind(CUser $user = null, $ldaprdn = null, $ldappass = null) {
    $source_ldap = CLDAP::connect();

    if (!$source_ldap) {
      throw new CMbException("CSourceLDAP_all-unreachable", "ANY");
    }

    $ldapconn = $source_ldap->_ldapconn;

    if (!$ldaprdn) {
      $ldaprdn  = $user->user_username;
    }

    if (!$ldappass) {
      $ldappass = $user->_user_password;
    }

    $bound = @$source_ldap->ldap_bind($ldapconn, $ldaprdn, $ldappass);

    if ($user) {
      $user->_bound = $bound;
    }

    return $source_ldap;
  }

  /**
   * Changes a user's password inside the LDAP
   *
   * @param CUser  $user       The user
   * @param string $old_pass   The user's old password
   * @param string $new_pass   The user's new password
   * @param string $encryption Encryption type: Unicode or MD5 or SHA
   *
   * @return boolean Success
   */
  static function changePassword(CUser $user, $old_pass, $new_pass, $encryption = "Unicode") {
    if (!in_array($encryption, array("Unicode", "MD5", "SHA"))) {
      return false;
    }

    $source_ldap = CLDAP::connect();

    if (!$source_ldap) {
      return false;
    }

    if (!$source_ldap->secured) {
      $source_ldap->start_tls();
    }

    $bound = $source_ldap->ldap_bind($source_ldap->_ldapconn, $user->user_username, $old_pass);

    if (!$bound) {
      return false;
    }

    $entry = array();

    switch ($encryption) {
      case "Unicode":
        $entry["unicodePwd"][0] = self::encodeUnicodePassword($new_pass);
        break;

      case "MD5":
        $new_pass = md5($new_pass);
        $entry["userPassword"] = "\{$encryption\}".base64_encode(pack("H*", $new_pass));
        break;

      case "SHA":
        $new_pass = sha1($new_pass);
        $entry["userPassword"] = "\{$encryption\}".base64_encode(pack("H*", $new_pass));
        break;
    }

    $dn = $source_ldap->get_dn($user->user_username);
    return $source_ldap->ldap_mod_replace($source_ldap->_ldapconn, $dn, $entry);
  }
  
  private static function encodeUnicodePassword($password) {
    $password = "\"$password\"";
    $encoded = "";

    for ($i = 0; $i < strlen($password); $i++) {
      $encoded .= "{$password[$i]}\000";
    }

    return $encoded;
  }

  /**
   * Search and map a user inside the LDAP
   *
   * @param CUser       $user
   * @param CSourceLDAP $source_ldap
   * @param resource    $ldapconn
   * @param string      $person       [optional]
   * @param string      $filter       [optional]
   * @param boolean     $force_create [optional]
   *
   * @return CUser
   */
  static function searchAndMap(CUser $user, CSourceLDAP $source_ldap, $ldapconn, $person = null, $filter = null, $force_create = false) {
    if (!$person) {
      $person = $user->user_username;
    }
    $person = utf8_encode($person);
    if (!$filter) {
      $filter="(samaccountname=$person)";
    }

    $results = $source_ldap->ldap_search($ldapconn, $filter);
    if (!$results || ($results["count"] == 0)) {
      $user->_bound = false;
      $user->_count_ldap = 0;
      return $user;
    }

    if ($results["count"] > 1) {
      throw new CMbException("CSourceLDAP_too-many-results");
    }

    $results = $results[0];

    $idex = new CIdSante400();
    $idex->tag          = CAppUI::conf("admin LDAP ldap_tag");
    $idex->object_class = "CUser";

    $idex->id400        = self::getObjectGUID($results);
    $idex->loadMatchingObject();

    // On sauvegarde le password renseign�
    $user_password  = $user->user_password;
    $_user_password = $user->_user_password;

    // objectguid retrouv� on charge le user
    if ($idex->_id) {
      $user = new CUser();
      $user->load($idex->object_id);
    }
    else {
      // objectguid non retrouv� on associe � l'user courant l'objectguid
      // Si on est pas en mode cr�ation on le recherche
      if (!$force_create) {
        // Suppression du password pour le loadMatchingObject
        $user->user_password  = null;
        $user->_user_password = null;

        $user->loadMatchingObject();
        if (!$user->_id) {
          throw new CMbException("Auth-failed-user-unknown");
        }
      }
    }
    $user->_bound = true;
    $user = self::mapTo($user, $results);

    // Save Mediuser variables
    $actif        = $user->_user_actif;
    $deb_activite = $user->_user_deb_activite;
    $fin_activite = $user->_user_fin_activite;

    // Restore User password variables
    $user->user_password  = $user_password;
    $user->_user_password = $_user_password;
    if (!$user->user_type) {
      $user->user_type = 0;
    }
    // Pas de profil
    $user->template = 0;
    $user->user_login_errors = 0;
    $user->repair();
    $msg = $user->store();
    if ($msg) {
      throw new CMbException($msg);
    }

    if ((!$force_create && !$user->_ref_mediuser->actif) || ($force_create && !$actif)) {
      throw new CMbException("Auth-failed-user-deactivated");
    }

    // Restore Mediuser variables
    $user->_user_actif = $actif;
    $user->_user_deb_activite = $deb_activite;
    $user->_user_fin_activite = $fin_activite;
    $user->_count_ldap = 1;

    if (!$idex->_id) {
      $idex->object_id   = $user->_id;
      $idex->last_update = CMbDT::dateTime();
      if ($msg = $idex->store()) {
        throw new CMbException($msg);
      }
    }

    return $user;
  }

  /**
   * @param array   $values      [optional]
   * @param string  $name
   * @param boolean $single      [optional]
   * @param boolean $utf8_decode [optional]
   *
   * @return string
   */
  static function getValue($values = array(), $name, $single = true, $utf8_decode = true) {
    if (array_key_exists($name, $values)) {
      return $single ?
              ($utf8_decode ? utf8_decode($values[$name][0]) : $values[$name][0]) :
              ($utf8_decode ? utf8_decode($values[$name]) : $values[$name]);
    }
    return null;
  }
  
  /**
   * @param CUser $user
   * @param array $values
   *
   * @return CUser
   */
  static function mapTo(CUser $user, $values) {
    $user->user_username   = self::getValue($values, "samaccountname");
    $user->user_first_name = self::getValue($values, "givenname");
    $user->user_last_name  = self::getValue($values, "sn") ? self::getValue($values, "sn") : self::getValue($values, "samaccountname");
    $user->user_phone      = self::getValue($values, "telephonenumber");
    $user->user_email      = self::getValue($values, "mail");
    $whencreated = null;
    if ($when_created = self::getValue($values, "whencreated")) {
      $whencreated      = CMbDT::date(CMbDT::dateTimeFromAD($when_created));
    }
    $accountexpires = null;
    if ($account_expires = self::getValue($values, "accountexpires")) {
      // 1000000000000000000 = 16-11-4769 01:56:35
      if ($account_expires < 1000000000000000000) {
        $accountexpires = CMbDT::date(CMbDT::dateTimeFromLDAP($account_expires));
      }
    }
    // 66048,Account: Enabled - DONT_EXPIRE_PASSWORD
    // 66080,Account: Enabled - DONT_EXPIRE_PASSWORD - PASSWD_NOTREQD
    // 66050 = Disabled
    $actif = (self::getValue($values, "useraccountcontrol") == 66050) ? 0 : 1;
    $user->loadRefMediuser();
    if ($user->_id) {
      $mediuser = $user->_ref_mediuser;
      $mediuser->actif        = $actif;
      $mediuser->deb_activite = $whencreated;
      $mediuser->fin_activite = $accountexpires;
      $mediuser->_ldap_store = true;
      $mediuser->store();
    }
    $user->_user_actif        = $actif;
    $user->_user_deb_activite = $whencreated;
    $user->_user_fin_activite = $accountexpires;
    
    return $user;
  }
  
  /**
   * @param array $values
   *
   * @return string
   */
  static function getObjectGUID($values) {
    // Passage en hexad�cimal de l'objectguid
    $objectguid = unpack('H*', self::getValue($values, "objectguid", true, false));
    $objectguid = $objectguid[1];

    if (CAppUI::conf("admin LDAP object_guid_mode") == "registry") {
      $objectguid = self::convertHexaToRegistry($objectguid);
    }

    return $objectguid;
  }

  static function convertHexaToRegistry($objectguid) {
    $first_segment  = substr($objectguid, 4, 4);
    $second_segment = substr($objectguid, 0, 4);
    $third_segment  = substr($objectguid, 8, 4);
    $fourth_segment = substr($objectguid, 12, 4);
    $fifth_segment  = substr($objectguid, 16, 4);
    $sixth_segment  = substr($objectguid, 20, 12);

    $first_segment  = implode("", array_reverse(str_split($first_segment, 2)));
    $second_segment = implode("", array_reverse(str_split($second_segment, 2)));
    $third_segment  = implode("", array_reverse(str_split($third_segment, 2)));
    $fourth_segment = implode("", array_reverse(str_split($fourth_segment, 2)));

    return "$first_segment$second_segment-$third_segment-$fourth_segment-$fifth_segment-$sixth_segment";
  }
  
  /**
   * @param string $ldap_guid
   *
   * @return CUser
   */
  static function getFromLDAPGuid($ldap_guid) {
    if (!$ldap_guid) {
      throw new CMbException("CUser_no-ldap-guid");
    }
    
    $id_ext = CIdSante400::getMatch("CUser", CAppUI::conf("admin LDAP ldap_tag"), $ldap_guid);
    
    if (!$id_ext->_id) {
      throw new CMbException("CUser_ldap-guid-no-user");
    }

    CAppUI::$instance->auth_method = "ldap_guid";
    
    return $id_ext->loadTargetObject();
  }

  /**
   * Escape the string used in LDAP search in order to avoid
   * "LDAP-injections"
   *
   * @param string $str LDAP search query
   *
   * @return string
   */
  static function escape($str) {
    $meta_chars = array (
      "\0" => "\\00",
      "\\" => "\\5C",
      "("  => "\\28",
      ")"  => "\\29",
      "*"  => "\\2A"
    );

    return strtr($str, $meta_chars);
  }
}
