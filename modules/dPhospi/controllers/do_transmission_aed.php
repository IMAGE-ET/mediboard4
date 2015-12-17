<?php
/**
 * $Id: do_transmission_aed.php 19668 2013-06-26 07:22:13Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPhospi
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19668 $
 */
/*
if(isset($_POST["date"]) && $_POST["date"] == "now") {
  $_POST["date"] = CMbDT::dateTime();
}
*/
$do = new CDoObjectAddEdit("CTransmissionMedicale", "transmission_medicale_id");
$do->doIt();