<?php

/**
 * SeleniumTestCase
 *
 * @description extension of PHPUnit Selenium 2
 *
 * @package    Mediboard
 * @subpackage Tests
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 */
class SeleniumTestCase extends PHPUnit_Extensions_Selenium2TestCase {

  /** @var string $base_url of Mediboard */
  public $base_url = "http://172.16.1.25/";

  public static $browsers = array(
    array(
      'name'        => 'Windows Firefox',
      'browserName' => 'firefox',
      'host'        => 'localhost',
      'port'        => 4444,
      'timeout'     => 30000,
      'sessionStrategy' => 'shared'
    ),
    array(
      'name'    => 'Windows Chrome',
      'browserName' => 'chrome',
      'host'    => 'localhost',
      'port'    => 4444,
      'timeout' => 30000,
      'sessionStrategy' => 'shared'
    ),
    array(
      'name'    => 'Windows IE',
      'browserName' => 'iexplore',
      'host'    => 'localhost',
      'port'    => 4444,
      'timeout' => 30000,
      'sessionStrategy' => 'shared',
      'initialBrowserURL' => "http://172.16.1.25/",
    ),
  );

  /**
   * Setup browser session and size
   *
   * @return void
   */
  protected function setUp() {
    parent::setUp();
    $this->setBrowserURL($this->base_url);
    $this->prepareSession()->currentWindow()->maximize();
  }

  /**
   * Get an element by css selector and wait until timeout if element is not present
   *
   * @param string $value       The css selector
   * @param int    $waitTimeout timeout value
   *
   * @return PHPUnit_Extensions_Selenium2TestCase_Element
   */
  public function byCssSelectorAndWait($value, $waitTimeout = 10000) {
    parent::waitUntil(
      function () use ($value) {
        if ($this->byCssSelector($value)) {
          return true;
        }
      return null;
      }, $waitTimeout
    );
    return parent::byCssSelector($value);
  }

  /**
   * Get an element by id and wait until timeout if element is not present
   *
   * @param string $value       Element id
   * @param int    $waitTimeout timeout value
   *
   * @return PHPUnit_Extensions_Selenium2TestCase_Element
   */
  public function byIdAndWait($value, $waitTimeout = 10000) {
    parent::waitUntil(
      function () use ($value) {
        if ($this->byId($value)) {
          return true;
        }
        return null;
      }, $waitTimeout
    );
    return parent::byId($value);
  }


  /**
   * Wait for the end of ajax by checking the data-loaded attribute
   *
   * @param string $id          the id of the ajax div
   * @param int    $waitTimeout timeout value
   *
   * @return void
   */
  public function waitForAjax($id, $waitTimeout = 10000) {
    parent::waitUntil(
      function () use ($id) {
        // data-loaded attritude is added in url.js at onComplete event
        if ($this->byId($id)->attribute("data-loaded") == "1") {
          return true;
        }
        return null;
      }, $waitTimeout
    );
  }

  /**
   * Return the form field element by its form id and its field name
   *
   * @param string $formId    the form id
   * @param string $fieldName the name of the field
   *
   * @return  PHPUnit_Extensions_Selenium2TestCase_Element the form field
   */
  function getFormField($formId, $fieldName) {
    return $this->byIdAndWait($formId."_".$fieldName);
  }

  /**
   * Take a screenshot of the current browser
   *
   * @param string $fileName the name of the screenshot
   *
   * @return void
   */
  public function screenshot($fileName) {
    $filedata = $this->currentScreenshot();
    file_put_contents(dirname(__DIR__). "/screens/".$fileName, $filedata);
  }

  /**
   * Change current window focus on frame
   *
   * @param string $module Module name where the frame opens
   * @param string $action Action triggered by the frame's opening
   *
   * @return void
   */
  public function changeFrameFocus($module, $action) {
    $this->frame($this->byCssSelectorAndWait("div[data-url='".$module."/".$action."'] iframe"));
  }


  /**
   * Set value to input with specified id with JavaScript
   *
   * @param string $id    InputField id
   * @param string $value Value
   *
   * @return void
   */
  public function setInputValueById($id, $value) {
    $this->execute(
      array(
        'script' => "\$V('$id','$value')",
        'args'   => array())
    );
  }

  /**
   * Set value to input with specified css selector with JavaScript
   *
   * @param string $CssSelector Css Selector
   * @param string $value       Value
   *
   * @return void
   */
  public function setInputValueByCss($CssSelector, $value) {
    $this->execute(
      array(
        'script' => "\$V($$('$CssSelector'),'$value')",
        'args'   => array())
    );
  }

}