<?php
/**
 * $Id: ajax_reload_infos_interv.php 26537 2014-12-22 15:14:01Z aurelie17 $
 *  
 * @category SalleOp
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 26537 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

$operation_id = CValue::get("operation_id");

$operation = new COperation();
$operation->load($operation_id);
$operation->canDo();
$operation->countAlertsNotHandled();
$operation->loadLiaisonLibelle();

$smarty = new CSmartyDP();

$smarty->assign("operation", $operation);

$smarty->display("inc_reload_infos_interv.tpl");