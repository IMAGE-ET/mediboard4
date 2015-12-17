<?php
/**
 * $Id: about.php 27867 2015-04-04 15:47:56Z mytto $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27867 $
 */

CCanDo::checkRead();
CView::checkin();

$smarty = new CSmartyDP();
$smarty->display("about.tpl");

