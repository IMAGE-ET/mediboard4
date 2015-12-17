<?php
/**
 * $Id: httpreq_test_dsn.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

CCanDo::checkAdmin();

// Check params
if (null == $dsn = CValue::get("dsn")) {
  CAppUI::stepAjax("Aucun DSN spécifié", UI_MSG_ERROR);
}

if (!@CSQLDataSource::get($dsn)) {
  CAppUI::stepAjax("Connexion vers la DSN '$dsn' échouée", UI_MSG_ERROR);
}

CAppUI::stepAjax("Connexion vers la DSN '$dsn' réussie");
