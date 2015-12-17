<?php
/**
 * $Id: do_consult_anesth_aed.php 19253 2013-05-24 07:18:23Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPcabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19253 $
 */

if ($chir_id = CValue::post("chir_id")) {
  CValue::setSession("chir_id", $chir_id);
}

$do = new CDoObjectAddEdit("CConsultAnesth");
$do->doIt();

