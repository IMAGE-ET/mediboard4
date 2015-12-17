<?php
/**
 * $Id: CFacturable.class.php 19168 2013-05-16 12:20:07Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPfacturation
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 19168 $
 */

/**
 * Facturable
 *
 */
class CFacturable extends CCodable {

  /**
   * @see parent::getBackProps()
   */
  function getBackProps() {
    $backProps = parent::getBackProps();
    $backProps["facturable"]  = "CFactureLiaison object_id";
    return $backProps;
  }
}