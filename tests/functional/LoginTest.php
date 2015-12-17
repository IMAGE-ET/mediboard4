<?php

/**
 * LoginTest
 *
 * @description Try to connect to the app with params included in data/login.csv
 * @screen      LoginPage

 * @package    Mediboard
 * @subpackage Tests
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 */
class LoginTest extends SeleniumTestCase {

  /**
   * @dataProvider credentialProvider
   */
  public function testLogin($login, $password, $expected) {
    $loginPage = new LoginPage($this);
    $homePage = $loginPage->doLogin($login, $password);
    switch ($expected) {
      case "pass":
        $this->assertEquals(strtoupper($login), $this->byCssSelectorAndWait(".welcome")->text());
        $homePage->doLogOut();
        break;
      case "fail":
        if ($login == "" || $password == "") {
          $this->acceptAlert();
        }
        $this->assertEquals("LOCALHOST ? Connexion", utf8_decode($this->title()));
        break;
      default:
        //default
        break;
    }
  }

  /**
   * Provide login password informations
   * format login,password,pass|fail
   * see /test/data/login.csv for more details
   *
   * @return array
   */
  public function credentialProvider() {
    return new CsvFileIterator("login.csv");
  }

}