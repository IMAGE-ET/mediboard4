<?php 
/**
 * $Id: CIpAddressSpec.class.php 21047 2013-11-22 16:19:40Z charlyecho $
 * 
 * @package    Mediboard
 * @subpackage classes
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 21047 $
 */

/**
 * IP address
 */
class CIpAddressSpec extends CMbFieldSpec {
  /**
   * @see parent::getSpecType()
   */
  function getSpecType() {
    return "ipAddress";
  }

  /**
   * @see parent::getDBSpec()
   */
  function getDBSpec(){
    return "VARBINARY(16)";
  }

  /**
   * @see parent::getValue()
   */
  function getValue($object, $smarty = null, $params = array()) {
    $propValue = $object->{$this->fieldName};
    return $propValue ? inet_ntop($propValue) : "";
  }

  /**
   * @see parent::checkProperty()
   */
  function checkProperty($object){
    return null;
  }

  /**
   * @see parent::filter()
   */
  function filter($value){
    return $value;
  }

  /**
   * @see parent::sample()
   */
  function sample($object, $consistent = true){
    parent::sample($object, $consistent);
    $object->{$this->fieldName} = inet_pton("127.0.0.1");
  }

  /**
   * @see parent::getLitteralDescription()
   */
  function getLitteralDescription() {
    return "Adresse IP au format binaire. ".
    parent::getLitteralDescription();
  }
}
