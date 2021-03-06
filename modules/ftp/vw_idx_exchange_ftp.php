<?php

/**
 * View Exchange FTP
 *  
 * @category FTP
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version  SVN: $Id:$ 
 * @link     http://www.mediboard.org
 */


CCanDo::checkRead();

$echange_ftp_id = CValue::get("echange_ftp_id");
$page           = CValue::get('page', 0);
$now            = CMbDT::date();
$_date_min      = CValue::getOrSession('_date_min', CMbDT::dateTime("-7 day"));
$_date_max      = CValue::getOrSession('_date_max', CMbDT::dateTime("+1 day"));
$function       = CValue::getOrSession("function");

CValue::setSession("_date_min"  , $_date_min);
CValue::setSession("_date_max"  , $_date_max);
CValue::setSession("function"   , $function);

// Chargement de l'�change FTP demand�
$exchange_ftp = new CExchangeFTP();

$where = array();
if ($_date_min && $_date_max) {
  $exchange_ftp->_date_min = $_date_min;
  $exchange_ftp->_date_max = $_date_max;
  $where['date_echange'] = " BETWEEN '".$_date_min."' AND '".$_date_max."' ";
}

$total_exchange_ftp = 0;
$echangesFTP = array();

$functions = array();
if (!$exchange_ftp->_id) {
  $ds = CSQLDataSource::get("std");
  $functions = CMbArray::pluck($ds->loadList("SELECT function_name FROM echange_ftp GROUP BY function_name"), "function_name");
}

// Cr�ation du template
$smarty = new CSmartyDP();
$smarty->assign("exchange_ftp"      , $exchange_ftp);
$smarty->assign("echangesFTP"       , $echangesFTP);
$smarty->assign("total_exchange_ftp", $total_exchange_ftp);
$smarty->assign("page"              , $page);
$smarty->assign("function"          , $function);
$smarty->assign("functions"         , $functions);
$smarty->display("vw_idx_exchange_ftp.tpl");

