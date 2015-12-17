<?php
/**
 * $Id: httpreq_list_diags.php 19374 2013-06-01 12:56:17Z mytto $
 *
 * @package    Mediboard
 * @subpackage PMSI
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19374 $
 */

CCanDo::checkEdit();

$sejour_id = CValue::getOrSession("sejour_id");

$sejour = new CSejour;
$sejour->load($sejour_id);
$sejour->loadRefDossierMedical()->updateFormFields();

$patient = $sejour->loadRefPatient();
$patient->loadRefDossierMedical()->updateFormFields();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("patient", $sejour->_ref_patient);
$smarty->assign("sejour" , $sejour);

$smarty->display("inc_list_diags.tpl");
