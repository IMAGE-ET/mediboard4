<?php
/**
 * $Id: vw_daily_check_list_preview.php 25685 2014-11-03 15:34:02Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25685 $
 */

CCanDo::checkEdit();

$object_class = CValue::get("object_class");
$object_id    = CValue::get("object_id");
$type         = CValue::get("type", "ouverture_salle");

$object = CMbObject::loadFromGuid("$object_class-$object_id");

// Vérification de la check list journalière
$daily_check_lists = array();
$daily_check_list_types = array();

list($check_list_not_validated, $daily_check_list_types, $daily_check_lists) = CDailyCheckList::getCheckLists($object, "1970-01-01", $type);

$validateur = new CPersonnel();
$validateur->_ref_user = new CMediusers();
$validateur->_ref_user->_view = "Validateur test";

$listValidateurs = array(
  $validateur
);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("daily_check_lists" , $daily_check_lists);
$smarty->assign("listValidateurs"   , $listValidateurs);
$smarty->display("vw_daily_check_list_preview.tpl");
