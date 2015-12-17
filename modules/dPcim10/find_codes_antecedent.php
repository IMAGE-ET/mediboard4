<?php
/**
 * $Id: find_codes_antecedent.php 22689 2014-04-01 12:43:41Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Cim10
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 22689 $
 */

CCanDo::checkRead();
$mater = CValue::get("mater");

$code = $mater ? "O74" : "T88";
$cim10 = CCodeCIM10::get($code, CCodeCIM10::FULL);

$smarty = new CSmartyDP();

$smarty->assign("cim10" , $cim10);

$smarty->display("find_codes_antecedent.tpl");
