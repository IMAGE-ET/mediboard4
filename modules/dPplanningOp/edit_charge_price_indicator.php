<?php
/**
 * $Id: edit_charge_price_indicator.php 19840 2013-07-09 19:36:14Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19840 $
 */

CCanDo::checkAdmin();

$charge_id = CValue::get("charge_id");

$charge = new CChargePriceIndicator;
$charge->load($charge_id);
$charge->loadRefsNotes();
if (!$charge->_id) {
  $charge->group_id = CGroups::loadCurrent()->_id;
}

$smarty = new CSmartyDP();
$smarty->assign("charge", $charge);
$smarty->display("inc_edit_charge_price_indicator.tpl");
