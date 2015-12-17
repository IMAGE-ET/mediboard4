<?php
/**
 * $Id: ajax_vw_tasks_sejour.php 24397 2014-08-12 12:52:55Z aurelie17 $
 *
 * @category Soins
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 24397 $
 * @link     http://www.mediboard.org
 */

$sejour_id        = CValue::getOrSession("sejour_id");
$mode_realisation = CValue::get("mode_realisation");
$readonly         = CValue::get("readonly", 0);

$sejour = new CSejour();
$sejour->load($sejour_id);

$sejour->countTasks();
$sejour->loadRefsTasks();

foreach ($sejour->_ref_tasks as $_task) {
  $_task->setDateAndAuthor();
  $_task->loadRefAuthor();
  $_task->loadRefPrescriptionLineElement();
  $_task->loadRefAuthorRealise();
}

CSejourTask::sortByDate($sejour->_ref_tasks);

// Smarty template
$smarty = new CSmartyDP();

$smarty->assign("sejour"          , $sejour);
$smarty->assign("task"            , new CSejourTask());
$smarty->assign("readonly"        , $readonly);
$smarty->assign("header"          , "0");
$smarty->assign("mode_realisation", $mode_realisation);

$smarty->display("inc_vw_tasks_sejour.tpl");

