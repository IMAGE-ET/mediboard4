<?php
/**
 * $Id: do_protocole_aed.php 19840 2013-07-09 19:36:14Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19840 $
 */

if ($chir_id = CValue::post("chir_id")) {
  CValue::setSession("chir_id", $chir_id);
}

$do = new CDoObjectAddEdit("CProtocole");
//$do->redirectDelete = "m=$m&tab=vw_edit_protocole&protocole_id=0";
$do->doIt();
