<?php
/**
 * $Id: index.php 19621 2013-06-20 20:40:45Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage GestionCab
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19621 $
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("edit_compta"      , TAB_READ);
$module->registerTab("edit_paie"        , TAB_READ);
$module->registerTab("edit_params"      , TAB_READ);
$module->registerTab("edit_mode_paiement"  , TAB_READ);
$module->registerTab("edit_rubrique"    , TAB_READ);
