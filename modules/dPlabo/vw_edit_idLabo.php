<?php
/**
 * $Id: vw_edit_idLabo.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

global $can, $m, $g;

$can->needsAdmin();

// Last update
$today = CMbDT::dateTime();

// Chargement des praticiens de l'établissement
$praticien = new CMediusers();
$praticiens = $praticien->loadPraticiens();
$listPraticiens = array();

foreach ($praticiens as $key => $praticien) {
  $listPraticiens[$key]["prat"] = $praticien;
  $praticien->loadLastId400("labo code4");
  $listPraticiens[$key]["code4"]= $praticien->_ref_last_id400;
  $praticien->loadLastId400("labo code9");
  $listPraticiens[$key]["code9"]= $praticien->_ref_last_id400;
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("today"     , $today);
$smarty->assign("listPraticiens", $listPraticiens);

$smarty->display("vw_edit_idLabo.tpl");
