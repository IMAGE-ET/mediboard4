<?php
/**
 * $Id: ajax_quick_evenement_perop.php 26484 2014-12-18 09:07:56Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26484 $
 */

$operation_id = CValue::get("operation_id");

$interv = new COperation;
$interv->load($operation_id);
$interv->loadComplete();

$user_id = $interv->anesth_id ?: CMediusers::get()->_id;

$evenement = new CAnesthPerop();
$evenement->loadAides($user_id);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("evenement", $evenement);
$smarty->assign("operation", $interv);
$smarty->display("inc_quick_evenement_perop.tpl");
