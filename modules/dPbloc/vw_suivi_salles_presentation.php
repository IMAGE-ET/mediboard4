<?php
/**
 * $Id: vw_suivi_salles_presentation.php 28747 2015-06-27 07:33:26Z flaviencrochard $
 *
 * @package    Mediboard
 * @subpackage Bloc
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28747 $
 */

CCanDo::checkRead();

$bloc_id = CValue::getOrSession("bloc_id");

$date_suivi = CAppUI::pref("suivisalleAutonome") ? CMbDT::date() : CValue::getOrSession("date", CMbDT::date());

$smarty = new CSmartyDP();

$smarty->assign("bloc_id", $bloc_id);
$smarty->assign("date"   , $date_suivi);

$smarty->display("vw_suivi_salles_presentation.tpl");