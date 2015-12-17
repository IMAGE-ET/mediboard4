<?php
/**
 * $Id: ajax_vw_supervision_pictures.php 20428 2013-09-20 12:14:48Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20428 $
 */

CCanDo::checkAdmin();

$timed_picture_id = CValue::get("timed_picture_id");

$tree = CMbPath::getTree(CSupervisionTimedPicture::PICTURES_ROOT);

$smarty = new CSmartyDP();
$smarty->assign("tree",  $tree);
$smarty->assign("timed_picture_id",  $timed_picture_id);
$smarty->display("inc_vw_supervision_pictures.tpl");
