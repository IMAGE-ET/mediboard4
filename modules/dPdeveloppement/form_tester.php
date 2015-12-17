<?php
/**
 * $Id: form_tester.php 28031 2015-04-21 13:40:19Z mytto $
 *
 * @package    Mediboard
 * @subpackage developpement
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28031 $
 */

CCanDo::checkRead();

/**
 * Class CTestClass for form GUI test purposes
 */
class CTestClass extends CStoredObject {
  /**
   * @see parent::__construct()
   */
  function __construct() {
    foreach (CMbFieldSpecFact::$classes as $_prop => $class) {
      $this->$_prop = null;
    }

    parent::__construct();
    
    foreach ($this->_specs as $_spec) {
      $_spec->sample($this);
    }
  }

  /**
   * @see parent::getSpec()
   */
  function getSpec(){
    $spec = parent::getSpec();
    $spec->key = 'test_class_id';
    return $spec;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $specs = parent::getProps();
    foreach (CMbFieldSpecFact::$classes as $spec => $class) {
      $specs[$spec] = $spec;
    }
    $specs['enum'] .= ' list|1|2|3|4';
    $specs['set']  .= ' list|1|2|3|4';
    $specs['ref']  .= ' class|CMbObject';
    return $specs;
  }
}

// Création du template
$smarty = new CSmartyDP();
$smarty->assign('object', new CTestClass());
$smarty->assign('specs', CMbFieldSpecFact::$classes);
$smarty->display('form_tester.tpl');
