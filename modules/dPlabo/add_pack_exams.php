<?php
/**
 * $Id: add_pack_exams.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

//Chargement de tous les catalogues
$catalogue = new CCatalogueLabo;
$where = array("pere_id" => "IS NULL");
$order = "identifiant";
$listCatalogues = $catalogue->loadList($where, $order);
foreach ($listCatalogues as $key => $curr_catalogue) {
  $listCatalogues[$key]->loadRefsDeep();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("listCatalogues", $listCatalogues);

$smarty->display("add_packs_exams.tpl");
