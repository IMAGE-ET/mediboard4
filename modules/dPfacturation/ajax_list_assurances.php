<?php
/**
 * $Id: ajax_list_assurances.php 26880 2015-01-26 15:41:43Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 26880 $
 */
CCanDo::checkEdit();
$facture_id     = CValue::get("facture_id");
$facture_class  = CValue::get("facture_class");
$patient_id     = CValue::get("patient_id");

$order = "date_debut DESC, date_fin DESC";
//Patient sélectionné
$patient = new CPatient();
$patient->load($patient_id);
$patient->loadRefsCorrespondantsPatient($order);

$facture = new $facture_class;
$facture->load($facture_id);  
$facture->loadRefPatient();
$facture->_ref_patient->loadRefsCorrespondantsPatient($order);
$facture->loadRefPraticien();
$facture->loadRefAssurance();
$facture->loadRefsObjects();
$facture->loadRefsReglements();
$facture->loadRefsRelances();
$facture->loadRefsNotes();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("patient"       , $patient);
$smarty->assign("facture"       , $facture);

$smarty->display("inc_vw_assurances.tpl");