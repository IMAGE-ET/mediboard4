<?php
/**
 * $Id: vw_retrocession_regles.php 19043 2013-05-07 10:17:32Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 19043 $
 */
CCanDo::checkEdit();
$prat_id = CValue::getOrSession("prat_id", "0");

$mediuser = new CMediusers();
$listPrat = $mediuser->loadPraticiens();

// Chargement du praticien
$praticien = new CMediusers();
$praticien->load($prat_id);
$praticien->loadRefsRetrocessions();

// Creation du template
$smarty = new CSmartyDP();

$smarty->assign("listPrat",   $listPrat);
$smarty->assign("praticien",  $praticien);

$smarty->display("vw_retrocession_regles.tpl");
