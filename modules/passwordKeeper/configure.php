<?php
/**
 * $Id: configure.php 18926 2013-04-25 08:53:02Z kgrisel $
 *
 * @category Password Keeper
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link     http://www.mediboard.org */

CPasswordKeeper::checkHTTPS();

CCanDo::checkAdmin();

$smarty = new CSmartyDP();
$smarty->display("configure.tpl");