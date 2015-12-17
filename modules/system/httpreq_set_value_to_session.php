<?php
/**
 * $Id: httpreq_set_value_to_session.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

$module = CValue::get("module");
$name = CValue::get("name");
$value = CValue::get("value");

// Ajout de la valeur en session
$_SESSION[$module][$name] = $value;
