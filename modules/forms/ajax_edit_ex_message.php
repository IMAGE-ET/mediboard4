<?php
/**
 * $Id: ajax_edit_ex_message.php 26560 2014-12-23 14:34:11Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26560 $
 */

CCanDo::checkEdit();

$ex_message_id = CValue::get("ex_message_id");
$ex_group_id   = CValue::get("ex_group_id");

CExObject::$_locales_cache_enabled = false;
$ex_message = new CExClassMessage;

if ($ex_message->load($ex_message_id)) {
  $ex_message->loadRefsNotes();
}
else {
  $ex_message->ex_group_id = $ex_group_id;
}

$ex_message->loadRefPredicate()->loadView();
$ex_message->loadRefExGroup()->loadRefExClass();
$ex_message->loadRefProperties();

$smarty = new CSmartyDP();
$smarty->assign("ex_message", $ex_message);
$smarty->display("inc_edit_ex_message.tpl");