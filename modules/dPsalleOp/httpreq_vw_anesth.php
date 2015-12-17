<?php
/**
 * $Id: httpreq_vw_anesth.php 24175 2014-07-28 09:17:55Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24175 $
 */

CCanDo::checkRead();
$operation_id = CValue::getOrSession("operation_id");
$date         = CValue::getOrSession("date", CMbDT::date());
$modif_operation = CCanDo::edit() || $date >= CMbDT::date();

$operation = new COperation();
$protocoles = array();
$anesth_id = "";

if ($operation_id) {
  $operation->load($operation_id);
  $operation->loadRefs();
}

// Chargement des praticiens
$listAnesths = new CMediusers();
$listAnesths = $listAnesths->loadAnesthesistes(PERM_DENY);

$listChirs = new CMediusers();
$listChirs = $listChirs->loadPraticiens(PERM_READ);

$listAnesthType = new CTypeAnesth();
$listAnesthType = $listAnesthType->loadGroupList();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("listAnesthType"  , $listAnesthType  );
$smarty->assign("listAnesths"     , $listAnesths     );
$smarty->assign("listChirs"       , $listChirs       );
$smarty->assign("selOp"           , $operation       );
$smarty->assign("date"            , $date            );
$smarty->assign("modif_operation" , $modif_operation );
$smarty->assign("anesth_id"       , $anesth_id);
$smarty->display("inc_vw_anesth.tpl");
