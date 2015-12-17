<?php
/**
 * $Id: CHL7v2DataTypeDouble.class.php 18136 2013-02-18 17:22:37Z lryo $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18136 $
 */

class CHL7v2DataTypeDouble extends CHL7v2DataType {
  function toMB($value, CHL7v2Field $field){
    $parsed = parent::toMB($value, $field);
    
    // empty value
    if ($parsed === "") {
      return "";
    }
    
    // invalid value
    if ($parsed === false) {
      return;
    }
    
    return (double)$parsed;
  }
  
  function toHL7($value, CHL7v2Field $field) {
    $parsed = parent::toHL7($value, $field);
    
    // empty value
    if ($parsed === "" || $parsed === null) {
      return "";
    }
    
    // invalid value
    if ($parsed === false) {
      return;
    }
    
    return (double)$parsed;
  }
}
