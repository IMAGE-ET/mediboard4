<?php
/**
 * $Id: index.php 21751 2014-01-23 09:55:17Z rhum1 $
 *
 * @package    Mediboard
 * @subpackage dPstats
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21751 $
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("vw_hospitalisation"     , TAB_READ);
$module->registerTab("vw_bloc"                , TAB_READ);
$module->registerTab("vw_cancelled_operations", TAB_READ);
$module->registerTab("vw_bloc2"               , TAB_READ);
$module->registerTab("vw_time_op"             , TAB_READ);
$module->registerTab("vw_personnel_salle"     , TAB_READ);
if (CModule::getActive("dPprescription")) {
  $module->registerTab("vw_prescriptions"       , TAB_READ);
}
$module->registerTab("vw_patients_provenance" , TAB_READ);
$module->registerTab("vw_user_logs"           , TAB_ADMIN);
