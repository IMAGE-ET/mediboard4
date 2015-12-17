<?php
/**
 * $Id: cache_tester.php 24615 2014-09-01 10:52:44Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24615 $
 */

CCanDo::checkRead();

/** @var int $times */
$times    = CView::get("times"    , "num notNull pos max|100 default|20");
/** @var int $duration */
$duration = CView::get("duration" , "num notNull pos max|60 default|1");
/** @var bool $do */
$do       = CView::get("do"       , "bool"               );

CView::checkin();
CView::enforceSlave();

$reports = array();

$error_reporting = error_reporting(0);

if ($do) {
  $steps = $times;
  while ($steps--) {
    // dummy query
    $user = new CUser();
    $user->countList();
    $ds = $user->getDS();
    $reports[] = array(
      "time"  => CMbDT::time(),
      "dsn"   => $ds->dsn,
      "errno" => $ds->errno(),
      "error" => $ds->error(),
    );
    sleep($duration);
  }
}

error_reporting($error_reporting);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("times", $times);
$smarty->assign("duration", $duration);
$smarty->assign("do", $do);
$smarty->assign("reports", $reports);
$smarty->display("slave_tester.tpl");