<?php
/**
 * $Id: view_ex_class_category.php 28122 2015-04-29 12:14:26Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28122 $
 */

CCanDo::checkEdit();

$category = new CExClassCategory();
$categories = $category->loadGroupList(null, "title");

$smarty = new CSmartyDP();
$smarty->assign("categories", $categories);
$smarty->display("view_ex_class_category.tpl");
