<?php /* $Id: vw_create_archive.php 12302 2011-05-27 13:08:17Z rhum1 $ */

/**
* @package Mediboard
* @subpackage dPrepas
* @version $Revision: 12302 $
* @author Sébastien Fillonneau
*/

CCanDo::checkAdmin();

$smarty = new CSmartyDP();
$smarty->display("vw_create_archive.tpl");
?>