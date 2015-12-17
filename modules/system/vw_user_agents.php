<?php
/**
 * $Id: vw_user_agents.php 24545 2014-08-25 08:43:56Z kgrisel $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24545 $
 */

CCanDo::checkRead();

$min_date = CValue::getOrSession("ua_min_date", CMbDT::date("-1 WEEK") . " 00:00:00");
$max_date = CValue::getOrSession("ua_max_date", CMbDT::date("+1 DAY") . " 00:00:00");

$smarty = new CSmartyDP();
$smarty->assign("min_date", $min_date);
$smarty->assign("max_date", $max_date);
$smarty->display("vw_user_agents.tpl");
