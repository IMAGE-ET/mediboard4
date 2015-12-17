<?php

/**
 * dPccam
 *
 * @category Ccam
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: do_favoris_aed.php 19221 2013-05-21 14:24:43Z rhum1 $
 * @link     http://www.mediboard.org
 */

$do = new CDoObjectAddEdit("CFavoriCCAM", "favoris_id");

// Am�lioration des textes
if ($favori_user = CValue::post("favoris_user")) {
  $user = new CMediusers;
  $user->load($favori_user);
  $for = " pour $user->_view";
  $do->createMsg .= $for;
  $do->modifyMsg .= $for;
  $do->deleteMsg .= $for;
}

$do->redirect = null;

$do->doIt();

if (CAppUI::pref("new_search_ccam") == 1) {
  echo CAppUI::getMsg();
  CApp::rip();
}
