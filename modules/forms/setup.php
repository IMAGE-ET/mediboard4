<?php
/**
 * $Id: setup.php 17759 2013-01-14 11:27:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 17759 $
 */

class CSetupforms extends CSetup {
  function __construct() {
    parent::__construct();

    $this->mod_name = "forms";
    $this->makeRevision("all");

    $this->mod_version = "0.01";
  }
}
