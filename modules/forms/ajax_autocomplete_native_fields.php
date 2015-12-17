<?php
/**
 * $Id: ajax_autocomplete_native_fields.php 18597 2013-03-28 15:57:50Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 18597 $
 */

CCanDo::checkEdit();

$keywords = CValue::get("_native_field_view");

$list = CExConcept::getReportableFields();

$show_views = false;

// filtrage
if ($keywords) {
  $show_views = true;

  $re = preg_quote($keywords);
  $re = CMbString::allowDiacriticsInRegexp($re);
  $re = str_replace("/", "\\/", $re);
  $re = "/($re)/i";

  foreach ($list as $_key => $element) {
    if (!preg_match($re, $element["title"])) {
      unset($list[$_key]);
    }
  }
}

$smarty = new CSmartyDP();
$smarty->assign("host_fields", $list);
$smarty->assign("show_views", $show_views);
$smarty->assign("show_class", true);
$smarty->display("inc_autocomplete_native_fields.tpl");
