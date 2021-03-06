<?php
/**
 * $Id: vw_idx_societe.php 19286 2013-05-26 16:59:04Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Stock
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19286 $
 */
 
CCanDo::checkEdit();

$societe_id = CValue::getOrSession('societe_id');
$suppliers = CValue::getOrSession('suppliers', 1);
$manufacturers = CValue::getOrSession('manufacturers', 1);
$inactive = CValue::getOrSession('inactive', 1);

// Loads the expected Societe
$societe = new CSociete();
$societe->load($societe_id);

// Smarty template
$smarty = new CSmartyDP();

$smarty->assign('societe',       $societe);
$smarty->assign('suppliers',     $suppliers);
$smarty->assign('manufacturers', $manufacturers);
$smarty->assign('inactive',      $inactive);

$smarty->display('vw_idx_societe.tpl');

