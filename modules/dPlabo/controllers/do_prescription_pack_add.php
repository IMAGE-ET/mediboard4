<?php
/**
 * $Id: do_prescription_pack_add.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

$do = new CDoObjectAddEdit("CPrescriptionLaboExamen");

$pack = new CPackExamensLabo();
$pack->load($_POST["_pack_examens_labo_id"]);
$pack->loadRefs();

foreach ($pack->_ref_items_examen_labo as $item) {
  $_POST["examen_labo_id"]       = $item->_ref_examen_labo->_id;
  $_POST["pack_examens_labo_id"] = $pack->_id;
  $do->doBind();
  $do->doStore();
}

$do->ajax = 1;
$do->doRedirect();
