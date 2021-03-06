<?php
/**
 * $Id: do_evenement_ssr_multi_aed.php 28804 2015-07-01 09:42:50Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage SSR
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28804 $
 */

$sejour_id            = CValue::post("sejour_id");
$equipement_id        = CValue::post("equipement_id");
$therapeute_id        = CValue::post("therapeute_id");
$line_id              = CValue::post("line_id");
$cdarrs               = CValue::post("cdarrs");
$_cdarrs              = CValue::post("_cdarrs");
$csarrs               = CValue::post("csarrs");
$_csarrs              = CValue::post("_csarrs");
$remarque             = CValue::post("remarque");
$type_seance          = CValue::post("_type_seance");
$sejours_guids        = CValue::post("_sejours_guids");
$seance_collective_id = CValue::post("seance_collective_id");

$sejours_guids = json_decode(utf8_encode(stripslashes($sejours_guids)), true);

// Codes CdARR
$codes_cdarrs = array();
if (is_array($cdarrs)) {
  foreach ($cdarrs as $_code) {
    $codes_cdarrs[] = $_code;
  }
}

if (is_array($_cdarrs)) {
  foreach ($_cdarrs as $_code) {
    $codes_cdarrs[] = $_code;
  }
}

// Codes CdARR
$codes_csarrs = array();
if (is_array($csarrs)) {
  foreach ($csarrs as $_code) {
    $codes_csarrs[] = $_code;
  }
}

if (is_array($_csarrs)) {
  foreach ($_csarrs as $_code) {
    $codes_csarrs[] = $_code;
  }
}

$_days = CValue::post("_days");
$_heure_deb = CValue::post("_heure_deb");
$duree = CValue::post("duree");

$kine = new CMediusers();
$kine->load($therapeute_id);

$sejour = new CSejour;
$sejour->load($sejour_id);

// Ajout d'un evenement dans la seance choisie
if ($seance_collective_id) {
  $evenement = new CEvenementSSR();
  $evenement->sejour_id = $sejour_id;
  $evenement->prescription_line_element_id = $line_id;
  $evenement->seance_collective_id = $seance_collective_id;
  $evenement->type_seance          = $type_seance;

  $evenement->loadMatchingObject();
  if ($evenement->_id) {
    CAppUI::displayMsg("Patient d�j� pr�sent dans la s�ance", "CEvenementSSR-title-create");
  }
  else {
    $msg = $evenement->store();
    CAppUI::displayMsg($msg, "CEvenementSSR-msg-create");
    
    // Actes CdARR
    foreach ($codes_cdarrs as $_code) {
      $acte = new CActeCdARR();
      $acte->code = $_code;
      $acte->evenement_ssr_id = $evenement->_id;
      $msg = $acte->store();
      CAppUI::displayMsg($msg, "$acte->_class-msg-create");
    }

    // Actes CsARR
    foreach ($codes_csarrs as $_code) {
      $acte = new CActeCsARR();
      $acte->code = $_code;
      $acte->evenement_ssr_id = $evenement->_id;
      $msg = $acte->store();
      CAppUI::displayMsg($msg, "$acte->_class-msg-create");
    }
  }
}
// Creation des evenements et eventuellement des seances si la checkbox est coch�e
else {
  if (count($_days)) {
    $entree = CMbDT::date($sejour->entree);
    $sortie = CMbDT::date($sejour->sortie);
    $bilan = $sejour->loadRefBilanSSR();
    $referent = $bilan->loadRefKineReferent();
    
    $date = CValue::getOrSession("date", CMbDT::date());

    $monday = CMbDT::date("last monday", CMbDT::date("+1 day", $date));
    foreach ($_days as $_number) {
      $_day = CMbDT::date("+$_number DAYS", $monday);
      if (!CMbRange::in($_day, $entree, $sortie)) {
        CAppUI::setMsg("CEvenementSSR-msg-failed-bounds", UI_MSG_WARNING);
        continue; 
      }
    
      if (!$_heure_deb || !$duree) {
        continue;
      }  
      
      $evenement = new CEvenementSSR();
      $evenement->equipement_id = $equipement_id;
      $evenement->debut         = "$_day $_heure_deb";
      $evenement->duree         = $duree;
      $evenement->remarque      = $remarque;
      $evenement->therapeute_id = $therapeute_id;
      $evenement->type_seance   = $type_seance;

      // Transfert kin� r�f�rent => kin� rempla�ant si disponible
      if ($therapeute_id == $referent->_id) {
        $conge = new CPlageConge();
        $conge->loadFor($therapeute_id, $_day);
        // R�f�rent en cong�s
        if ($conge->_id) {
          $replacement = new CReplacement();
          $replacement->conge_id = $conge->_id;
          $replacement->sejour_id = $sejour->_id;
          $replacement->loadMatchingObject();
          if ($replacement->_id) {
            $evenement->therapeute_id = $replacement->replacer_id;
          }
        }
      }

      // Transfert kin� remplacant => kin� r�f�rant si pr�sent
      if ($sejour->isReplacer($therapeute_id)) {
        $conge = new CPlageConge();
        $conge->loadFor($referent->_id, $_day);
        // R�f�rent pr�sent
        if (!$conge->_id) {
          $evenement->therapeute_id = $referent->_id;
        }
      }

      // Si l'evenement n'est pas une seance collective
      if ($type_seance != "collective") {
        $evenement->prescription_line_element_id = $line_id;
        $evenement->sejour_id = $sejour_id;
      }
  
      // Store de l'evenement ou de la nouvelle seance
      $msg = $evenement->store();
      CAppUI::displayMsg($msg, "CEvenementSSR-msg-create");
      
      $evenements_actes_id[] = $evenement->_id;
            
      // Si une seance a ete cr��e, on cr�e l'evenement li� a la seance, et on cr�e les code cdarr sur l'evenement
      if ($type_seance == "collective") {
        $evenements_actes_id = array();
        //Cas de la s�lection de plusieurs patient pour la s�ance collective
        $sejours_guids["CSejour-$sejour_id"]["checked"] = 1;
        foreach ($sejours_guids as $sejour_guid => $_sejour) {
          if ($_sejour["checked"] == 1) {
            $sejour_collectif = CMbObject::loadFromGuid($sejour_guid);
            $evt_ssr = new CEvenementSSR();
            $evt_ssr->sejour_id = $sejour_collectif->_id;
            $evt_ssr->prescription_line_element_id = $line_id;
            $evt_ssr->seance_collective_id = $evenement->_id;
            $evt_ssr->type_seance          = $type_seance;
            $msg = $evt_ssr->store();
            CAppUI::displayMsg($msg, "CEvenementSSR-msg-create");

            // Si une seance a ete cr��e, les codes cdarrs seront cr��s sur l'evenement de la seance
            $evenements_actes_id[] = $evt_ssr->_id;
          }
        }
      }


      foreach ($evenements_actes_id as $evenement_actes_id) {
        // Actes CdARR
        foreach ($codes_cdarrs as $_code) {
          $acte = new CActeCdARR();
          $acte->code = $_code;
          $acte->evenement_ssr_id = $evenement_actes_id;
          $msg = $acte->store();
          CAppUI::displayMsg($msg, "$acte->_class-msg-create");
        }

        // Actes CsARR
        foreach ($codes_csarrs as $_code) {
          $acte = new CActeCsARR();
          $acte->code = $_code;
          $acte->evenement_ssr_id = $evenement_actes_id;
          $msg = $acte->store();
          CAppUI::displayMsg($msg, "$acte->_class-msg-create");
        }
      }
    }
  }
}
echo CAppUI::getMsg();
CApp::rip();
