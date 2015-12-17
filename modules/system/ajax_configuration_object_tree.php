<?php
/**
 * $Id: ajax_configuration_object_tree.php 21676 2014-01-16 10:52:13Z nicolasld $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21676 $
 */

$inherit = CValue::get("inherit");
$uid     = CValue::get("uid");

$object_tree = CConfiguration::getObjectTree($inherit);

$smarty = new CSmartyDP();
$smarty->assign("object_tree", $object_tree);
$smarty->assign("inherit",     $inherit);
$smarty->assign("uid",         $uid);
$smarty->display("inc_select_configuration_object.tpl");