<?php

/**
 * $Id: do_perms_cp.php 18997 2013-05-02 09:24:16Z rhum1 $
 *
 * @category Admin
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 18997 $
 * @link     http://www.mediboard.org
 */

$tempUserName    = CValue::post("temp_user_name", "");
$permission_user = CValue::post("permission_user", "");
$delPermissions  = CValue::post("delPerms", false);

// pull user_id for unique user_username (templateUser)
$tempUser = new CUser;
$where = array();
$where["user_username"] = "= '$tempUserName'";
$tempUser->loadObject($where);

$user = new CUser;
$user->user_id = $permission_user;
$msg = $user->copyPermissionsFrom($tempUser->user_id, $delPermissions);

CAppUI::setMsg("Permissions");
CAppUI::setMsg($msg ? $msg : "copied from template", $msg ? UI_MSG_ERROR : UI_MSG_OK, true);
CAppUI::redirect();
