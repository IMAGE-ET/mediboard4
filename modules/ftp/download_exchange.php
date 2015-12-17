<?php
/**
 * Download exchange
 *
 * @category Webservices
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id:$
 * @link     http://www.mediboard.org
 */

$echange_ftp_id = CValue::get("echange_ftp_id");

$echange_ftp = new CExchangeFTP();
$echange_ftp->load($echange_ftp_id);

$input  = print_r(unserialize($echange_ftp->input), true);

if ($echange_ftp->ftp_fault == 1) {
  $output = print_r($echange_ftp->output, true);
}
else {
  $output = print_r(unserialize($echange_ftp->output), true);
}

$function_name = $echange_ftp->function_name;
$content = "Date d'echange :
{$echange_ftp->date_echange}\n
Temps de reponse :
{$echange_ftp->response_time} ms \n
Parametres :\n
$input
Resultat :\n
$output\n";

$echange = utf8_decode($content);

header("Content-Disposition: attachment; filename={$function_name}-{$echange_ftp_id}.txt");
header("Content-Type: text/plain; charset=".CApp::$encoding);
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header("Cache-Control: post-check=0, pre-check=0", false );
header("Content-Length: ".strlen($echange));
echo $echange;