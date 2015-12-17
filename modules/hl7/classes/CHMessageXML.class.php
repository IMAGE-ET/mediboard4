<?php
/**
 * $Id: CHMessageXML.class.php 17245 2012-11-09 10:17:02Z lryo $
 * 
 * @package    Mediboard
 * @subpackage hl7
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 17245 $
 */

/**
 * Interface CHMessageXML
 * Message XML
 */
interface CHMessageXML {
  function getContentNodes();
  
  function handle($ack, CMbObject $object, $data);
}
