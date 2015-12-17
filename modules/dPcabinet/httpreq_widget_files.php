<?php
/**
 * $Id: httpreq_widget_files.php 27440 2015-03-04 16:26:14Z mytto $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27440 $
 */

CCanDo::check();

$object = mbGetObjectFromGet("object_class", "object_id", "object_guid");
$only_files = CValue::get("only_files", 0);
$name_readonly = CValue::get("name_readonly", 0);

// Chargement des fichiers
$object->loadRefsFiles();
$object->canDo();

if ($object->_ref_files) {
  foreach ($object->_ref_files as $_file) {
    $_file->canDo();
  }
}

$file = new CFile;

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("object", $object);
$smarty->assign("can_files", $file->canClass());
$smarty->assign("name_readonly", $name_readonly);

$smarty->display($only_files ? "inc_widget_list_files.tpl" : "inc_widget_vw_files.tpl");
