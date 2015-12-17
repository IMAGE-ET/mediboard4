<?php
/**
 * $Id: index.php 20462 2013-09-25 14:20:38Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPpersonnel
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20462 $
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("vw_edit_personnel"        , TAB_READ);
$module->registerTab("vw_affectations_pers"     , TAB_READ);
$module->registerTab("vw_affectations_multiples", TAB_EDIT);
$module->registerTab("vw_idx_plages_conge"      , TAB_READ);
$module->registerTab("vw_planning_conge"        , TAB_READ);
?>