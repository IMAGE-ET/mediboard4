<?php
/**
 * $Id: configure.php 20186 2013-08-19 07:47:12Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Hospi
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20186 $
 */

CCanDo::checkAdmin();

$service = new CService();
$service->group_id = CGroups::loadCurrent()->_id;
$service->cancelled = 0;
$order = "nom ASC";
$services = $service->loadMatchingList($order);

$sejour = new CSejour();
$types_admission = $sejour->_specs["type"]->_locales;

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("types_admission", $types_admission);
$smarty->assign("services"       , $services);
$smarty->display("configure.tpl");

