<?php

/**
 * dPcim10
 *
 * @category Cim10
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: vw_full_code.php 21266 2013-12-04 14:41:23Z flaviencrochard $
 * @link     http://www.mediboard.org
 */

CCanDo::checkRead();

$lang = CValue::getOrSession("lang", CCodeCIM10::LANG_FR);

$code = CValue::getOrSession("code", "(A00-B99)");
$cim10 = CCodeCIM10::get($code, CCodeCIM10::FULL, $lang);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("lang" , $lang);
$smarty->assign("cim10", $cim10);

$smarty->display("vw_full_code.tpl");
