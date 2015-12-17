<?php
/**
 * $Id: ajax_edit_ex_subgroup.php 26560 2014-12-23 14:34:11Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26560 $
 */

CCanDo::checkEdit();

$ex_subgroup_id = CValue::get("ex_subgroup_id");
$ex_group_id    = CValue::get("ex_group_id");

CExObject::$_locales_cache_enabled = false;
$ex_subgroup = new CExClassFieldSubgroup();

if ($ex_subgroup->load($ex_subgroup_id)) {
  $ex_subgroup->loadRefsNotes();
}
else {
  $ex_subgroup->parent_id    = $ex_group_id;
  $ex_subgroup->parent_class = "CExClassFieldGroup";
}

$ex_subgroup->loadRefPredicate()->loadView();
$ex_subgroup->loadRefProperties();

$ex_group = $ex_subgroup->getExGroup();
$ex_group->loadRefExClass();

$smarty = new CSmartyDP();
$smarty->assign("ex_subgroup", $ex_subgroup);
$smarty->assign("ex_group", $ex_group);
$smarty->display("inc_edit_ex_subgroup.tpl");