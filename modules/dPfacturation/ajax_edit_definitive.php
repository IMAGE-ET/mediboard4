<?php
/**
 * $Id: ajax_edit_definitive.php 20502 2013-09-30 13:10:20Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20502 $
 */
CCanDo::checkEdit();
$facture_class  = CValue::get("facture_class", "CFactureCabinet");
$facture_id     = CValue::get("facture_id");

$facture = new $facture_class;
$facture->load($facture_id);

// Creation du template
$smarty = new CSmartyDP();

$smarty->assign("facture",  $facture);

$smarty->display("vw_edit_definitive.tpl");
