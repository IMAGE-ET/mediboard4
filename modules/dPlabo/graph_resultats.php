<?php
/**
 * $Id: graph_resultats.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

$examen = new CExamenLabo;
$examen->load(CValue::get("examen_id"));

$patient = new CPatient;
$patient->load(CValue::get("patient_id"));

$item = new CPrescriptionLaboExamen;
$resultats = $item->loadResults($patient->_id, $examen->_id, 20);

// Création du graph
$graph = new CResultatsLaboGraph($patient, $examen, $resultats);

$graph->Stroke();
