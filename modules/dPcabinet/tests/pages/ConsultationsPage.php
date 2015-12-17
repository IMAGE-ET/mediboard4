<?php

/**
 * Consultation page representation
 *
 * @package    Tests
 * @subpackage Pages
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 */
class ConsultationsPage extends HomePage {

  protected $module_name = "dPcabinet";
  protected $tab_name = "vw_planning";

  /**
   * Try to create a "plage de consultutation"
   *
   * @param string $praticien_id Practitioner user_id
   * @param string $date         Date to create the consultation with format yyyy-mm-dd
   *
   * @return void
   */
  public function createPlageConsultation($praticien_id, $date) {
    $driver = $this->driver;

    $driver->byIdAndWait("vw_planning_a_semaine");

    // Go to the week which correspond to the $date param
    $driver->setInputValueById('changeDate_debut', $date);

    // Click on the create plage button
    $driver->byIdAndWait("create_plage_consult_button")->click();

    // Bug with IE, first click isn't working
    if ($driver->getBrowser() == "iexplore") {
      $driver->byIdAndWait("create_plage_consult_button")->click();
    }

    // Select the right practitioner
    $this->selectPractitioner($praticien_id);
    // Set the date of the new plage
    $driver->setInputValueByCss("#editFrm_date > option:nth-child(4)", $date);
    // Set begin and end date
    $driver->select($driver->getFormField("editFrm", "date"))->selectOptionByValue($date);
    $date_debut = $driver->getFormField("editFrm", "debut_da");
    $date_debut->click();
    // double click on 8h
    $driver->moveto($driver->byCssSelectorAndWait("tr.calendarRow:nth-child(3) > td:nth-child(3)"));
    $driver->doubleclick();
    $date_debut = $driver->getFormField("editFrm", "fin_da");
    $date_debut->click();
    // double click on 18h
    $driver->moveto($driver->byCssSelectorAndWait("tr.calendarRow:nth-child(5) > td:nth-child(1)"));
    $driver->doubleclick();

    // Click on the create button
    $driver->byId("edit_plage_consult_button_create_new_plage")->click();
  }


  /**
   * Create a new consultation for a patient with the specified practitioner
   *
   * @param string $praticien_id    Practitioner user_id
   * @param string $date            Date format yyyy-mm-dd
   * @param string $patientLastname Patient lastname
   *
   * @return void
   */
  public function createConsultation($praticien_id, $date, $patientLastname) {
    $driver = $this->driver;

    // Go to the "rendez-vous" tab
    $driver->url("index.php?m=dPcabinet&tab=edit_planning");
    // Select the right practitioner
    $this->selectPractitioner($praticien_id);
    // Click on the patient field to open the modal
    $driver->getFormField("editFrm", "_patient_view")->click();
    // Search and select patient
    $this->patientSelector($patientLastname);
    // Reset the focus to the current window
    $driver->window($driver->windowHandle());
    // Click on the date field to open the modal
    $driver->getFormField("editFrm", "_date")->click();
    // Change focus
    $driver->changeFrameFocus('dPcabinet', 'plage_selector');
    $driver->waitForAjax("listePlages");
    // Select day option to get the right "plage de consultation"
    $driver->execute(
      array(
      'script' => "updatePlage('$date')",
      'args' => array())
    );
    $driver->waitForAjax("listePlages");
    // Click on the day
    $driver->byCssSelectorAndWait("#listPlages_month_$date > tbody > tr:nth-child(2) > td:nth-child(1) > div > div.text > a")->click();
    // Wait for loading of the click's result
    $driver->waitForAjax("listPlaces-0");
    // Get all the buttons
    $listButton = $driver->elements($driver->using('css selector')->value(".validPlage"));
    // Click on the first one (8h00)
    $listButton[0]->click();
    // Change focus on current window
    $driver->window($driver->windowHandle());
    // Save the rendez-vous
    $driver->byIdAndWait("addedit_planning_button_submitRDV")->click();
  }




