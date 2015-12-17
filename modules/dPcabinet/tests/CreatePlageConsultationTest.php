<?php

/**
 * CreatePlageConsultationtest
 *
 * @description Test creation of a "plage de consultation" ;
 *              The "plage" must be created on an empty week
 * @screen      ConsultationPage
 *
 * @package    Mediboard
 * @subpackage Tests
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 *
 */
class CreatePlageConsultationTest extends SeleniumTestCase {


  /** @var ConsultationsPage $dpPage */
  public $consultationPage = null;

  public static $endOfClass = false;

  public $chir_id = "733";
  public $datePlage = "2016-07-01";


  public function testCreatePlageConsultation() {
    $this->consultationPage = new ConsultationsPage($this);
    $this->consultationPage->createPlageConsultation($this->chir_id, $this->datePlage);

    $this->assertEquals("Plage créée", $this->consultationPage->getInfoMessage());
    $this->screenshot($this->getTestId()."_".$this->getBrowser().".png");
  }


  public function tearDown() {
    $this->consultationPage->removePlageConsultation($this->chir_id, $this->datePlage);
    $this->closeWindow();
  }
}