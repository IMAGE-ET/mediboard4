<?php

/**
 * Configuration du module Hprim21
 *
 * @category Hprim21
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License; see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: configure.php 19437 2013-06-05 22:38:47Z rhum1 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkAdmin();

$hprim21_source = CExchangeSource::get("hprim21", "ftp", true);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("hprim21_source" , $hprim21_source);
$smarty->display("configure.tpl");

