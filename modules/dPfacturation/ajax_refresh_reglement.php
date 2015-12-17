<?php
/**
 * $Id: ajax_refresh_reglement.php 19168 2013-05-16 12:20:07Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 19168 $
 */
CCanDo::checkEdit();
$facture_id   = CValue::getOrSession("facture_id");
$object_class = CValue::getOrSession("object_class");

$facture = new $object_class;
$facture->load($facture_id);
$facture->loadRefsObjects();
$facture->loadRefsReglements();
$facture->loadRefsNotes();

$reglement = new CReglement();

// Chargement des banques
$orderBanque = "nom ASC";
$banque = new CBanque();
$banques = $banque->loadList(null, $orderBanque);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("facture"       , $facture);
$smarty->assign("banques"       , $banques);
$smarty->assign("reglement"     , $reglement);
$smarty->assign("date"          , CMbDT::date());

$smarty->display("inc_vw_reglements.tpl");
?>