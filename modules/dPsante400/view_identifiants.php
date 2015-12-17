<?php /* $Id: view_identifiants.php 28748 2015-06-27 09:01:22Z lryo $ */

/**
 * @package Mediboard
 * @subpackage sante400
 * @version $Revision: 28748 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

CCanDo::checkRead();

$canSante400 = CModule::getCanDo("dPsante400");
$dialog      = CValue::get("dialog");
$page        = intval(CValue::get('page', 0));

// Chargement du filtre
$filter = new CIdSante400;
$filter->object_id    = CValue::get("object_id"   );
$filter->object_class = CValue::get("object_class");
$filter->tag          = CValue::get("tag"         );
$filter->id400        = CValue::get("id400");
$filter->nullifyEmptyFields();

// Récupération de la liste des classes disponibles
if ($filter->object_class && $filter->object_id) {
  $listClasses = array($filter->object_class);
}
else {
  $listClasses = CApp::getInstalledClasses();
}

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("page"       , $page);
$smarty->assign("filter"     , $filter);
$smarty->assign("canSante400", $canSante400);
$smarty->assign("listClasses", $listClasses);
$smarty->assign("dialog"     , $dialog);
$smarty->display("view_identifiants.tpl");