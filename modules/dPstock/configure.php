<?php
/**
 * $Id: configure.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */

CCanDo::checkAdmin();

$group = new CGroups;
$groups_list = $group->loadList(null, "text");

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("groups_list", $groups_list);
$smarty->display('configure.tpl');

