<?php
/**
 * $Id: vw_idx_order_manager.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */
 
CCanDo::checkEdit();

$order_id = CValue::getOrSession('order_id');
$category_id = CValue::getOrSession('category_id');

// Loads the expected Order
$order = new CProductOrder();
if ($order_id) {
  $order->load($order_id);
  $order->updateFormFields();
}

$category = new CProductCategory();
$list_categories = $category->loadList(null, 'name');

// Smarty template
$smarty = new CSmartyDP();
$smarty->assign('order', $order);
$smarty->assign('category_id', $category_id);
$smarty->assign('list_categories', $list_categories);
$smarty->display('vw_idx_order_manager.tpl');

