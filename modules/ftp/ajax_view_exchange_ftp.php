<?php
/**
 * View exchange FTP details
 *
 * @category Webservices
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id:$
 * @link     http://www.mediboard.org
 */

CCanDo::checkRead();

$exchange_ftp_id = CValue::get("exchange_ftp_id");

// Chargement de l'échange SOAP demandé
$exchange_ftp = new CExchangeFTP();
$exchange_ftp->load($exchange_ftp_id);

if ($exchange_ftp->_id) {
  $exchange_ftp->loadRefs();

  $exchange_ftp->input  = unserialize($exchange_ftp->input);
  if ($exchange_ftp->ftp_fault != 1) {
    $exchange_ftp->output = unserialize($exchange_ftp->output);
  }
}

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("exchange_ftp", $exchange_ftp);
$smarty->display("inc_exchange_ftp_details.tpl");
