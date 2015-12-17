<?php
/**
 * $Id: ajax_edit_debiteur.php 19878 2013-07-11 15:30:26Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19878 $
 */
CCanDo::checkEdit();
$debiteur_id = CValue::get("debiteur_id");

$debiteur = new CDebiteur();
$debiteur->load($debiteur_id);

// Creation du template
$smarty = new CSmartyDP();

$smarty->assign("debiteur",  $debiteur);
$smarty->assign("debiteur_dec",  CValue::get("debiteur_desc", 0));

$smarty->display("vw_edit_debiteur.tpl");
