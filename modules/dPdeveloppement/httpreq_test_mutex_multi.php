<?php
/**
 * $Id: httpreq_test_mutex_multi.php 24615 2014-09-01 10:52:44Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24615 $
 */

CCanDo::checkRead();

$sleep = 5;

$i        = CValue::get("i");
$duration = CValue::get("duration", 10);

$colors = array(
  "#f00",
  "#0f0",
  "#09f",
  "#ff0",
  "#f0f",
  "#0ff",
);

// Remove session lock
CSessionHandler::writeClose();

$mutex = new CMbMutex("test", isset($colors[$i]) ? $colors[$i] : null);
$time = $mutex->acquire($duration);

sleep($sleep);

$mutex->release();

$data = array(
  "driver" => get_class($mutex->getDriver()),
  "i"      => $i,
  "time"   => $time,
);

ob_clean();
echo json_encode($data);
CApp::rip();
