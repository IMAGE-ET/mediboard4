<?php

/**
 * Installation page representation
 *
 * @package    Tests
 * @subpackage Pages
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link       http://www.mediboard.org
 */
class InstallPage {

  /** @var  SeleniumTestCase $driver */
  public $driver;

  function __construct($driver) {
    $this->driver = $driver;
    if ($this->module_name) {
      $this->driver->url("fresh_install/");
    }
  }

}