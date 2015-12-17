<?php /** $Id: index.php 18680 2013-04-04 15:38:03Z charlyecho $ **/

/**
 * @package Mediboard
 * @subpackage dPadmissions
 * @version $Revision: 18680 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

if (CAppUI::conf("dPplanningOp CSejour use_recuse")) {
  $module->registerTab("vw_sejours_validation", TAB_EDIT);
}
$module->registerTab("vw_idx_admission"         , TAB_READ);
$module->registerTab("vw_idx_sortie"            , TAB_READ);
$module->registerTab("vw_idx_preadmission"      , TAB_READ);
$module->registerTab("vw_idx_permissions"       , TAB_READ);
$module->registerTab("vw_idx_present"           , TAB_READ);
//$module->registerTab("vw_idx_consult"         , TAB_READ);
$module->registerTab("vw_idx_identito_vigilance", TAB_ADMIN);

