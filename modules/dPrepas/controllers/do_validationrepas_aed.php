<?php /* $Id: do_validationrepas_aed.php 8216 2010-03-05 10:16:33Z rhum1 $ */

/**
* @package Mediboard
* @subpackage dPrepas
* @version $Revision: 8216 $
* @author Sébastien Fillonneau
*/

class CDoValidationRepasAddEdit extends CDoObjectAddEdit {
  function CDoValidationRepasAddEdit() {
    $this->CDoObjectAddEdit("CValidationRepas", "validationrepas_id");
  }
  
  function doStore() {
    $this->_obj->resetModifications();
    parent::doStore();
  }
}
$do = new CDoValidationRepasAddEdit;
$do->doIt();
?>