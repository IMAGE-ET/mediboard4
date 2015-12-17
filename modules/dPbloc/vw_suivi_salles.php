<?php
/**
 * $Id: vw_suivi_salles.php 23618 2014-06-19 11:03:43Z flaviencrochard $
 *
 * @package    Mediboard
 * @subpackage Bloc
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 23618 $
 */

CCanDo::checkRead();

$bloc_id = CValue::getOrSession("bloc_id");

/** @var CBlocOperatoire[] $listBlocs */
$listBlocs  = CGroups::loadCurrent()->loadBlocs(PERM_READ, null, "nom");
$date_suivi = CAppUI::pref("suivisalleAutonome") ? CValue::get("date", CMbDT::date()) : CValue::getOrSession("date", CMbDT::date());

$smarty = new CSmartyDP();

$smarty->assign("bloc_id"   , $bloc_id);
$smarty->assign("blocs"     , $listBlocs);
$smarty->assign("first_bloc", reset($listBlocs));
$smarty->assign("date"      , $date_suivi);

$smarty->display("vw_suivi_salles.tpl");