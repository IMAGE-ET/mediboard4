<?php
/**
 * $Id: httpreq_vw_deliveries_list.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */

CCanDo::checkRead();

$order_by = 'date_dispensation DESC';
$delivery = new CProductDelivery();

$list_latest_deliveries = $delivery->loadList(null, $order_by, 20);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign('list_latest_deliveries',  $list_latest_deliveries);
$smarty->display('inc_deliveries_list.tpl');

