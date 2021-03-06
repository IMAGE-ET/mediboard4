<?php
/**
 * $Id: httpreq_widget_correspondants.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

CCanDo::checkEdit();

$patient_id = CValue::getOrSession("patient_id");
$widget_id = CValue::get("widget_id");

$patient = new CPatient();
$patient->load($patient_id);
if ($patient->_id) {
  $patient->loadRefsCorrespondants();
}

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign("patient", $patient);
$smarty->assign("widget_id", $widget_id);

$smarty->display("inc_widget_correspondants.tpl");
