<?php
/**
 * $Id: ajax_view_patient_pmsi.php 25445 2014-10-21 14:26:51Z armengaudmc $
 *
 * @package    Mediboard
 * @subpackage PMSI
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25445 $
 */

CCanDo::checkEdit();

$group = CGroups::loadCurrent();
$patient_id = CValue::get("patient_id");

// Chargement du séjour
$sejour  = new CSejour();
$sejour->load(CValue::get("sejour_id"));

// Chargement du patient
$patient = new CPatient();
if ($patient_id) {
  $patient = $patient->load($patient_id);
}
else {
  $patient = $sejour->loadRelPatient();
}

$patient->loadIPP();
$patient->loadRefsCorrespondants();
$patient->loadRefPhotoIdentite();
$patient->loadPatientLinks();
$patient->countINS();
if (CModule::getActive("fse")) {
  $cv = CFseFactory::createCV();
  if ($cv) {
    $cv->loadIdVitale($patient);
  }
}

// Chargement du séjour
$sejour  = new CSejour();
$sejour->load(CValue::get("sejour_id"));
if ($sejour->patient_id == $patient->_id) {
  $sejour->_ref_patient = $patient;
  $sejour->canDo();
  $sejour->loadNDA();
  $sejour->loadExtDiagnostics();
  $sejour->loadRefsAffectations();
  $sejour->loadRefsOperations();
  foreach ($sejour->_ref_operations as $_op) {
    $_op->loadRefPraticien();
    $_op->loadRefPlageOp();
    $_op->loadRefAnesth();
    $_op->loadRefsConsultAnesth();
    $_op->loadBrancardage();
  }
  $sejour->loadRefsConsultAnesth();
}
else {
  $sejour = new CSejour();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("canPatients"     , CModule::getCanDo("dPpatients"));
$smarty->assign("hprim21installed", CModule::getActive("hprim21"));
$smarty->assign("isImedsInstalled", (CModule::getActive("dPImeds") && CImeds::getTagCIDC(CGroups::loadCurrent())));
$smarty->assign("patient"         , $patient);
$smarty->assign("sejour"          , $sejour);

$smarty->display("inc_vw_patient_pmsi.tpl");