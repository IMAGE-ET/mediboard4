<?php
/**
 * $Id: ajax_vw_list_cpi.php 23634 2014-06-20 07:36:09Z asmiane $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 23634 $
 */

CCanDo::checkRead();

$group_id    = CValue::get("group_id", CGroups::loadCurrent()->_id);
$type        = CValue::get("type");
$selected_id = CValue::get("selected_id");

$cpi = new CChargePriceIndicator;
$cpi->group_id = $group_id;
$cpi->actif    = 1;

if ($type) {
  $cpi->type = $type;
}

$cpi_list = $cpi->loadMatchingList("libelle");

$smarty = new CSmartyDP();
$smarty->assign("cpi_list", $cpi_list);
$smarty->assign("selected_id", $selected_id);
$smarty->display("inc_list_cpi.tpl");
