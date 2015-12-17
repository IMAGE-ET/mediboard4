<?php 

/**
 * $Id: ajax_ex_list_info.php 24472 2014-08-20 07:38:29Z phenxdesign $
 *  
 * @category Forms
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 24472 $
 * @link     http://www.mediboard.org
 */

$list_id = CValue::get("list_id");

$list = new CExList();
$list->load($list_id);
$list->loadRefItems();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("list", $list);
$smarty->display("inc_ex_list_info.tpl");