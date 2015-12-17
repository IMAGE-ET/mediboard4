<?php
/**
 * $Id: ajax_vw_files.php 20881 2013-11-06 11:41:49Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20881 $
 */

CCanDo::checkEdit();
$date_min       = CValue::getOrSession("_date_min", CMbDT::date());
$date_max       = CValue::getOrSession("_date_max", CMbDT::date());
$type_journal   = CValue::get("type_journal");

$date_min = CMbDT::dateTime($date_min);
$date_max = CMbDT::dateTime(CMbDT::date("+1 day", $date_max));

$ljoin = array();
$ljoin["facture_journal"] = "facture_journal.journal_id = files_mediboard.object_id";

$where = array();
$where["object_class"] = " = 'CJournalBill'";
$where["file_date"] = "BETWEEN '$date_min' AND '$date_max'";
$where["facture_journal.type"] = "= '$type_journal'";

$file = new CFile();
$files = $file->loadList($where, null, null, null, $ljoin);

foreach ($files as $_file) {
  $_file->canDo();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("files", $files);
$smarty->assign("name_readonly", 1);

$smarty->display("vw_files_journaux.tpl");