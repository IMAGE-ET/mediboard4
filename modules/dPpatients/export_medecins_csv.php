<?php 

/**
 * $Id: export_medecins_csv.php 28215 2015-05-07 12:20:27Z phenxdesign $
 *  
 * @category Patients
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28215 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

$only_with_emails = CValue::get("only_with_emails", 1);

$csv = new CCSVFile();

$medecin = new CMedecin();
$ds = $medecin->getDS();

$line = array_keys($medecin->getPlainFields());
$csv->writeLine($line);

$where = array();

if ($only_with_emails) {
  $where[] = "email IS NOT NULL OR email_apicrypt IS NOT NULL";
}

$request = new CRequest();
$request->addWhere($where);

// Disable query buffer, to save memory
if ($ds instanceof CPDOMySQLDataSource) {
  $ds->link->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
}

$query = $request->makeSelect($medecin);
$res = $ds->exec($query);

while ($data = $ds->fetchAssoc($res)) {
  $_new_data = array();
  foreach ($line as $_field) {
    $_new_data[] = $data[$_field];
  }

  $csv->writeLine($_new_data);
}

$name = "Correspondants m�dicaux - ".CMbDT::dateTime();
$csv->stream($name, true);
