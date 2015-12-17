<?php

/**
 * $Id: setup.php 19147 2013-05-15 12:40:53Z rhum1 $
 *
 * @category Admissions
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 19147 $
 * @link     http://www.mediboard.org
 */

/**
 * Setup of the Admission module
 * */
class CSetupdPadmissions extends CSetup {

  /** Constructor */
  function __construct() {
    parent::__construct();
  
    $this->mod_name = "dPadmissions";
   
    $this->makeRevision("all");
    
    $this->mod_version = "0.1";
 
  }
}
