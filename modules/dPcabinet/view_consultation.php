<?php
/**
 * $Id: view_consultation.php 24810 2014-09-12 09:40:40Z charlyecho $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24810 $
 */

CCanDo::checkRead();

$consultation_id = CValue::get("consultation_id");

$consultations = array();
$consultation = new CConsultation;
$consultation->load($consultation_id);
$consultation->loadRefsFwd();

$date = $consultation->_ref_plageconsult->date;

$prat = $consultation->_ref_plageconsult->_ref_chir;
$prat->loadRefs();

$patient = $consultation->_ref_patient;
$patient->loadRefs();

$prat->loadRefFunction();
$chir_ids = array_keys($prat->_ref_function->loadRefsUsers());

$ds = $consultation->getDS();

// nexts rdvs for the same function
$ljoin = array("plageconsult" => "plageconsult.plageconsult_id = consultation.plageconsult_id");
$where = array();
$where["date"] = ">= '$date' ";
$where["patient_id"] = " = '$consultation->patient_id' ";
$where[] = "plageconsult.chir_id ".$ds->prepareIn($chir_ids)." OR plageconsult.remplacant_id ".$ds->prepareIn($chir_ids);
$where["annule"] = " != '1' ";
$where[$consultation->_spec->key] = " != '$consultation->_id'";
/** @var CConsultation[] $consultations */
$consultations = $consultation->loadList($where, "date ASC, heure ASC", null, null, $ljoin);
foreach ($consultations as $_consult) {
  $_consult->_ref_patient = $consultation->_ref_patient;
  $_consult->loadRefPraticien()->loadRefFunction();
  $_consult->_ref_plageconsult->loadRefRemplacant();
}


$today = CMbDT::date();

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign("consultation", $consultation);
$smarty->assign("consultations", $consultations);
$smarty->assign("patient"     , $patient      );
$smarty->assign("prat"        , $prat         );
$smarty->assign("today"       , $today        );

$smarty->display("view_consultation.tpl");
