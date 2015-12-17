<?php 

/**
 * $Id: ajax_vw_table_distinct_data.php 27738 2015-03-26 14:29:40Z phenxdesign $
 *  
 * @category ImportTools
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 27738 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$dsn    = CValue::get("dsn");
$table  = CValue::get("table");
$column = CValue::get("column");

$ds = CSQLDataSource::get($dsn);

$columns = CImportTools::getColumnsInfo($ds, $table);

$counts = $ds->loadList(
  "SELECT COUNT(*) AS total, `{$column}` AS value FROM `{$table}` GROUP BY `{$column}` ORDER BY Total DESC LIMIT 1000;"
);

$smarty = new CSmartyDP();
$smarty->assign("dsn",     $dsn);
$smarty->assign("table",   $table);
$smarty->assign("column",  $column);
$smarty->assign("columns", $columns);
$smarty->assign("counts",  $counts);
$smarty->display("inc_vw_table_distinct_data.tpl");