<?php

/**
 * dPboard
 *
 * @category Board
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: vw_sejours_interventions.php 26697 2015-01-08 11:31:36Z asmiane $
 * @link     http://www.mediboard.org
 */

CAppUI::requireModuleFile('dPstats', 'graph_patpartypehospi');
CAppUI::requireModuleFile('dPstats', 'graph_activite');

global $prat;

$filterSejour    = new CSejour();
$filterOperation = new COperation();

$filterSejour->_date_min_stat = CValue::getOrSession("_date_min_stat", CMbDT::date("-1 YEAR"));
$rectif = CMbDT::transform("+0 DAY", $filterSejour->_date_min_stat, "%d") - 1;
$filterSejour->_date_min_stat = CMbDT::date("-$rectif DAYS", $filterSejour->_date_min_stat);

$filterSejour->_date_max_stat =  CValue::getOrSession("_date_max_stat",  CMbDT::date());
$rectif = CMbDT::transform("+0 DAY", $filterSejour->_date_max_stat, "%d") - 1;
$filterSejour->_date_max_stat = CMbDT::date("-$rectif DAYS", $filterSejour->_date_max_stat);
$filterSejour->_date_max_stat = CMbDT::date("+1 MONTH", $filterSejour->_date_max_stat);
$filterSejour->_date_max_stat = CMbDT::date("-1 DAY", $filterSejour->_date_max_stat);


$filterSejour->praticien_id = $prat->_id;
$filterSejour->type = CValue::getOrSession("type", 1);
$filterOperation->_codes_ccam = strtoupper(CValue::getOrSession("_codes_ccam", ""));

$graphs = array(
  graphPatParTypeHospi(
    $filterSejour->_date_min_stat, $filterSejour->_date_max_stat, $filterSejour->praticien_id,
    null, $filterSejour->type
  ),
  graphActivite(
    $filterSejour->_date_min_stat, $filterSejour->_date_max_stat, $filterSejour->praticien_id,
    null, null, null, null, $filterOperation->_codes_ccam, null, 0
  ),
);

// Variables de templates
$smarty = new CSmartyDP();

$smarty->assign("filterSejour",    $filterSejour);
$smarty->assign("filterOperation", $filterOperation);
$smarty->assign("prat",            $prat);
$smarty->assign("graphs",          $graphs);

$smarty->display("vw_sejours_interventions.tpl");
