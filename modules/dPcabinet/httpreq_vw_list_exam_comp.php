<?php
/**
 * $Id: httpreq_vw_list_exam_comp.php 20068 2013-07-26 13:21:27Z rhum1 $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20068 $
 */

CCanDo::checkEdit();

$selConsult  = CValue::getOrSession("selConsult", 0);

$consult = new CConsultation();
$consult->load($selConsult);
$consult->loadRefsBack();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("consult", $consult);

$smarty->display("exam_comp.tpl");
