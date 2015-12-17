<?php
/**
 * $Id: httpreq_get_sejours.php 19840 2013-07-09 19:36:14Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19840 $
 */

CCanDo::checkRead();

$patient_id = CValue::get("patient_id");
$patient = new CPatient;
$patient->load($patient_id);
$patient->loadRefsSejours();

// Liste des Etablissements selon Permissions
$etablissements = new CMediusers();
$etablissements = $etablissements->loadEtablissements(PERM_READ);

// Cr�ation du template
$smarty = new CSmartyDP();

$smarty->assign("sejours_collision", $patient->getSejoursCollisions());
$smarty->assign("sejours", $patient->_ref_sejours);
$smarty->assign("etablissements", $etablissements);

$smarty->display("inc_get_sejours.tpl");
