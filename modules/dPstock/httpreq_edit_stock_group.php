<?php
/**
 * $Id: httpreq_edit_stock_group.php 25962 2014-11-20 10:26:34Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25962 $
 */

CCanDo::checkEdit();

$stock_id    = CValue::get('stock_id');
$product_id  = CValue::get('product_id');

// Loads the stock in function of the stock ID or the product ID
$stock = new CProductStockGroup();

// If stock_id has been provided, we load the associated product
if ($stock_id) {
  $stock->stock_id = $stock_id;
  $stock->loadMatchingObject();
  $stock->loadRefsFwd();
  $stock->_ref_product->loadRefsFwd();
}
// else, if a product_id has been provided, we load the associated stock
else if ($product_id) {
  $product = new CProduct();
  $product->load($product_id);

  $stock->product_id = $product_id;
  $stock->_ref_product = $product;
}
else {
  $stock->loadRefsFwd();
}
$stock->updateFormFields();

$list_services = CProductStockGroup::getServicesList();

foreach ($list_services as $_service) {
  $stock_service = new CProductStockService;
  $stock_service->object_id = $_service->_id;
  $stock_service->object_class = $_service->_class;
  $stock_service->product_id = $stock->product_id;
  if (!$stock_service->loadMatchingObject()) {
    $stock_service->quantity = $stock->_ref_product->quantity;
    $stock_service->order_threshold_min = $stock->_ref_product->quantity;
    $stock_service->order_threshold_optimum = max($stock->getOptimumQuantity(), $stock_service->quantity);
  }
  $_service->_ref_stock = $stock_service;
}

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign('stock',          $stock);
$smarty->assign('list_services',  $list_services);

$smarty->display('inc_edit_stock_group.tpl');

