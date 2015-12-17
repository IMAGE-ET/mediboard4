<?php
/**
 * $Id: httpreq_vw_list_techniques_comp.php 24480 2014-08-20 10:51:06Z flaviencrochard $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 24480 $
 */

CCanDo::checkEdit();

$selConsult        = CValue::getOrSession("selConsult", 0);
$dossier_anesth_id = CValue::getOrSession("dossier_anesth_id", 0);

$consult = new CConsultation();
$consult->load($selConsult);
$consult->loadRefConsultAnesth($dossier_anesth_id);
$consult->_ref_consult_anesth->loadRefsBack();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("consult_anesth", $consult->_ref_consult_anesth);

$smarty->display("inc_consult_anesth/techniques_comp.tpl");
