<?php
/**
 * $Id: edit_paie.php 19621 2013-06-20 20:40:45Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage GestionCab
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19621 $
 */

CCanDo::checkRead();

$user = CMediusers::get();

$employecab_id = CValue::getOrSession("employecab_id", null);
$fiche_paie_id = CValue::getOrSession("fiche_paie_id", null);

$employe = new CEmployeCab;
$where = array();
$where["function_id"] = "= '$user->function_id'";

$listEmployes = $employe->loadList($where);
if (!count($listEmployes)) {
  CAppUI::setMsg("Vous devez avoir au moins un employé", UI_MSG_ERROR);
  CAppUI::redirect("m=dPgestionCab&tab=edit_params");
}
if ($employecab_id) {
  $employe =& $listEmployes[$employecab_id];
}
else {
  $employe = reset($listEmployes);
}

$paramsPaie = new CParamsPaie;
$paramsPaie->loadFromUser($employe->employecab_id);

$fichePaie = new CFichePaie();
$fichePaie->load($fiche_paie_id);
if (!$fichePaie->fiche_paie_id) {
  $fichePaie->debut = CMbDT::date();
  $fichePaie->fin = CMbDT::date();
  $fichePaie->params_paie_id = $paramsPaie->_id;
}

$listeFiches = $paramsPaie->loadBackRefs("fiches");

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("employe"      , $employe);
$smarty->assign("fichePaie"    , $fichePaie);
$smarty->assign("listFiches"   , $listeFiches);
$smarty->assign("listEmployes" , $listEmployes);

$smarty->display("edit_paie.tpl");
