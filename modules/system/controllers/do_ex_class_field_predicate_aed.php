<?php
/**
 * $Id: do_ex_class_field_predicate_aed.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

$ex_class_field_id = CValue::post("ex_class_field_id");

$ex_class_field = new CExClassField;
$ex_class_field->load($ex_class_field_id);

if (empty($_POST["value"])) {
  $_POST["value"] = $_POST[$ex_class_field->name];
}

$do = new CDoObjectAddEdit("CExClassFieldPredicate");
$do->doIt();
