<?php
/**
 * $Id: vw_legende.php 19087 2013-05-12 16:27:44Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Urgences
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19087 $
 */

CCanDo::checkRead();

// Création du template
$smarty = new CSmartyDP();

$smarty->display("vw_legende.tpl");
