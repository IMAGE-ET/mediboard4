<?php
/**
 * $Id: ajax_edit_repartition.php 21402 2013-12-13 13:43:06Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21402 $
 */

CCanDo::checkEdit();
$facture_id    = CValue::getOrSession("facture_id");
$facture_class = CValue::getOrSession("facture_class");

/* @var CFacture $facture*/
$facture = new $facture_class;
$facture->load($facture_id);
$facture->loadRefsObjects();

$montant_total = $facture->du_tiers + $facture->du_patient;

// Creation du template
$smarty = new CSmartyDP();

$smarty->assign("facture"       , $facture);
$smarty->assign("montant_total" , $montant_total);
$smarty->assign("consult"       , $facture->_ref_first_consult);

$smarty->display("edit_repartition.tpl");