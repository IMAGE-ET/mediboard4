<?php

/**
 * Login page representation
 *
 * @package    Tests
 * @subpackage Pages
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 */
class LoginPage {

  /** @var  SeleniumTestCase $driver */
  public $driver;

  /**
   * Login page constructor
   *
   * @param SeleniumTestCase $driver Instance of a WebDriver
   */
  function __construct($driver) {
    $this->driver = $driver;
    $this->driver->url("/");
  }

  /**
   * Fill the login form field
   *
   * @param string $login User login
   *
   * @return null
   */
  function setLogin($login) {
    $loginEdit = $this->driver->getFormField("loginFrm", "username");
    $loginEdit->value($login);
  }

  /**
   * Fill the password form field
   *
   * @param string $passwd User password
   *
   * @return null
   */
  function setPasswd($passwd) {
    $passwordEdit = $this->driver->getFormField("loginFrm", "password");
    $passwordEdit->value($passwd);
  }

  /**
   * Perform a click on the login button
   *
   * @return null
   */
  function clickLoginButton() {
    $loginButton = $this->driver->byCssSelector(".button > button:nth-child(1)");
    $loginButton->click();
  }

  /**
   * Perform the login action with the login et password params
   *
   * @param string $login  User login
   * @param string $passwd User password
   *
   * @return ConsultationsPage
   */
  function doLogin($login, $passwd) {
    $this->setLogin($login);
    $this->setPasswd($passwd);
    $this->clickLoginButton();
    if (!isset($login) || !isset($passwd)) {
      $this->driver->acceptAlert();
    }
    return new HomePage($this->driver);
  }

}