<?php 
/**
 * $Id: CMbSimpleXMLElement.class.php 18308 2013-03-05 13:17:50Z phenxdesign $
 * 
 * @package    Mediboard
 * @subpackage classes
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18308 $
 */

if (!class_exists("SimpleXMLElement", false)) {
  return;
}

class CMbSimpleXMLElement extends SimpleXMLElement {
  function getValidPatterns(){
    return array("*");
  }
  
  function getXpath($prefix = "") {
    $tokens = array();
    
    foreach ($this->getValidPatterns() as $patt) {
      $tokens[] = "$prefix$patt";
    }
    
    return implode(" | ", $tokens);
  }
  
  /**
   * @return CMbSimpleXMLElement
   */
  function getParent(){
    return current($this->xpath($this->getXpath("parent::")));
  }
  
  /**
   * @return CMbSimpleXMLElement
   */
  function getNextSibling(){
    return current($this->xpath($this->getXpath("following-sibling::")));
  }
  
  /**
   * @return CMbSimpleXMLElement
   */
  function getPreviousSibling(){
    return current($this->xpath($this->getXpath("preceding-sibling::")));
  }
  
  /**
   * @return CMbSimpleXMLElement
   */
  function getFirstChild(){
    return current($this->xpath($this->getXpath()));
  }
  
  /**
   * @return CMbSimpleXMLElement
   */
  function getNext(){
    if ($next = $this->getNextSibling()) {
      return $next;
    }
    
    if ($parent = $this->getParent()) {
      return $parent->getNext();
    }
  }
}
