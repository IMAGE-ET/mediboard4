<?php
/**
 * $Id: ajax_edit_supervision_graph_pack.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

CCanDo::checkAdmin();

$supervision_graph_pack_id = CValue::get("supervision_graph_pack_id");

$pack = new CSupervisionGraphPack();
$pack->load($supervision_graph_pack_id);
$pack->loadRefsNotes();

$smarty = new CSmartyDP();
$smarty->assign("pack", $pack);
$smarty->display("inc_edit_supervision_graph_pack.tpl");
