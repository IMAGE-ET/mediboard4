<?php

/**
 * $Id: ajax_get_random_password.php 26217 2014-12-05 14:20:59Z kgrisel $
 *
 * @category Admin
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 26217 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkRead();

$class = CValue::get("object_class");
$field = CValue::get("field");

$object = new $class();

do {
  $object->{$field} = CPasswordSpec::randomString(array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z')), 8);
}
while ($object->_specs[$field]->checkProperty($object));

echo json_encode($object->{$field});