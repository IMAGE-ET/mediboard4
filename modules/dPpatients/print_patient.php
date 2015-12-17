<?php
/**
 * $Id: print_patient.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

CCanDo::checkRead();

$today = date("d/m/Y");

$patient_id = CValue::get("patient_id");

// Création du patient
$patient = new CPatient();
$patient->load($patient_id);
$patient->updateNomPaysInsee();

$patient->loadRefsSejours();
foreach ($patient->_ref_sejours as $sejour) {
  $sejour->loadRefPraticien();
  $sejour->loadRefsOperations();
  $sejour->loadNDA();
  foreach ($sejour->_ref_operations as $operation) {
    $operation->loadRefPlageOp();
    $operation->loadRefChir();
  }
}

$patient->loadRefsConsultations();
foreach ($patient->_ref_consultations as $consultation) {
  $consultation->loadRefPlageConsult();
}

$patient->loadRefsCorrespondants();
$patient->loadRefsCorrespondantsPatient();
$patient->loadIPP();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("patient", $patient);
$smarty->assign("today"  , $today  );

if (CAppUI::conf('dPpatients CPatient extended_print')) {
  $smarty->display("print_patient_extended.tpl");
}
else {
  $smarty->display("print_patient.tpl");
}
