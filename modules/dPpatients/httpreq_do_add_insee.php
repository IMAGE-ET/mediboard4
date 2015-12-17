<?php
/**
 * $Id: httpreq_do_add_insee.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

CCanDo::checkAdmin();

$sourcePath = "modules/dPpatients/INSEE/insee.tar.gz";
$targetDir = "tmp/insee";
$targetPath = "tmp/insee/insee.sql";

// Extract the SQL dump
if (null == $nbFiles = CMbPath::extract($sourcePath, $targetDir)) {
  CAppUI::stepAjax("Erreur, impossible d'extraire l'archive", UI_MSG_ERROR);
} 

CAppUI::stepAjax("Extraction de $nbFiles fichier(s)", UI_MSG_OK);

$ds = CSQLDataSource::get("INSEE");
if (null == $lineCount = $ds->queryDump($targetPath, true)) {
  $msg = $ds->error();
  CAppUI::stepAjax("Erreur de requ�te SQL: $msg", UI_MSG_ERROR);
}

CAppUI::stepAjax("import effectu� avec succ�s de $lineCount lignes", UI_MSG_OK);
