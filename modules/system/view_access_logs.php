<?php
/**
 * $Id: view_access_logs.php 24556 2014-08-25 15:43:49Z kgrisel $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24556 $
 */

CCanDo::checkRead();
$date     = CValue::getOrSession("date", CMbDT::date());
$groupmod = CValue::getOrSession("groupmod", 2);

// Hour range for daily stats
$hour_min = CValue::getOrSession("hour_min", "6");
$hour_max = CValue::getOrSession("hour_max", "22");
$hours    = range(0, 24);

$left_mode     = CValue::getOrSession("left_mode", "request_time"); // request_time, cpu_time, errors, memory_peak
$left_sampling = CValue::getOrSession("left_sampling", "mean"); // total, mean

$right_mode     = CValue::getOrSession("right_mode", "hits"); // hits, size
$right_sampling = CValue::getOrSession("right_sampling", "total"); // total, mean

$show_datasources = CValue::getOrSession("show_datasources", false); // Do we use DB or datasource_logs?

// Human/bot filter
$human_bot = CValue::getOrSession("human_bot", "0");

$module = null;
if (!is_numeric($groupmod)) {
  $module   = $groupmod;
  $groupmod = 0;
}

$to = CMbDT::date("+1 DAY", $date);
switch ($interval = CValue::getOrSession("interval", "one-day")) {
  default:
  case "one-day":
    $today = CMbDT::date("-1 DAY", $to);
    // Hours limitation
    $from = CMbDT::dateTime("+$hour_min HOUR", $today);
    $to   = CMbDT::dateTime("+$hour_max HOUR -1 MINUTE", $today);
    break;

  case "one-week":
    $from = CMbDT::date("-1 WEEK", $to);
    break;

  case "height-weeks":
    $from = CMbDT::date("-8 WEEKS", $to);
    break;

  case "one-year":
    $from = CMbDT::date("-1 YEAR", $to);
    break;

  case "four-years":
    $from = CMbDT::date("-4 YEARS", $to);
    break;

  case "twenty-years":
    $from = CMbDT::date("-20 YEARS", $to);
    break;
}

$smarty = new CSmartyDP();

$smarty->assign("groupmod", $groupmod);

$smarty->assign("date", $date);
$smarty->assign("hours", $hours);
$smarty->assign("hour_min", $hour_min);
$smarty->assign("hour_max", $hour_max);

$smarty->assign("left_mode", $left_mode);
$smarty->assign("left_sampling", $left_sampling);

$smarty->assign("right_mode", $right_mode);
$smarty->assign("right_sampling", $right_sampling);

$smarty->assign("module", $module);
$smarty->assign("interval", $interval);
$smarty->assign("listModules", CModule::getInstalled());

$smarty->assign("show_datasources", $show_datasources);
$smarty->assign("human_bot", $human_bot);

$smarty->display("view_access_logs.tpl");
