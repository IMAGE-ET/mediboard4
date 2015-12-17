<?php 

/**
 * $Id: vw_import_group.php 28187 2015-05-05 15:06:40Z phenxdesign $
 *  
 * @category Forms
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28187 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$smarty = new CSmartyDP();
$smarty->display("vw_import_group.tpl");
