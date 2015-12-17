<?php
/**
 * $Id: do_exam_possum_aed.php 20068 2013-07-26 13:21:27Z rhum1 $
 *
 * @package    Mediboard
 * @subpackage dPcabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20068 $
 */

$do = new CDoObjectAddEdit("CExamPossum", "exampossum_id");
$do->redirect = null;
$do->doIt();
