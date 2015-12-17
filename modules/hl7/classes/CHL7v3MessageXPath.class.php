<?php
/**
 * $Id: CHL7v3MessageXPath.class.php 19620 2013-06-20 16:27:56Z lryo $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 19620 $
 */

/**
 * Class CHL7v3MessageXPath
 * XPath HL7v3
 */
class CHL7v3MessageXPath extends CMbXPath {
  /**
   * Construct
   *
   * @param DOMDocument $dom DOM
   *
   * @retun CHL7v2MessageXPath
   */
  function __construct(DOMDocument $dom) {
    parent::__construct($dom);
    
    $this->registerNamespace("hl7", "urn:hl7-org:v3");
  }
}
