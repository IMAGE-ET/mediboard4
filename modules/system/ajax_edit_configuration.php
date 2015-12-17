<?php
/**
 * $Id: ajax_edit_configuration.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

$inherit = CValue::get("inherit");
$module  = CValue::get("module");

if (!is_array($inherit)) {
  $inherit = array($inherit);
}

$all_inherits = array_keys(CConfiguration::getModel($inherit));

$smarty = new CSmartyDP();
$smarty->assign("module",       $module);
$smarty->assign("inherit",      $inherit);
$smarty->assign("all_inherits", $all_inherits);
$smarty->display("inc_edit_configuration.tpl");