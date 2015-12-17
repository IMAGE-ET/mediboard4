<?php

/**
 * dPboard
 *
 * @category Board
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: vw_stats_consultations.php 19250 2013-05-23 19:24:15Z rhum1 $
 * @link     http://www.mediboard.org
 */

global $prat;

CAppUI::requireModuleFile('dPstats', 'graph_consultations');

$filterConsultation = new CConsultation();

$filterConsultation->_date_min = CValue::getOrSession("_date_min", CMbDT::date("-1 YEAR"));
$rectif = CMbDT::transform("+0 DAY", $filterConsultation->_date_min, "%d") - 1;
$filterConsultation->_date_min = CMbDT::date("-$rectif DAYS", $filterConsultation->_date_min);

$filterConsultation->_date_max =  CValue::getOrSession("_date_max",  CMbDT::date());
$rectif = CMbDT::transform("+0 DAY", $filterConsultation->_date_max, "%d") - 1;
$filterConsultation->_date_max = CMbDT::date("-$rectif DAYS", $filterConsultation->_date_max);
$filterConsultation->_date_max = CMbDT::date("+ 1 MONTH", $filterConsultation->_date_max);
$filterConsultation->_date_max = CMbDT::date("-1 DAY", $filterConsultation->_date_max);

$filterConsultation->_praticien_id = $prat->_id;

$graphs = array(
  graphConsultations($filterConsultation->_date_min, $filterConsultation->_date_max, $filterConsultation->_praticien_id),
);

// Variables de templates
$smarty = new CSmartyDP();

$smarty->assign("filterConsultation", $filterConsultation);
$smarty->assign("prat"              , $prat);
$smarty->assign("graphs"            , $graphs);

$smarty->display("vw_stats_consultations.tpl");
