<?php
/**
 * $Id: ajax_vw_surveillance_perop_administration.php 26001 2014-11-24 15:22:57Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26001 $
 */

CCanDo::checkRead();

$operation_id = CValue::get("operation_id");

$operation = new COperation();
$operation->load($operation_id);
$sejour = $operation->loadRefSejour();

// Cr�ation du template
$smarty = new CSmartyDP();
$smarty->assign("sejour", $sejour);
$smarty->assign("operation", $operation);
$smarty->display("inc_vw_surveillance_perop_administration.tpl");
