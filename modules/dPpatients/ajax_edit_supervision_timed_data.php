<?php
/**
 * $Id: ajax_edit_supervision_timed_data.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

CCanDo::checkAdmin();

$supervision_timed_data_id = CValue::getOrSession("supervision_timed_data_id");

$timed_data = new CSupervisionTimedData();
$timed_data->load($supervision_timed_data_id);
$timed_data->loadRefsNotes();

$smarty = new CSmartyDP();
$smarty->assign("timed_data",  $timed_data);
$smarty->display("inc_edit_supervision_timed_data.tpl");
