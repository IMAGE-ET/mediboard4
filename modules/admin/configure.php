<?php

/**
 * $Id: configure.php 18997 2013-05-02 09:24:16Z rhum1 $
 *
 * @category Admin
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 18997 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

// Création du template
$smarty = new CSmartyDP();
$smarty->display("configure.tpl");
