<?php
/**
 * $Id: ajax_form_correspondant.php 28237 2015-05-11 16:06:01Z flaviencrochard $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28237 $
 */

$correspondant_id = CValue::get("correspondant_id");
$patient_id       = CValue::get("patient_id");
$duplicate        = CValue::get("duplicate");

$correspondant = new CCorrespondantPatient();
$patient = new CPatient();

if ($correspondant_id) {
  $correspondant->load($correspondant_id);
  $patient = $correspondant->loadRefPatient();

  if ($duplicate) {
    $correspondant->_id = "";
  }
}
else {
  if ($patient_id) {
    $patient->load($patient_id);
    $correspondant->patient_id = $patient_id;
    $correspondant->_duplicate = $duplicate;
    $correspondant->updatePlainFields();
  }

  if (CAppUI::conf("ref_pays") == 2) {
    $correspondant->relation = "assurance";
  }
}

$patient->loadRefsCorrespondantsPatient();

$smarty = new CSmartyDP();

$smarty->assign("correspondant" , $correspondant);
$smarty->assign("patient"       , $patient);

$smarty->display("inc_form_correspondant.tpl");