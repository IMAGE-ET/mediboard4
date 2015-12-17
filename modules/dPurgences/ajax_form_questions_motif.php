<?php
/**
 * $Id: ajax_form_questions_motif.php 28128 2015-04-29 13:16:11Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Urgences
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28128 $
 */

CCanDo::checkRead();
$rpu_id = CValue::getOrSession("rpu_id");

$rpu    = new CRPU;
if ($rpu_id && !$rpu->load($rpu_id)) {
  global $m, $tab;
  CAppUI::setMsg("Ce RPU n'est pas ou plus disponible", UI_MSG_WARNING);
  CAppUI::redirect("m=$m&tab=$tab&rpu_id=0");
}

$rpu->loadRefsReponses();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("rpu" , $rpu);

$smarty->display("inc_form_questions_motif.tpl");
