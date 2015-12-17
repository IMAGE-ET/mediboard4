<?php
/**
 * $Id: vw_edit_prescriptions.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

$patient_id = CValue::getOrSession("patient_id");
$typeListe  = CValue::getOrSession("typeListe");

// Permettre de le remettre à null lors d'un changement de patient
CValue::getOrSession("prescription_labo_id");

// Chargement du patient
$patient = new CPatient;
$patient->load($patient_id);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("patient"  , $patient);
$smarty->assign("typeListe", $typeListe);

$smarty->display("vw_edit_prescriptions.tpl");
