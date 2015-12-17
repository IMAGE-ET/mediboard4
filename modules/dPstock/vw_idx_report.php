<?php
/**
 * $Id: vw_idx_report.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */

global $g;
CCanDo::checkRead();

$list_stocks = new CProductStockGroup();

$where = array();
$where['group_id'] = " = '$g'";
$orderby = "quantity / order_threshold_min";
$list_stocks = $list_stocks->loadList($where, $orderby, 40);
foreach ($list_stocks as $stock) {
  $stock->loadRefOrders();
}

$colors = array('#F00', '#FC3', '#1D6', '#06F', '#000');

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign('list_stocks', $list_stocks);
$smarty->assign('colors', $colors);

$smarty->display('vw_idx_report.tpl');

