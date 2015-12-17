<?php 
/**
 * $Id: CMbObjectTest.class.php 20601 2013-10-10 13:45:17Z phenxdesign $
 * 
 * @package    Mediboard
 * @subpackage classes
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 20601 $
 */

class CMbObjectTest {
  
  public $log = "";
  
  function sample($object, $staticsProps = array()){
    foreach ($object->_specs as $key => $spec) {
      if (isset($staticsProps[$key])) {
        $object->$key = $staticsProps[$key];
      }
      elseif ($key[0] != "_") {
        $spec->sample($object, false);
      }
    }
  }
  
  function testFunction(&$object, $function_name, $params = array()) {
    $str_params = implode(",", $params);
    $result = $object->$function_name($str_params);
    $log = "<div class=\"message\">".get_class($object)."::$function_name($str_params) -> $result</div>".CAppUI::getMsg();
    $this->addLog($log);
  }
  
  function resetLog() {
    $this->log = "";
  }
  
  function addLog($log) {
    $this->log .= "$log<br />";
  }
  
  function getLog() {
    return $this->log;
  }
  
}
