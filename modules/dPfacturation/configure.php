<?php
/**
 * $Id: configure.php 18495 2013-03-22 08:12:19Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18495 $
 */
CCanDo::checkAdmin();
// Création du template
$smarty = new CSmartyDP();

$smarty->display("configure.tpl");
?>