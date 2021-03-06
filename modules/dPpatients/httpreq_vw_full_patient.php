<?php
/**
 * $Id: httpreq_vw_full_patient.php 28555 2015-06-09 14:09:17Z lryo $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28555 $
 */

CCanDo::checkRead();

$patient_id = CValue::getOrSession("patient_id", 0);

if (!$patient_id) {
  CAppUI::setMsg("Vous devez selectionner un patient", UI_MSG_ALERT);
  CAppUI::redirect("m=dPpatients&tab=0");
}

// Récuperation du patient sélectionné
$patient = new CPatient;
$patient->load($patient_id);
$patient->loadDossierComplet(PERM_READ);
$patient->loadRefDossierMedical();
$patient->_ref_dossier_medical->loadRefsAntecedents();
$patient->_ref_dossier_medical->loadRefsTraitements();
$patient->countINS();

$userSel = CMediusers::get();

// Suppression des consultations d'urgences
foreach ($patient->_ref_consultations as $keyConsult => $consult) {
  if ($consult->motif == "Passage aux urgences") {
    unset($patient->_ref_consultations[$keyConsult]);
  }
}

$can_view_dossier_medical = 
  CModule::getCanDo('dPcabinet')->edit ||
  CModule::getCanDo('dPbloc')->edit ||
  CModule::getCanDo('dPplanningOp')->edit || 
  $userSel->isFromType(array("Infirmière"));

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("canCabinet"              , CModule::getCanDo("dPcabinet"));
$smarty->assign("canPlanningOp"           , CModule::getCanDo("dPplanningOp"));

$smarty->assign("patient"                 , $patient);
$smarty->assign("can_view_dossier_medical", $can_view_dossier_medical);
$smarty->assign("isImedsInstalled"        , (CModule::getActive("dPImeds") && CImeds::getTagCIDC(CGroups::loadCurrent())));

$smarty->display("inc_vw_full_patients.tpl");
