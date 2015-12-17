<?php

/**
 * CreatePatientTest
 *
 * @description Test creation of a patient
 * @screen      DossierPatientPage
 *
 * @package    Mediboard
 * @subpackage Tests
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 */
class CreatePatientTest extends SeleniumTestCase {

  /** @var $dpPage DossierPatientPage */
  public $dpPage = null;
  public static $endOfClass = false;

  public $patientFirstname = "PatientFirstname";
  public $patientLastname = "PatientLastname";
  public $patientGender = "m";
  public $patientBirthDate = "12/12/1999";

  public function testCreatePatientOk() {
    $this->dpPage = new DossierPatientPage($this);
    $this->dpPage->searchPatientByName("notYetAPatient");
    $this->dpPage->createPatient($this->patientFirstname, $this->patientLastname, $this->patientGender, $this->patientBirthDate);
    $this->dpPage->searchPatientByName($this->patientLastname);

    $this->assertEquals(strtoupper($this->patientLastname), $this->dpPage->getPatientName());
    $this->screenshot($this->getTestId()."_".$this->getBrowser().".png");

    self::$endOfClass = true;
  }

  public function tearDown() {
    if (self::$endOfClass) {
      $this->dpPage->goToDossierPatient();
      $this->dpPage->searchPatientByName($this->patientLastname);

      $this->dpPage->purgePatient();
      $this->closeWindow();
      self::$endOfClass = false;
    }
  }
}