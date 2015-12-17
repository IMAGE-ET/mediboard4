<?php
/**
 * $Id: httpreq_vw_packs.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();
$user = CMediusers::get();

$pack_examens_labo_id = CValue::getOrSession("pack_examens_labo_id");
$typeListe            = CValue::getOrSession("typeListe");
$dragPacks            = CValue::get("dragPacks", 0);

// Chargement des fontions
$function = new CFunctions;
$listFunctions = $function->loadListWithPerms(PERM_EDIT);

// Chargement du pack demandé
$pack = new CPackExamensLabo;
$pack->load($pack_examens_labo_id);
$pack->loadRefs();

//Chargement de tous les packs
$where = array("function_id IS NULL OR function_id ".CSQLDataSource::prepareIn(array_keys($listFunctions)));
$where["obsolete"] = " = '0'";

$order = "libelle";
$listPacks = $pack->loadList($where, $order);
foreach ($listPacks as $key => $curr_pack) {
  $listPacks[$key]->loadRefs();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("listPacks", $listPacks);
$smarty->assign("pack"     , $pack     );
$smarty->assign("dragPacks", $dragPacks);

$smarty->display("inc_vw_packs.tpl");
