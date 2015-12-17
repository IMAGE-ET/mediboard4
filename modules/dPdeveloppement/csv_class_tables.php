<?php
/**
 * $Id: csv_class_tables.php 27165 2015-02-16 15:48:20Z lryo $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27165 $
 */

$csv = new CCSVFile();

CApp::getMbClasses($instances);

foreach ($instances as $_class => $_instance) {
  if (!$_instance->_spec->table || !$_instance->_ref_module) {
    continue;
  }
  
  $_module = $_instance->_ref_module;
  
  $line = array(
    $_class,
    CAppUI::tr($_class),
    $_instance->_spec->table,
    $_instance->_spec->key,
    $_module->mod_name,
    CAppUI::tr("module-{$_module->mod_name}-court"),
  );
  $csv->writeLine($line);
}

$csv->stream("Class to table");
