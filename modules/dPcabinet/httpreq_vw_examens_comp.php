<?php
/**
 * $Id: httpreq_vw_examens_comp.php 19425 2013-06-04 18:04:05Z mytto $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19425 $
 */

CCanDo::checkRead();

$consultation_id   = CValue::getOrSession("consultation_id");
$dossier_anesth_id = CValue::getOrSession("dossier_anesth_id");

// Chargement de la consultation
$consult = new CConsultation();
$consult->load($consultation_id);
$consult->loadRefPlageConsult();
$consult->loadRefsFichesExamen();

$consult->_is_anesth = $consult->_ref_chir->isAnesth();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("consult"   , $consult);
$smarty->assign("dossier_anesth_id", $dossier_anesth_id);

$smarty->display("inc_examens_comp.tpl");
