<?php
/**
 * $Id: CAccessLogArchive.class.php 25304 2014-10-14 20:40:08Z mytto $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25304 $
 */

/**
 * Access Log
 */
class CAccessLogArchive extends CAccessLog {
  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec        = parent::getSpec();
    $spec->table = 'access_log_archive';
    $spec->archive = true;
    return $spec;
  }
}
