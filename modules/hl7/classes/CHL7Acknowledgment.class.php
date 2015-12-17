<?php
/**
 * $Id: CHL7Acknowledgment.class.php 18158 2013-02-19 15:14:04Z lryo $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18158 $
 */

/**
 * Interface CHL7v2Acknowledgment 
 * Acknowledgment HL7
 */
interface CHL7Acknowledgment {
  /**
   * Construct
   *
   * @param CHL7Event $event Event HL7
   *
   * @return CHL7Acknowledgment
   */
  function __construct(CHL7Event $event = null);

  /**
   * Get acknowledgment status
   *
   * @return string
   */
  function getStatutAcknowledgment();
}
