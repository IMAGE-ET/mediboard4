<?php

/**
 * $Id: ajax_edit_pref.php 18997 2013-05-02 09:24:16Z rhum1 $
 *
 * @category Admin
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 18997 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

$pref_id = CValue::getOrSession("pref_id");

$preference = new CPreferences();
$preference->load($pref_id);
$preference->loadRefsNotes();

$smarty = new CSmartyDP();
$smarty->assign("preference", $preference);
$smarty->display("inc_edit_pref.tpl");
