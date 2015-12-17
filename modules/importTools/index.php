<?php 
/**
 * $Id: index.php 25400 2014-10-20 08:14:10Z phenxdesign $
 * 
 * @package    Mediboard
 * @subpackage importTools
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25400 $
 */

$module = CModule::getInstalled(basename(__DIR__));

$module->registerTab('vw_database_explorer', TAB_ADMIN);