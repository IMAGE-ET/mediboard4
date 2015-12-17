<?php
/**
 * $Id: benchmark.php 28357 2015-05-21 16:00:21Z mytto $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28357 $
 */

CCanDo::checkRead();

// Déverrouiller la session pour rendre possible les requêtes concurrentes.
CSessionHandler::writeClose();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("module", "system");
$smarty->assign("action", "about");
$smarty->display("benchmark.tpl");