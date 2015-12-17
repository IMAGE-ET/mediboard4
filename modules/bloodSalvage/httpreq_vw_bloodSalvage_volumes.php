<?php
/**
 * $Id: httpreq_vw_bloodSalvage_volumes.php 20938 2013-11-13 11:02:47Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage bloodSalvage
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20938 $
 */

CCanDo::checkRead();
$blood_salvage_id = CValue::postOrSession("blood_salvage_id");

$blood_salvage = new CBloodSalvage();
if ($blood_salvage_id) {
  $blood_salvage->load($blood_salvage_id);
  $blood_salvage->loadRefs();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("blood_salvage", $blood_salvage);

$smarty->display("inc_vw_cell_saver_volumes.tpl");
