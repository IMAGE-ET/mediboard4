<?php
/**
 * $Id: ajax_edit_ex_class_event.php 22777 2014-04-09 08:39:18Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 22777 $
 */

CCanDo::checkEdit();

$ex_class_event_id = CValue::get("ex_class_event_id");
$ex_class_id       = CValue::get("ex_class_id");

$ex_class_event = new CExClassEvent;
$ex_class_event->load($ex_class_event_id);

$host_object = null;
$reference1 = null;
$reference2 = null;

/** @var CEnumSpec $unicity_spec */
$unicity_spec = $ex_class_event->_specs["unicity"];

// mise a jour des specs de l'unicit� pour etre plus user friendly
if ($ex_class_event->_id) {
  $ex_class_event->loadRefsConstraints();
  $ex_class_event->loadRefsNotes();
  $ex_class_event->getHostClassOptions();

  foreach ($ex_class_event->_ref_constraints as $_ex_constraint) {
    $_ex_constraint->loadTargetObject();
    if ($_ex_constraint->_ref_target_object instanceof CMediusers) {
      $_ex_constraint->_ref_target_object->loadRefFunction();
    }
  }

  $unicity_spec->_locales["host"] = "Unique pour <strong>".CAppUI::tr($ex_class_event->host_class)."</strong>";

  if ($ex_class_event->host_class != "CMbObject" && $ex_class_event->host_class) {
    $host_object = new $ex_class_event->host_class;

    $reference1_class = $ex_class_event->_host_class_options["reference1"][0];
    $reference1  = new $reference1_class;

    $reference2_class = $ex_class_event->_host_class_options["reference2"][0];
    $reference2  = new $reference2_class;
  }
}
else {
  $ex_class_event->disabled = "1"; // The quotes are important !
  $ex_class_event->ex_class_id = $ex_class_id;
  $unicity_spec->_locales["host"] = "Unique pour <strong>".$unicity_spec->_locales["host"]."</strong>";
}

$classes = CExClassEvent::getExtendableSpecs();
$ex_object = new CExObject($ex_class_event->ex_class_id);

// Cr�ation du template
$smarty = new CSmartyDP();
$smarty->assign("ex_class_event", $ex_class_event);
$smarty->assign("ex_object", $ex_object);
$smarty->assign("host_object", $host_object);
$smarty->assign("reference1", $reference1);
$smarty->assign("reference2", $reference2);
$smarty->assign("classes", $classes);
$smarty->display("inc_edit_ex_class_event.tpl");
