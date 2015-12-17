<?php
/**
 * $Id: httpreq_numdos_form.php 19374 2013-06-01 12:56:17Z mytto $
 *
 * @package    Mediboard
 * @subpackage PMSI
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19374 $
 */

CCanDo::checkEdit();

$sejour_id = CValue::getOrSession("sejour_id");

// Chargement du dossier patient
$sejour = new CSejour;
$sejour->load($sejour_id);
$sejour->loadRefPatient();

if ($sejour->_id) {
  $sejour->loadNDA();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("sejour"         , $sejour );
$smarty->assign("patient"         , $sejour->_ref_patient );
$smarty->assign("hprim21installed", CModule::getActive("hprim21"));

$smarty->display("inc_numdos_form.tpl");