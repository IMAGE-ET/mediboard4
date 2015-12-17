<?php
/**
 * $Id: configure.php 19615 2013-06-20 14:28:18Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19615 $
 */

CCanDo::checkAdmin();

// Création du template
$smarty = new CSmartyDP();
$smarty->display("configure.tpl");
