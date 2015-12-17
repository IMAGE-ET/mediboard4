<?php
/**
 * $Id: cache_tester.php 24615 2014-09-01 10:52:44Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24615 $
 */

CCanDo::checkRead();

// Création du template
$smarty = new CSmartyDP();
$smarty->display("cache_tester.tpl");

