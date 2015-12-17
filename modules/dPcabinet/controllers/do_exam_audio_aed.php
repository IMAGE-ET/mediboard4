<?php
/**
 * $Id: do_exam_audio_aed.php 20068 2013-07-26 13:21:27Z rhum1 $
 *
 * @package    Mediboard
 * @subpackage dPcabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20068 $
 */

// Sets the values to the session too
CValue::postOrSessionAbs("_conduction");
CValue::postOrSessionAbs("_oreille");

$do = new CDoObjectAddEdit("CExamAudio", "examaudio_id");
$do->doIt();

