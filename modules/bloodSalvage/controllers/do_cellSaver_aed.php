<?php
/**
 * $Id: do_cellSaver_aed.php 20938 2013-11-13 11:02:47Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage bloodSalvage
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20938 $
 */

$do = new CDoObjectAddEdit('CCellSaver', 'cell_saver_id');
$do->doIt();
