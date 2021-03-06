<?php
/**
 * $Id: CHL7v2FieldItem.class.php 20987 2013-11-18 11:20:01Z phenxdesign $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 20987 $
 */

class CHL7v2FieldItem extends CHL7v2Component {
  static $_get_path_full = false;
  

  /** @var CHL7v2Field */
  public $parent;
  
  function __construct(CHL7v2Field $field, CHL7v2DOMDocument $specs, $self_pos) {
    $message = $field->getMessage();
    
    $separators = array(
      // sub parts separator                 self type        sub part separator class
      array($message->componentSeparator,    "field-item",    "cs"), 
      array($message->subcomponentSeparator, "component",     "scs"),
      array(null,                            "sub-component", null),
    );
    
    parent::__construct($field, $specs, $self_pos, $separators);
  }
  
  function getField() {
    return $this->parent;
  }
  
  function _toXML(DOMNode $node, $hl7_datatypes, $encoding) {
    $doc = $node->ownerDocument;
    $field = $this->getField();
    $new_node = $doc->createElement($field->name);
    
    parent::_toXML($new_node, $hl7_datatypes, $encoding);
    
    $node->appendChild($new_node);
  }
  
  function getPath($separator = ".", $with_name = false) {
    $path = $this->parent->getPath($separator, $with_name);
    
    if (self::$_get_path_full) {
      $path[] = $this->self_pos+1;
    }
    else {
      $path[count($path)-1] = $path[count($path)-1]."[".($this->self_pos+1)."]";
    }
   
    return $path;
  }
}
