<?php /* $Id: vw_legende_pancarte.php 6144 2009-04-21 14:22:50Z phenxdesign $ */

/**
 * @package Mediboard
 * @subpackage soins
 * @version $Revision: 6144 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

// Smarty template
$smarty = new CSmartyDP();
$smarty->assign("prescription", new CPrescription());
$smarty->display('vw_legende_pancarte.tpl');

?>

