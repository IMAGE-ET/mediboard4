<?php
/**
 * $Id: httpreq_get_object_value.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

CCanDo::checkRead();

$class           = CValue::get('class');
$id              = CValue::get('id');
$field           = CValue::get('field');
$content_type    = CValue::get('content_type');
$formatted_value = CValue::get('formatted_value');

// Loads the expected Object
if (class_exists($class)) {
  /** @var CMbObject $object */
  $object = new $class;
  $object->load($id);
}

if ($content_type) {
  header("Content-Type: $content_type");
}

if ($formatted_value) {
  echo $object->getFormattedValue($field);
}
else {
  echo $object->$field;
}


