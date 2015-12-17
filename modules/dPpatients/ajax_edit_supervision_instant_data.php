<?php
/**
 * $Id: ajax_edit_supervision_instant_data.php 26001 2014-11-24 15:22:57Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26001 $
 */

CCanDo::checkAdmin();

$supervision_instant_data_id = CValue::getOrSession("supervision_instant_data_id");

$instant_data = new CSupervisionInstantData();
$instant_data->load($supervision_instant_data_id);
$instant_data->loadRefsNotes();

if (!$instant_data->_id) {
  $instant_data->size = 11;
}

$smarty = new CSmartyDP();
$smarty->assign("instant_data", $instant_data);
$smarty->display("inc_edit_supervision_instant_data.tpl");
