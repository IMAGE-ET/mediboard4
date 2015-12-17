<?php

/**
 * $Id: vw_edit_tokens.php 18997 2013-05-02 09:24:16Z rhum1 $
 *
 * @category Admin
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 18997 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

$token_id = CValue::getOrSession("token_id");

$smarty = new CSmartyDP();
$smarty->assign("token_id", $token_id);
$smarty->display("vw_edit_tokens.tpl");
