<?php
/**
 * $Id: vw_echeancier.php 21298 2013-12-05 15:30:05Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21298 $
 */
CCanDo::checkEdit();
$facture_id    = CValue::getOrSession("facture_id");
$facture_class = CValue::getOrSession("facture_class");

$facture = new $facture_class;
$facture->load($facture_id);
$facture->loadRefsEcheances();

// Creation du template
$smarty = new CSmartyDP();

$smarty->assign("facture"  , $facture);

$smarty->display("vw_echeancier.tpl");