<?php
/**
 * $Id: ajax_recept_dossier_line.php 27975 2015-04-15 13:06:13Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPpmsi
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    OXOL, see http://www.mediboard.org/public/OXOL
 * @version    $Revision: 27975 $
 */

CCanDo::checkRead();
$sejour_id = CValue::get("sejour_id");
$field     = CValue::get("field");

$sejour = new CSejour();
$sejour->load($sejour_id);
if (!$field) {
  $sejour->loadRefPatient();
  $sejour->loadRefPraticien();
  $sejour->loadNDA();
}

$smarty = new CSmartyDP();

if (!$field) {
  $smarty->assign("_sejour" , $sejour);
  $smarty->display("reception_dossiers/inc_recept_dossier_line.tpl");
}
else {
  $smarty->assign("field" , $field);
  $smarty->assign("sejour" , $sejour);
  $smarty->display("inc_sejour_dossier_completion.tpl");
}