  /**
   * Try to remove a "plage de consultation" with the "semainier"
   *
   * @param string $praticien_id Practitioner user_id
   * @param string $date         Date to create the consultation with formate yyyy-mm-dd
   *
   * @return void
   */
  public function removePlageConsultation($praticien_id, $date) {
    $driver = $this->driver;

    $this->changePractitioner($praticien_id);
    $this->selectPlage($date);
    // Click on edit button
    $driver->byCssSelectorAndWait("td.segment-$date-08 > div > div > div.event.consultation > div > a.button.edit")->click();
    // Click on delete button
    $driver->byIdAndWait("edit_plage_consult_button_delete_plage")->click();
    // Previous step show an alert, accept it
    $driver->acceptAlert();
  }

  /**
   * Try to remove a "plage de consultation" automatically created
   * by a "consultation immediate" with the "semainier"
   *
   * @param string $praticien_id Practitioner user_id
   *
   * @return void
   */
  public function removePlageConsultationAutomatique($praticien_id) {
    $driver = $this->driver;

    $this->switchConsultationTab("semainier");
    $this->changePractitioner($praticien_id);
    $today = date("Y-m-d");
    $hour = date("H");
    $this->selectPlage($today, $hour);
    // Click on edit button
    $driver->byCssSelectorAndWait("td.segment-$today-$hour > div > div > div.event.consultation > div > a.button.edit")->click();
    // Click on delete button
    $driver->byIdAndWait("edit_plage_consult_button_delete_plage")->click();
    // Previous step show an alert, accept it
    $driver->acceptAlert();

    $driver->byIdAndWait("systemMsg");
  }


  /**
   * Select the practitioner with user_id on select element
   *
   * @param string $praticien_id Practitioner id
   *
   * @return void
   */
  public function selectPractitioner($praticien_id) {
    // Select the right practitioner
    $this->driver->select($this->driver->getFormField("editFrm", "chir_id"))
      ->selectOptionByValue($praticien_id);
  }


  /**
   * Tab navigation in consultation
   *
   * @param string $tabName Tab's name
   *
   * @return void
   */
  public function switchConsultationTab($tabName) {
    $driver = $this->driver;
    $tabName = strtolower($tabName);
    // Get all the tab links
    $tabList = $driver->elements($driver->using("css selector")->value("#tabmenu > tbody > tr> td > a"));
    switch ($tabName) {
      case "semainier":
        // Click on the first tab which is "Semainier"
        $tabList[0]->click();
        break;
      case "journée":
        $tabList[1]->click();
        break;
      case "rendez-vous":
        $tabList[2]->click();
        break;
      case "consultation":
        $tabList[3]->click();
        break;
      default:
        //default
        break;
    }
  }


  /**
   * Select a plage on a specified date
   *
   * @param string $date format yyyy-mm-dd
   * @param string $hour format H
   *
   * @return void
   */
  public function selectPlage($date, $hour = "08") {
    $driver = $this->driver;

    // Go to the week which correspond to the $date param
    $driver->setInputValueById("changeDate_debut", $date);
    // Select the "plage"
    $consult = $this->driver->byCssSelectorAndWait("td.segment-$date-$hour div.event.consultation");
    $driver->moveto($consult);
    // Wait for the hover event which display the button edit
    $driver->waitUntil(
      function () use ($driver, $date, $hour, $consult) {
        if ($driver->byCssSelector("td.segment-$date-$hour div.event.consultation a.button.edit")->displayed()) {
          $driver->moveto($consult);
          return true;
        }
        return null;
      }, 10000
    );
    if ($driver->getBrowser() == "iexplore") {
      $driver->moveto($consult);
    }
  }


  /**
   * Change the practitioner on the "semainier" view
   *
   * @param string $praticien_id Practitioner id
   *
   * @return void
   */
  public function changePractitioner($praticien_id) {
    $driver = $this->driver;

    // Select the practitionner with $praticien_id
    $driver->byIdAndWait("changePrat_chirSel");
    $driver->setInputValueById("changePrat_chirSel", $praticien_id);
    $driver->byIdAndWait("changePrat_chir_id_view")->submit();

    // Chrome is too fast, wait for it...
    if ($driver->getBrowser() == "chrome") {
      $driver->waitUntil(
        function () use ($praticien_id, $driver) {
          return strpos($driver->url(), "=$praticien_id&") !== false;
        }, 5000
      );
    }
  }
}