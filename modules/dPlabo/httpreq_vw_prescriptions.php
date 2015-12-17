<?php
/**
 * $Id: httpreq_vw_prescriptions.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

$user = CMediusers::get();

$patient_id = CValue::getOrSession("patient_id");

$prescription_labo_id = CValue::getOrSession("prescription_labo_id");

if (!$patient_id) {
  return;
}

// Chargement de la prescription demandée
$prescription = new CPrescriptionLabo();
$prescription->load($prescription_labo_id);
$prescription->loadRefs();

$patient = new CPatient();
$patient->load($patient_id);
$patient->loadRefsPrescriptions(PERM_EDIT);
foreach ($patient->_ref_prescriptions as $_prescription) {
  $_prescription->loadRefs();
}


// Création du template
$smarty = new CSmartyDP();

$smarty->assign("patient"     , $patient     );
$smarty->assign("prescription", $prescription);

$smarty->display("inc_vw_prescriptions.tpl");

