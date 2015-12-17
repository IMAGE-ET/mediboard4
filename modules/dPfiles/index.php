<?php
/**
 * $Id: index.php 21574 2014-01-06 08:30:35Z charlyecho $
 *
 * @category Files
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 21574 $
 * @link     http://www.mediboard.org
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("vw_files"       , TAB_READ);
$module->registerTab("vw_categories"  , TAB_ADMIN);
$module->registerTab("files_integrity", TAB_ADMIN);
$module->registerTab("send_documents" , TAB_EDIT);
$module->registerTab("vw_stats"       , TAB_ADMIN);
