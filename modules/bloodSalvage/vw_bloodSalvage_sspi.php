<?php
/**
 * $Id: vw_bloodSalvage_sspi.php 20938 2013-11-13 11:02:47Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage bloodSalvage
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20938 $
 */

CAppUI::requireModuleFile("bloodSalvage", "inc_personnel");

$selOp = new COperation;
$blood_salvage  = new CBloodSalvage();
$date           = CValue::getOrSession("date", CMbDT::date());
$op             = CValue::getOrSession("op");

if ($op) {
  $selOp->load($op);
  $selOp->loadRefs();
  $where = array();
  $where["operation_id"] = "='$selOp->_id'";  
  $blood_salvage->loadObject($where);
  $blood_salvage->loadRefsFwd();
  $blood_salvage->loadRefPlageOp();
}

$smarty = new CSmartyDP();

$smarty->assign("date",           $date);
$smarty->assign("blood_salvage",  $blood_salvage);
$smarty->assign("selOp",          $selOp);

$smarty->display("vw_bloodSalvage_sspi.tpl");
