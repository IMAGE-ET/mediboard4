<?php 

/**
 * $Id: do_import_product_category_xml.php 28520 2015-06-05 09:16:23Z phenxdesign $
 *  
 * @category Patients
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28520 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

CApp::setTimeLimit(600);

$file = CValue::read($_FILES, "import");
$filename = $file["tmp_name"];

$importer = new CProductCategoryXMLImport($filename);
$importer->import(array(), array());
