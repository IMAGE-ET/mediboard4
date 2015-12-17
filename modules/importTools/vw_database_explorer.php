<?php 

/**
 * $Id: vw_database_explorer.php 27769 2015-03-30 08:45:03Z phenxdesign $
 *  
 * @category ImportTools
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 27769 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$databases = CImportTools::getAllDatabaseInfo();

foreach ($databases as $_dsn => &$_info) {
  $_info = CImportTools::getDatabaseStructure($_dsn, true);
}

$smarty = new CSmartyDP();
$smarty->assign("databases", $databases);
$smarty->display("vw_database_explorer.tpl");
