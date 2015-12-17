<?php
/**
 * $Id: ajax_vw_attente.php 22288 2014-03-04 10:34:24Z nicolasld $
 *
 * @package    Mediboard
 * @subpackage Urgences
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 22288 $
 */

$attente = CValue::get("attente");
$rpu_id  = CValue::get("rpu_id");

// Chargement du rpu
$rpu = new CRPU();
$rpu->load($rpu_id);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("rpu", $rpu);
$smarty->assign("imagerie_etendue", CAppUI::conf("dPurgences CRPU imagerie_etendue", CGroups::loadCurrent()));
if (!$attente) {
  $smarty->display("inc_vw_rpu_attente.tpl");
}
else {
  $smarty->assign("debut", CValue::get("debut"));
  $smarty->assign("fin", CValue::get("fin"));
  $smarty->display("inc_vw_fin_attente.tpl");
}
