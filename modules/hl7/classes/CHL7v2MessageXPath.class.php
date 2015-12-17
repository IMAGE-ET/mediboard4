<?php
/**
 * $Id: CHL7v2MessageXPath.class.php 18240 2013-02-27 09:56:59Z lryo $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18240 $
 */

/**
 * Class CHL7v2MessageXML 
 * XPath HL7
 */
class CHL7v2MessageXPath extends CMbXPath {
  /**
   * Construct
   *
   * @param DOMDocument $dom DOM
   *
   * @retun CHL7v2MessageXPath
   */
  function __construct(DOMDocument $dom) {
    parent::__construct($dom);
    
    $this->registerNamespace("hl7", "urn:hl7-org:v2xml");
  }

  /**
   * Convert value
   *
   * @param string $value Value
   *
   * @return string
   */
  function convertEncoding($value) {
    return $value;
  }
}
