<?php
/**
 * $Id: index.php 18985 2013-05-01 13:23:08Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage dPetablissement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 18985 $
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("vw_idx_groups"  , TAB_READ);
$module->registerTab("vw_etab_externe", TAB_READ);
