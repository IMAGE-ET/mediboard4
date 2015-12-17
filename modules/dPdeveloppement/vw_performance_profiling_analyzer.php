<?php
/**
 * $Id: vw_performance_profiling_analyzer.php 22563 2014-03-24 09:14:53Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 22563 $
 */

CCanDo::checkAdmin();

$smarty = new CSmartyDP();
$smarty->display("vw_performance_timing_analyzer.tpl");
