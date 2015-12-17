<?php
/**
 * $Id: ajax_recept_dossiers_legende.php 27245 2015-02-19 16:33:46Z armengaudmc $
 *
 * @package    Mediboard
 * @subpackage PMSI
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27245 $
 */

CCanDo::checkRead();

// Création du template
$smarty = new CSmartyDP();
$smarty->display("reception_dossiers/inc_recept_dossiers_legende.tpl");
