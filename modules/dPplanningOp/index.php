<?php
/**
 * $Id: index.php 21802 2014-01-29 10:17:10Z nicolasld $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21802 $
 */

$user = CMediusers::get();

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("vw_idx_planning"   , TAB_EDIT);

// Possibilité de planifier des séjours
$module->registerTab("vw_edit_sejour"    , TAB_READ);
//$sejour = new CSejour();
//if ($sejour->canDo()->read) {
//  $module->registerTab("vw_edit_sejour", TAB_READ);
//}

// Possibilité de planifier des interventions
$module->registerTab("vw_edit_planning"  , TAB_EDIT);
//$interv = new COperation();
//if ($interv->canDo()->read) {
//  $module->registerTab("vw_edit_planning", TAB_READ);
//}

// Possibilité de planifier des interventions hors plage
$hors_plage = new CIntervHorsPlage();
if ($hors_plage->canDo()->read) {
  $module->registerTab("vw_edit_urgence" , TAB_READ);
}

$module->registerTab("vw_protocoles"     , TAB_EDIT);
$module->registerTab("vw_edit_typeanesth", TAB_ADMIN);
$module->registerTab("vw_idx_colors"     , TAB_ADMIN);
$module->registerTab("vw_sectorisations" , TAB_ADMIN);


// Droit d'acces a l'onglet seulement si on est praticien ou admin
if (($user->isPraticien() || $user->isFromType(array("Administrator"))) && CAppUI::conf("dPsalleOp CActeCCAM tarif")) {
  $module->registerTab("vw_edit_compta", TAB_EDIT);
}

$module->registerTab("vw_parametrage", TAB_ADMIN);