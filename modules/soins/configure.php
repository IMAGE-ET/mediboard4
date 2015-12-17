<?php
/**
 * $Id: configure.php 23698 2014-06-25 15:41:23Z aurelie17 $
 *
 * @category Soins
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 23698 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$service = new CService();
$where = array();
$where["group_id"]  = "= '".CGroups::loadCurrent()->_id."'";
$where["cancelled"] = "= '0'";
$order = "nom";
$services = $service->loadListWithPerms(PERM_READ,$where, $order);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("services" , $services);

$smarty->display("configure.tpl");