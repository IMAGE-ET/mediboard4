<?php
/**
 * Home page representation, abstract class which defines header and navbar
 *
 * @package    Tests
 * @subpackage Pages
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    SVN: $Id: HomePage.php $
 * @link       http://www.mediboard.org
 */


class HomePage {

  /** @var  SeleniumTestCase $driver */
  public $driver;

  protected $module_name;
  protected $tab_name;

  function __construct($driver) {
    $this->driver = $driver;
    if ($this->module_name) {
      $this->driver->url("/?login=selenium:test");
      $this->driver->url("/index.php?m=$this->module_name".($this->tab_name ? "&tab=$this->tab_name" : ""));
    }
  }

  function goToCim() {
    return new CimPage($this->driver);
  }

  function goToCcam() {
    return new CcamPage($this->driver);
  }

  function goToDossierPatient() {
    return new DossierPatientPage($this->driver);
  }

  function goToConsultations() {
    return new ConsultationsPage($this->driver);
  }

  function goToModeles() {
    return new ModelesPage($this->driver);
  }

  function goToBloc() {
    return new BlocPage($this->driver);
  }

  function goToPlanifSejour() {
    return new PlanifSejourPage($this->driver);
  }

  public function getTitle() {
    return utf8_decode($this->driver->byCssSelectorAndWait("div.title:nth-child(3) > h1:nth-child(2)")->text());
  }

  function doLogOut() {
    $this->driver->byCssSelectorAndWait(".menu > a:nth-child(7)")->click();
  }

  /**
   * Global patient selector
   * Search for a patient and select it if found
   *
   * @param string $lastname  Patient lastname
   * @param string $firstname Patient firstname
   *
   * @return null
   */
  function patientSelector($lastname, $firstname=null) {
    $driver = $this->driver;

    $driver->changeFrameFocus("dPpatients", "pat_selector");
    $lastnameField = $driver->getFormField("patientSearch", "name");
    $firstnameField = $driver->getFormField("patientSearch", "name");

    $lastnameField->clear();
    $firstnameField->clear();

    $lastnameField->value($lastname);
    $firstnameField->value($firstname);
    $driver->byId("pat_selector_search_pat_button")->click();
    $driver->byIdAndWait("inc_pat_selector_select_pat")->click();
  }

  /**
   * Get info message after an object creation
   *
   * @return null|string
   */
  public function getInfoMessage() {
    $this->driver->waitUntil(
      function () {
        return $this->driver->byCssSelector("#systemMsg .info")->text() != null;
      }, 5000
    );
    return utf8_decode($this->driver->byCssSelector("#systemMsg .info")->text());
  }
}