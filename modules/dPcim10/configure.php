<?php

/**
 * dPcim10
 *
 * @category Cim10
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: configure.php 19221 2013-05-21 14:24:43Z rhum1 $
 * @link     http://www.mediboard.org
 */

global $can;
$can->needsAdmin();

// Création du template
$smarty = new CSmartyDP();
$smarty->display("configure.tpl");
