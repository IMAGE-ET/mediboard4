<?php
/**
 * $Id: print_sorties.php 28620 2015-06-17 12:37:05Z aurelie17 $
 *
 * @category Admissions
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28620 $
 * @link     http://www.mediboard.org
 */

CCanDo::checkRead();
$date            = CValue::get("date", CMbDT::date());
$type            = CValue::get("type");
$services_ids    = CValue::getOrSession("services_ids");
$period          = CValue::get("period");
$enabled_service = CValue::getOrSession("active_filter_services", 0);

if (is_array($services_ids)) {
  CMbArray::removeValue("", $services_ids);
}

$date_min = $date;
$date_max = CMbDT::date("+ 1 DAY", $date);
$group = CGroups::loadCurrent();

if ($period) {
  $hour = CAppUI::conf("dPadmissions hour_matin_soir");
  if ($period == "matin") {
    // Matin
    $date_max = CMbDT::dateTime($hour, $date);
  }
  else {
    // Soir
    $date_min = CMbDT::dateTime($hour, $date);
  }
}

$sejour                   = new CSejour();
$where                    = array();
$where["sejour.sortie"]   = "BETWEEN '$date_min' AND '$date_max'";
$where["sejour.annule"]   = "= '0'";
$where["sejour.group_id"] = "= '$group->_id'";

if ($type == "ambucomp") {
  $where["sejour.type"] = "IN ('ambu', 'comp')";
}
elseif ($type) {
  $where["sejour.type"] = " = '$type'";
}
else {
  $where["sejour.type"] = "NOT IN ('urg', 'seances')";
}

$ljoin          = array();
$ljoin["users"] = "users.user_id = sejour.praticien_id";
// Filtre sur les services
if (count($services_ids) && $enabled_service) {
  $ljoin["affectation"]        = "affectation.sejour_id = sejour.sejour_id AND affectation.sortie = sejour.sortie";
  $where["affectation.service_id"] = CSQLDataSource::prepareIn($services_ids);
}
$order = "users.user_last_name, users.user_first_name, sejour.sortie";

/** @var CSejour[] $sejours */
$sejours = $sejour->loadList($where, $order, null, null, $ljoin);
CStoredObject::massLoadFwdRef($sejours  , "praticien_id");
CStoredObject::massLoadFwdRef($sejours  , "patient_id");
CStoredObject::massLoadFwdRef($sejours  , "prestation_id");
CStoredObject::massLoadBackRefs($sejours, "affectations", "sortie DESC");

$listByPrat = array();
foreach ($sejours as $sejour) {
  $sejour->loadRefPraticien();
  $sejour->loadRefsAffectations();
  $sejour->loadRefPatient();
  $sejour->loadRefPrestation();
  $sejour->loadNDA();
  $sejour->_ref_last_affectation->loadRefLit();
  $sejour->_ref_last_affectation->_ref_lit->loadCompleteView();

  $curr_prat = $sejour->praticien_id;
  if (!isset($listByPrat[$curr_prat])) {
    $listByPrat[$curr_prat]["praticien"] = $sejour->_ref_praticien;
  }
  $listByPrat[$curr_prat]["sejours"][] = $sejour;
}

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign("date"      , $date);
$smarty->assign("type"      , $type);
$smarty->assign("listByPrat", $listByPrat);
$smarty->assign("total"     , count($sejours));

$smarty->display("print_sorties.tpl");