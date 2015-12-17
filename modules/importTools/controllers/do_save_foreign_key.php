<?php 

/**
 * $Id: do_save_foreign_key.php 27769 2015-03-30 08:45:03Z phenxdesign $
 *  
 * @category ImportTools
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 27769 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$dsn    = CValue::post("dsn");
$table  = CValue::post("table");
$column = CValue::post("column");
$value  = CValue::post("value");

$info = CImportTools::getDatabaseStructure($dsn);

/** @var DOMDocument $dom */
$dom = $info["description"];
$dom->formatOutput = true;

$xpath = $dom->_xpath;
$table = $xpath->query("//tables/table[@name='$table']")->item(0);

$column_element = $xpath->query("column[@name='$column']")->item(0);
if (!$column_element) {
  $column_element = $dom->createElement("column");
  $column_element->setAttribute("name", $column);

  $table->appendChild($column_element);
}

$column_element->setAttribute("foreign_key", $value);

$dom->save($info["description_file"]);

CAppUI::stepAjax("Fichier de description sauvegardé", UI_MSG_OK);

CApp::rip();
