<?php 

/**
 * $Id: ajax_check_export_dir.php 27644 2015-03-23 13:43:59Z phenxdesign $
 *  
 * @category Patients
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 27644 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$directory = CValue::get("directory");

if (!$directory) {
  return;
}

if (!is_writable($directory) || !is_dir($directory)) {
  CAppUI::stepAjax("Répertoire invalide", UI_MSG_ERROR);
}

$iterator = new DirectoryIterator($directory);
$count = 0;

foreach ($iterator as $_fileinfo) {
  if ($_fileinfo->isDot()) {
    continue;
  }

  $count++;
}

CAppUI::stepAjax("Contient %d fichiers ou dossiers", UI_MSG_WARNING, $count);
