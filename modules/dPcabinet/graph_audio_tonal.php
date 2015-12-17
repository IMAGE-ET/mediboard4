<?php
/**
 * $Id: graph_audio_tonal.php 19425 2013-06-04 18:04:05Z mytto $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19425 $
 */

CCanDo::checkRead();

global $m, $exam_audio;

$exam_audio = new CExamAudio;
$exam_audio->load(CValue::getOrSession("examaudio_id"));

CAppUI::requireModuleFile($m, "inc_graph_audio_tonal");

$side = CValue::get("side");

AudiogrammeTonal::${$side}->Stroke();
