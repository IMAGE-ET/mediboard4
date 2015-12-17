<?php

/**
 * dPcim10
 *
 * @category Cim10
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: do_favoris_aed.php 19221 2013-05-21 14:24:43Z rhum1 $
 * @link     http://www.mediboard.org
 */

$do = new CDoObjectAddEdit("CFavoriCIM10");

// Amélioration des textes
$user = new CMediusers;
$user->load($_POST["favoris_user"]);
$for = " pour $user->_view";
$do->createMsg .= $for;
$do->modifyMsg .= $for;
$do->deleteMsg .= $for;

$do->redirect = null;
$do->doIt();

if (CAppUI::pref("new_search_cim10") == 1) {
  echo CAppUI::getMsg();
  CApp::rip();
}
