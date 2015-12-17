<?php 
/**
 * $Id: CPDOOracleDataSource.class.php 18771 2013-04-11 13:24:41Z kgrisel $
 * 
 * @package    Mediboard
 * @subpackage classes
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18771 $
 */

/**
 * Class CPDOOracleDataSource
 */
class CPDOOracleDataSource extends CPDODataSource {
  protected $driver_name = "oci";

  /**
   * Get the used grammar
   *
   * @return CSQLGrammarOracle|mixed
   */
  function getQueryGrammar() {
    return new CSQLGrammarOracle();
  }
}
