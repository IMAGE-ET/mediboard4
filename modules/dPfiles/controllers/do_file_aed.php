<?php
/**
 * $Id: do_file_aed.php 20498 2013-09-29 19:08:17Z phenxdesign $
 *
 * @category Files
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 20498 $
 * @link     http://www.mediboard.org
 */

CApp::setTimeLimit(600);
ignore_user_abort(1);
CValue::setSession(CValue::postOrSession("private"));
ini_set("upload_max_filesize", CAppUI::conf("dPfiles upload_max_filesize"));

$do = new CFileAddEdit;
$do->doBind();
if (intval(CValue::read($do->request, 'del'))) {
  $do->doDelete();
}
else {
  $do->doStore();
}

$smarty = new CSmartyDP;
$messages = CAppUI::getMsg();
$smarty->assign("messages", $messages);
$smarty->display("../../dPfiles/templates/inc_callback_upload.tpl");

$do->doRedirect();


