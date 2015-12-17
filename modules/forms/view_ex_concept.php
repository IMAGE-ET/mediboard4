<?php
/**
 * $Id: view_ex_concept.php 17759 2013-01-14 11:27:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 17759 $
 */

CCanDo::checkEdit();

$_GET["object_class"] = "CExConcept";

//$_GET["col"] = array("name");

CAppUI::requireModuleFile("system", "vw_object_tree_explorer");
