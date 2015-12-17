<?php
/**
 * $Id$
 *
 * @package    Mediboard
 * @subpackage Hospi
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision$
 */

CCanDo::checkRead();

$printer_id = CView::get("printer_id", "num default|0", true);

CView::checkin();

$printer = new CPrinter();
$printer->load($printer_id);

if ($printer->_id) {
  $printer->loadTargetObject();
}

$source = new CSourceLPR();
$sources = $source->loadlist();

$source = new CSourceSMB();
$sources = array_merge($sources, $source->loadlist());

$function  = new CFunctions();
$where = array(
  "group_id" => "= '" . CGroups::loadCurrent()->_id . "'"
);
$functions = $function->loadListWithPerms(PERM_READ, $where, "text");

$smarty = new CSmartyDP();

$smarty->assign("printer"  , $printer);
$smarty->assign("sources"  , $sources);
$smarty->assign("functions", $functions);

$smarty->display("inc_edit_printer.tpl");

