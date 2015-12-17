<?php

/**
 * $Id: do_user_aed.php 18997 2013-05-02 09:24:16Z rhum1 $
 *
 * @category Admin
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 18997 $
 * @link     http://www.mediboard.org
 */

$ds = CSQLDataSource::get("std");
$do = new CDoObjectAddEdit("CUser", "user_id");
$do->doBind();
    
if (intval(CValue::post("del"))) {
  $do->doDelete();
}
else {
  // Verification de la non existence d'un utilisateur avec le même login
  $otherUser = new CUser;
  $where = array();
  $where["user_username"] = $ds->prepare("= %", $do->_obj->user_username);
  $where["user_id"]       = $ds->prepare("!= %", $do->_obj->user_id);
  $otherUser->loadObject($where);
  if ($otherUser->user_id) {
    CAppUI::setMsg("Login déjà existant dans la base", UI_MSG_ERROR);
  }
  else {
    $do->doStore();
  }
}
$do->doRedirect();
