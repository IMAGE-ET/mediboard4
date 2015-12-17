<?php
/**
 * $Id: vw_idx_category.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */
 
CCanDo::checkEdit();

$category_id = CValue::getOrSession('category_id');

// Loads the expected Category
$category = new CProductCategory();
$category->load($category_id);

// Categories list
$list_categories = $category->loadList();
foreach ($list_categories as $_cat) {
  $_cat->countBackRefs("products");
}

// Smarty template
$smarty = new CSmartyDP();

$smarty->assign('category',        $category);
$smarty->assign('list_categories', $list_categories);

$smarty->display('vw_idx_category.tpl');

