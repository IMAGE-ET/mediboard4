<?php 
/**
 * $Id: CMbTemplatePlaceholder.class.php 18308 2013-03-05 13:17:50Z phenxdesign $
 * 
 * @package    Mediboard
 * @subpackage classes
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    $Revision: 18308 $
 */

/**
 * Class CMbTemplatePlaceholder 
 * @abstract Template placeholder class for module extensibility of main style templates
 */
abstract class CMbTemplatePlaceholder {
  public $module;
  public $minitoolbar;
  
  function __construct($module) {
    $this->module = $module;
  }
}
