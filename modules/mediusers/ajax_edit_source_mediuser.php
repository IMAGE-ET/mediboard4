<?php
/**
 * $Id: ajax_edit_source_mediuser.php 27587 2015-03-18 09:31:32Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage mediusers
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 27587 $
 */

CCanDo::checkRead();

$user_id = CValue::getOrSession("user_id");
$mediuser = CMediusers::get($user_id);

// Source File system d'envoi
$fs_source_envoi = CExchangeSource::get("envoi-tarmed-$mediuser->_guid", "file_system", true, null, false);

// Source File system d'envoi
$fs_source_reception = CExchangeSource::get("reception-tarmed-$mediuser->_guid", "file_system", true, null, false);

$fs_sources_tarmed = array(
  "fs_source_envoi" => array($fs_source_envoi),
  "fs_source_reception" => array($fs_source_reception),
);

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("fs_sources_tarmed", $fs_sources_tarmed);

$smarty->display("sources_archive.tpl");
