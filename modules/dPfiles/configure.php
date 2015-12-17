<?php
/**
 * $Id: configure.php 20498 2013-09-29 19:08:17Z phenxdesign $
 *
 * @category Files
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 20498 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$file = new CFile;

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("listNbFiles", range(1, 10));
$smarty->assign("today", CMbDT::date());
$smarty->assign("nb_files", $file->countList() / 100);
$smarty->display("configure.tpl");

