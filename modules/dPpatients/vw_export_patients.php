<?php

/**
 * $Id: vw_export_patients.php 28785 2015-06-30 08:54:31Z phenxdesign $
 *
 * @category Patients
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28785 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$praticien_id = CValue::postOrSession("praticien_id");
$step         = CValue::postOrSession("step", 100);
$start        = CValue::postOrSession("start", 0);
$directory    = CValue::postOrSession("directory");
$all_prats    = CValue::postOrSession("all_prats");
$ignore_files = CValue::postOrSession("ignore_files");
$generate_pdfpreviews = CValue::postOrSession("generate_pdfpreviews");
$date_min     = CValue::postOrSession("date_min");

$praticien = new CMediusers();
$praticiens = $praticien->loadPraticiens();

if (!$praticien_id) {
  $praticien_id = array();
}

$smarty = new CSmartyDP();
$smarty->assign("praticiens", $praticiens);
$smarty->assign("praticien_id", $praticien_id);
$smarty->assign("all_prats", $all_prats);
$smarty->assign("step", $step);
$smarty->assign("start", $start);
$smarty->assign("directory", $directory);
$smarty->assign("ignore_files", $ignore_files);
$smarty->assign("generate_pdfpreviews", $generate_pdfpreviews);
$smarty->assign("date_min", $date_min);
$smarty->display("vw_export_patients.tpl");
