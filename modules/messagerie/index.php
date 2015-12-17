<?php /** $Id: index.php 28343 2015-05-20 15:27:05Z asmiane $ **/

/**
 * @package Mediboard
 * @subpackage dPportail
 * @version $Revision: 28343 $
 * @author Fabien
 */

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("vw_messagerie", TAB_READ);
$module->registerTab("vw_list_accounts", TAB_ADMIN);
