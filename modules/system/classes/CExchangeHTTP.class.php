<?php
/**
 * $Id: CExchangeHTTP.class.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

/**
 * HTTP exchange
 */
class CExchangeHTTP extends CExchangeTransportLayer {
  public $echange_http_id;
  
  // DB Fields
  public $http_fault;

  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec = parent::getSpec();
    $spec->loggable = false;
    $spec->table = 'echange_http';
    $spec->key   = 'echange_http_id';
    return $spec;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $props = parent::getProps();
    $props["http_fault"] = "bool";
    return $props;
  }
}
