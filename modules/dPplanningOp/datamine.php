<?php
/**
 * $Id: datamine.php 26589 2014-12-26 16:00:55Z charlyecho $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 26589 $
 */

CCanDo::checkEdit();

CDataMinerWorker::mine("COperationMiner");