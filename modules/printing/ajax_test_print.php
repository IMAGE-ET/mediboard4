<?php 
/**
 * Test print
 *  
 * @category PRINTING
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version  SVN: $Id:$ 
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

$id  = CView::get("id", "num");
$class      = CView::get("class", "enum list|CSourceLPR|CSourceSMB");

CView::checkin();

/** @var CSourcePrinter $source */
$source = new $class();
$source->load($id);

$file = new CFile();
$file->_file_path = "modules/printing/samples/test_page.pdf";

$source->sendDocument($file);
