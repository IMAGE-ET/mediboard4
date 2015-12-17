<?php
/**
 * $Id: ajax_edit_question_motif.php 27936 2015-04-13 12:53:35Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Urgences
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27936 $
 */

CCanDo::checkRead();
$question_id  = CValue::get("question_id");
$motif_id     = CValue::get("motif_id");

$question = new CMotifQuestion();
$question->load($question_id);

if ($question_id) {
  $question->load($question_id);
}
else {
  $question->motif_id = $motif_id;
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("question", $question);

$smarty->display("edit_question_motif.tpl");