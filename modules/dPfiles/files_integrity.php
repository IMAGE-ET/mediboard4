<?php
/**
 * $Id: files_integrity.php 20498 2013-09-29 19:08:17Z phenxdesign $
 *
 * @category Files
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 20498 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

// Création du template
$smarty = new CSmartyDP();

$smarty->display("files_integrity.tpl");
