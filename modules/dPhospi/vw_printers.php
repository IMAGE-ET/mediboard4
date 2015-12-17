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

$smarty = new CSmartyDP();

$smarty->assign("printer_id", $printer_id);

$smarty->display("vw_printers.tpl");
