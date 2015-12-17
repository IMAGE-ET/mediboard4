<?php
/**
 * $Id: CDataSourceLogArchive.class.php 25304 2014-10-14 20:40:08Z mytto $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25304 $
 */

/**
 * Data source resource usage log
 */
class CDataSourceLogArchive extends CDataSourceLog {
  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec        = parent::getSpec();
    $spec->table = 'datasource_log_archive';
    $spec->archive = true;
    return $spec;
  }
}
