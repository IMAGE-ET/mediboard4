<?php
/**
 * $Id: configure.php 21802 2014-01-29 10:17:10Z nicolasld $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21802 $
 */

CCanDo::checkAdmin();

$hours = range(0, 23);
$minutes = range(0, 59);
$intervals = array("5", "10", "15", "20", "30");
$patient_ids = array("0", "1", "2");
$today = CMbDT::date();
$group = CGroups::loadCurrent();

// Nombre de patients
$where = array("entree" => ">= '$today 00:00:00'",
               "group_id" => "= '$group->_id'");
$sejour = new CSejour();
$nb_sejours = $sejour->countList($where);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("minutes"    , $minutes);
$smarty->assign("hours"      , $hours);
$smarty->assign("today"      , $today);
$smarty->assign("nb_sejours" , $nb_sejours);
$smarty->assign("intervals"  , $intervals);
$smarty->assign("patient_ids", $patient_ids);
$smarty->assign("group"            , $group);

$smarty->display("configure.tpl");
