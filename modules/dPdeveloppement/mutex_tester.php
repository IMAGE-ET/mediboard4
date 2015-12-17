<?php
/**
 * $Id: mutex_tester.php 24629 2014-09-02 10:47:02Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24629 $
 */

CCanDo::checkRead();

$actions = array(
  "stall",
  "die",
  "run",
  "lock",
  "dummy",
);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("actions", $actions);

$smarty->display("mutex_tester.tpl");
