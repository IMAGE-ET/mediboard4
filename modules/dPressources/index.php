<?php /* $Id: index.php 7320 2009-11-14 22:42:28Z lryo $ */

/**
* @package Mediboard
* @subpackage dPressources
* @version $Revision: 7320 $
* @author Romain OLLIVIER
*/

$module = CModule::getInstalled(basename(dirname(__FILE__)));

$module->registerTab("view_planning", TAB_READ);
$module->registerTab("edit_planning", TAB_EDIT);
$module->registerTab("view_compta"  , TAB_EDIT);

?>