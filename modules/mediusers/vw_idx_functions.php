<?php

/**
 * View functions
 *
 * @category Mediusers
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: vw_idx_functions.php 28454 2015-06-01 14:50:08Z lryo $
 * @link     http://www.mediboard.org
 */

CCanDo::checkRead();

$page    = intval(CValue::get('page', 0));
$inactif = CValue::get("inactif", array());
$type    = CValue::get("type");
   
// Création du template
$smarty = new CSmartyDP();
$smarty->assign("inactif", $inactif);
$smarty->assign("page"   , $page);
$smarty->assign("type"   , $type );

$smarty->display("vw_idx_functions.tpl");
