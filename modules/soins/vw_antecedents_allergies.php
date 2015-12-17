<?php
/**
 * $Id: vw_antecedents_allergies.php 28933 2015-07-09 14:18:15Z aurelie17 $
 *
 * @category soins
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28933 $
 */

CCanDo::checkRead();
$show_atcd    = CValue::get("show_atcd", 1);
$patient_guid = CValue::get("patient_guid");
$sejour_id    = CValue::get("sejour_id");
$consult_id   = CValue::get("consult_id");

/* @var CPatient $patient*/
$patient = CMbObject::loadFromGuid($patient_guid);
$dossier_medical = $patient->loadRefDossierMedical();
if ($dossier_medical->_id) {
  $dossier_medical->loadRefsAllergies();
  $dossier_medical->loadRefsAntecedents();
  $dossier_medical->countAntecedents(false);
  $dossier_medical->countAllergies();
}

$new_sejour_id = null;
$dossier_medical_sejour = new CDossierMedical();
if ($show_atcd && ($consult_id || $sejour_id)) {
  if ($consult_id) {
    $consult = new CConsultation();
    $consult->load($consult_id);
    $consult->loadRefPatient();
    $sejour = $consult->loadRefSejour();
  }
  elseif ($sejour_id) {
    $sejour = new CSejour();
    $sejour->load($sejour_id);
    $sejour->loadRefPatient();
  }
  $new_sejour_id = $sejour->_id;
  $dossier_medical_sejour = $sejour->loadRefDossierMedical();
  if ($dossier_medical_sejour->_id) {
    $dossier_medical_sejour->loadRefsAllergies();
    $dossier_medical_sejour->loadRefsAntecedents();
    $dossier_medical_sejour->countAntecedents(false);
    $dossier_medical_sejour->countAllergies();
  }

  if ($dossier_medical_sejour->_id && $dossier_medical->_id) {
    CDossierMedical::cleanAntecedentsSignificatifs($dossier_medical_sejour, $dossier_medical);
  }
}

$where = array();
$where["annule"] = " = '0'";
$where["patient_id"] = " = '$patient->_id'";
$_sejour = new CSejour();
/* @var CSejour[] $sejours*/
$sejours = $_sejour->loadList($where, 'entree DESC');
foreach ($sejours as $_sejour) {
  $_sejour->loadRefsOperations();
  if (!$_sejour->_motif_complet) {
    unset($sejours[$_sejour->_id]);
    continue;
  }
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("sejour_id"             , $new_sejour_id);
$smarty->assign("antecedents_sejour"    , $dossier_medical_sejour->_ref_antecedents_by_type);
$smarty->assign("dossier_medical_sejour", $dossier_medical_sejour);
$smarty->assign("patient_guid"          , $patient->_guid);
$smarty->assign("antecedents"           , $dossier_medical->_ref_antecedents_by_type);
$smarty->assign("dossier_medical"       , $dossier_medical);
$smarty->assign("show_atcd"             , $show_atcd);
$smarty->assign("sejours"               , $sejours);

$smarty->display("inc_antecedents_allergies.tpl");