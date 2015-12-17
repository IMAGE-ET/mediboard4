<?php
/**
 * $Id: httpreq_vw_object_value.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */
 
CCanDo::checkRead();

$class = CValue::get('class');
$id    = CValue::get('id');
$field = CValue::get('field');

$object = null;

// Loads the expected Object
if (class_exists($class)) {
  $object = new $class;
  $object->load($id);
  if (!$object->canRead()) {
    CApp::rip();
  }
}

// Smarty template
$smarty = new CSmartyDP();

$smarty->assign('object', $object);
$smarty->assign('field',  $field);

$smarty->display('inc_object_value.tpl');
