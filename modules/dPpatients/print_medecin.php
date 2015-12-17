<?php
/**
 * $Id: print_medecin.php 28393 2015-05-26 14:02:56Z kgrisel $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28393 $
 */

CCanDo::checkRead();

$medecin_id = CValue::get("medecin_id");

$medecin = new CMedecin();
$medecin->load($medecin_id);

if (!$medecin || !$medecin->_id) {
  CAppUI::stepAjax('common-error-Invalid object', UI_MSG_ERROR);
}

$smarty = new CSmartyDP();
$smarty->assign("medecin", $medecin);
$smarty->assign("date", CMbDT::date());
$smarty->display("print_medecin.tpl");
