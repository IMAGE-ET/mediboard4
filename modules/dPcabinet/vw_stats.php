<?php
/**
 * $Id: vw_stats.php 21492 2013-12-20 09:24:10Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21492 $
 */

CCanDo::checkRead();
// Current user
$mediuser = CMediusers::get();

// Filter
$filter = new CPlageconsult();
$filter->_date_min  = CMbDT::date("last month");
$filter->_date_max  = CMbDT::date();

$functions = CMediusers::loadFonctions(PERM_EDIT, null, "cabinet");
$users = $mediuser->loadPraticiens();

$smarty = new CSmartyDP();

$smarty->assign("filter"    , $filter);
$smarty->assign("users"     , $users);
$smarty->assign("functions" , $functions);

$smarty->display("vw_stats.tpl");
