<?php
/**
 * $Id: httpreq_diagnostic.php 19357 2013-05-30 14:24:19Z mytto $
 *
 * @package    Mediboard
 * @subpackage PMSI
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19357 $
 */

$sejour_id = CValue::getOrSession("sejour_id");
$modeDAS   = CValue::getOrSession("modeDAS", 1);

$sejour = new CSejour;
$sejour->load($sejour_id);
$sejour->loadExtDiagnostics();
$sejour->loadRefDossierMedical();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("sejour" , $sejour);
$smarty->assign("modeDAS", $modeDAS);

$smarty->display("inc_diagnostic.tpl");
