<?php 

/**
 * $Id: vw_import_patients.php 28261 2015-05-12 15:23:56Z phenxdesign $
 *  
 * @category Patients
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28261 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$step            = CValue::postOrSession("step", 100);
$start           = CValue::postOrSession("start", 0);
$directory       = CValue::postOrSession("directory");
$files_directory = CValue::postOrSession("files_directory");

$smarty = new CSmartyDP();
$smarty->assign("step", $step);
$smarty->assign("start", $start);
$smarty->assign("directory", $directory);
$smarty->assign("files_directory", $files_directory);
$smarty->display("vw_import_patients.tpl");
