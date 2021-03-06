<?php
/**
 * $Id: vw_resultats.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

// Chargement de la prescription
$prescription = new CPrescriptionLabo;
if ($prescription->load(CValue::getOrSession("prescription_id"))) {
  $prescription->loadRefsBack();
  $prescription->loadClassification();
}

// Chargement du patient
$patient_id = CValue::first($prescription->patient_id, CValue::getOrSession("patient_id"));
$patient = new CPatient;
$patient->load($patient_id);
$patient->loadRefsPrescriptions(PERM_EDIT);

// Chargement de la premi�re prescription dans le cas ou il n'y en a pas
if (!$prescription->_id && $patient->_id && count($patient->_ref_prescriptions)) {
  $prescription->load(reset($patient->_ref_prescriptions)->_id);
  $prescription->loadRefsBack();
  $prescription->loadClassification();
}

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign("patient"  , $patient);
$smarty->assign("prescription"  , $prescription);

$smarty->display("vw_resultats.tpl");
