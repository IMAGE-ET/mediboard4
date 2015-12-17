<?php /* $Id: do_plat_aed.php 8216 2010-03-05 10:16:33Z rhum1 $ */

/**
* @package Mediboard
* @subpackage dPrepas
* @version $Revision: 8216 $
* @author Sébastien Fillonneau
*/

$do = new CDoObjectAddEdit("CPlat", "plat_id");
$do->doIt();

?>