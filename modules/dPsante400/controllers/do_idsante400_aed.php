<?php /* $Id: do_idsante400_aed.php 8216 2010-03-05 10:16:33Z rhum1 $ */

/**
 * @package Mediboard
 * @subpackage sante400
 * @version $Revision: 8216 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

$do = new CDoObjectAddEdit("CIdSante400", "id_sante400_id");

// Indispensable pour ne pas écraser les paramètes dans action
if(!isset($_POST["ajax"]) || !$_POST["ajax"]) {
  $do->redirect = null;
}
$do->doIt();

?>