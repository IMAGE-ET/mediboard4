<?php
/**
 * $Id: httpreq_vw_bs_sspi_timing.php 20938 2013-11-13 11:02:47Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage bloodSalvage
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20938 $
 */

CCanDo::checkRead();
$blood_salvage_id = CValue::getOrSession("blood_salvage_id");
$date             = CValue::getOrSession("date", CMbDT::date());
$timing           = CValue::getOrSession("timing");
$modif_operation  = CCanDo::edit() || $date >= CMbDT::date();


$blood_salvage = new CBloodSalvage();
if ($blood_salvage_id) {
  $blood_salvage->load($blood_salvage_id);
  $blood_salvage->loadRefsFwd();
  $blood_salvage->loadRefPlageOp();

  $timing["_recuperation_end"]         = array();
  $timing["_transfusion_start"]        = array();
  $timing["_transfusion_end"]          = array();
  $max_add_minutes = CAppUI::conf("dPsalleOp max_add_minutes");
  foreach ($timing as $key => $value) {
    for ($i = -CAppUI::conf("dPsalleOp max_sub_minutes"); $i < $max_add_minutes && $blood_salvage->$key !== null; $i++) {
      $timing[$key][] = CMbDT::time("$i minutes", $blood_salvage->$key);
    }
  }
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("blood_salvage"  , $blood_salvage  );
$smarty->assign("date"           , $date           );
$smarty->assign("modif_operation", $modif_operation);
$smarty->assign("timing",          $timing);

$smarty->display("inc_vw_bs_sspi_timing.tpl");
