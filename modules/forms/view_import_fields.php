<?php
/**
 * $Id: view_import_fields.php 17759 2013-01-14 11:27:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 17759 $
 */

CCanDo::checkAdmin();

$classes = array(
  "CExClass" => "do_import_fields",
  "CExClassFieldGroup" => "do_import_groups",
);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("classes", $classes);
$smarty->display("view_import_fields.tpl");
