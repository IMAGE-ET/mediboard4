<?php
/**
 * $Id: vw_activite.php 19288 2013-05-26 19:29:05Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage dPstats
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19288 $
 */

CCanDo::checkEdit();

$debutact      = CValue::getOrSession("debutact", CMbDT::date());
$finact        = CValue::getOrSession("finact", CMbDT::date());

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("debutact", $debutact);
$smarty->assign("finact"  , $finact);

$smarty->display("vw_activite.tpl");
