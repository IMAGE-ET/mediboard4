<?php
/**
 * $Id: vw_debiteurs.php 19878 2013-07-11 15:30:26Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19878 $
 */

CCanDo::checkEdit();

$debiteur = new CDebiteur();
$debiteurs = $debiteur->loadList(null, "numero");

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("debiteurs", $debiteurs);

$smarty->display("vw_debiteurs.tpl");
