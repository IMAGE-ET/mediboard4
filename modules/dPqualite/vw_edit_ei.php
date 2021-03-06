<?php
/**
 * $Id: vw_edit_ei.php 28539 2015-06-08 13:30:16Z armengaudmc $
 *
 * @package    Mediboard
 * @subpackage Qualite
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28539 $
 */

CCanDo::checkAdmin();

$ei_categorie_id = CValue::getOrSession("ei_categorie_id", 0);
$ei_item_id      = CValue::getOrSession("ei_item_id", 0);
$vue_item        = CValue::getOrSession("vue_item", 0);


// Cat�gorie demand�e
$categorie = new CEiCategorie();
if (!$categorie->load($ei_categorie_id)) {
  // Cette cat�gorie n'est pas valide
  $ei_categorie_id = null;
  CValue::setSession("ei_categorie_id");
  $categorie = new CEiCategorie();
}
else {
  $categorie->loadRefsBack();
}

// Item demand�
$item = new CEiItem;
if (!$item->load($ei_item_id)) {
  // Cet item n'est pas valide
  $ei_item_id = null;
  CValue::setSession("ei_item_id");
  $item = new CEiItem();
}
else {
  $item->loadRefsFwd();
}

// Liste des Cat�gories
$listCategories = $categorie->loadList(null, "nom");

// Liste des Items
$where = null;
if ($vue_item) {
  $where = "ei_categorie_id = '$vue_item'";
}
/** @var CEiItem[] $listItems */
$listItems = $item->loadList($where, "ei_categorie_id, nom");
foreach ($listItems as $_item) {
  $_item->loadRefsFwd();
}

$smarty = new CSmartyDP();

$smarty->assign("categorie"      , $categorie);
$smarty->assign("item"           , $item);
$smarty->assign("listCategories" , $listCategories);
$smarty->assign("listItems"      , $listItems);
$smarty->assign("vue_item"       , $vue_item);

$smarty->display("vw_edit_ei.tpl"); 
