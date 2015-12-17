<?php
/**
 * $Id: do_dossierMedical_aed.php 19219 2013-05-21 12:26:07Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Patients
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19219 $
 */

$do = new CDoObjectAddEdit("CDossierMedical");

if ($_POST["del"] == 0) {
  // calcul de la valeur de l'id du dossier medical du patient
  $_POST["dossier_medical_id"] = CDossierMedical::dossierMedicalId($_POST["object_id"], $_POST["object_class"]);
}

$do->doIt();
