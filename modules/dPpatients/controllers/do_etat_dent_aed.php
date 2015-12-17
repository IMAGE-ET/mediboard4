<?php
/**
 * $Id: do_etat_dent_aed.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

$_POST['dossier_medical_id'] = CDossierMedical::dossierMedicalId($_POST['_patient_id'], 'CPatient');

$do = new CDoObjectAddEdit('CEtatDent');
$do->doIt();
