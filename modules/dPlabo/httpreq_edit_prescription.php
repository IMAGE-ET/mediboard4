<?php
/**
 * $Id: httpreq_edit_prescription.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

$user = CMediusers::get();

$listPrats = $user->loadPraticiens(PERM_EDIT);

// Chargement de la prescription choisie
$prescription = new CPrescriptionLabo;
$prescription->load($prescription_labo_id = CValue::get("prescription_labo_id"));
if (!$prescription->_id) {
  $prescription->patient_id = CValue::get("patient_id");
  $prescription->date = CMbDT::dateTime();
  $prescription->praticien_id = $user->_id;
}

$prescription->loadRefsFwd();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("prescription", $prescription);
$smarty->assign("listPrats"   , $listPrats);

$smarty->display("inc_edit_prescription.tpl");
