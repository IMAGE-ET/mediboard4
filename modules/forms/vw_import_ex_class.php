<?php 

/**
 * $Id: vw_import_ex_class.php 24590 2014-08-28 09:31:40Z phenxdesign $
 *  
 * @category Forms
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 24590 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$smarty = new CSmartyDP();
$smarty->display("vw_import_ex_class.tpl");
