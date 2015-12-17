<?php
/**
 * $Id: edit_params.php 19621 2013-06-20 20:40:45Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage GestionCab
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19621 $
 */

CCanDo::checkRead();

$employecab_id = CValue::getOrSession("employecab_id", null);

$user = CMediusers::get();

$employe = new CEmployeCab;
$where = array();
$where["function_id"] = "= '$user->function_id'";

$listEmployes = $employe->loadList($where);
if ($employecab_id) {
  $employe =& $listEmployes[$employecab_id];
}
else {
  $employe->function_id = $user->function_id;
}

$paramsPaie = new CParamsPaie();
if ($employe->employecab_id) {
  $paramsPaie->loadFromUser($employe->employecab_id);
  $paramsPaie->loadRefsFwd();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("employe"      , $employe);
$smarty->assign("paramsPaie"   , $paramsPaie);
$smarty->assign("listEmployes" , $listEmployes);

$smarty->display("edit_params.tpl");
