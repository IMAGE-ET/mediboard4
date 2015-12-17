<?php /* $Id: configure.php 21520 2013-12-26 13:03:10Z mytto $ */

/**
 * @package Mediboard
 * @subpackage sante400
 * @version $Revision: 21520 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

CCanDo::checkAdmin();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("types", CMouvFactory::getTypes());
$smarty->assign("modes", array_keys(CMouvFactory::$modes));
$smarty->display("configure.tpl");
