<?php
/**
 * $Id: icone_selector.php 20068 2013-07-26 13:21:27Z rhum1 $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20068 $
 */

CCanDo::check();

// Chargement de la liste des icones presents dans le fichier
$icones = CAppUI::readFiles("modules/dPcabinet/images/categories", ".png");

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("icones", $icones);
$smarty->display("icone_selector.tpl");
