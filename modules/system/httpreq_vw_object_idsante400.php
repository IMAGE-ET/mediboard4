<?php
/**
 * $Id: httpreq_vw_object_idsante400.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

$object = mbGetObjectFromGet("object_class", "object_id", "object_guid");

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("canSante400", CModule::getCanDo("dPsante400"));
$smarty->assign("object", $object);
$smarty->display("inc_object_idsante400.tpl");
