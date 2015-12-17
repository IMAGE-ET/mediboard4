<?php
/**
 * $Id: CHL7v3AcknowledgmentSVS.class.php 27596 2015-03-18 17:47:25Z lryo $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 27596 $
 */

/**
 * Class CHL7v3AcknowledgmentSVS
 * Acknowledgment SVS
 */
class CHL7v3AcknowledgmentSVS extends CHL7v3EventSVS {
  /** @var CHL7v3MessageXML */
  public $dom;
  public $status;

  /** @var CMbXPath */
  public $xpath;

  /**
   * Get acknowledgment status
   *
   * @return string
   */
  function getStatutAcknowledgment() {
    return "OK";
  }

  /**
   * Get query ack
   *
   * @return array
   */
  function getQueryAck() {
    $dom   = $this->dom;

    $classname = "CHL7v3Acknowledgment".$dom->documentElement->localName;
    /** @var CHL7v3AcknowledgmentSVS $acknowledgment */
    $acknowledgment = new $classname;
    $acknowledgment->dom = $dom;

    return $acknowledgment->getQueryAck();
  }
}