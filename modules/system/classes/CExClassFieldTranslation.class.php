<?php
/**
 * $Id: CExClassFieldTranslation.class.php 20730 2013-10-22 15:15:05Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20730 $
 */

class CExClassFieldTranslation extends CMbObject {
  public $ex_class_field_translation_id;
  
  public $ex_class_field_id;
  public $lang;
  
  public $std;
  public $desc;
  public $court;

  /** @var CExClassField */
  public $_ref_ex_class_field;

  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec = parent::getSpec();
    $spec->table = "ex_class_field_translation";
    $spec->key   = "ex_class_field_translation_id";
    $spec->uniques["lang"] = array("ex_class_field_id", "lang");
    return $spec;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $props = parent::getProps();
    $props["ex_class_field_id"] = "ref notNull class|CExClassField cascade";
    $props["lang"]  = "enum list|fr|en"; // @todo: en fonction des repertoires
    $props["std"]   = "str";
    $props["desc"]  = "str";
    $props["court"] = "str";
    return $props;
  }
  
  function getKey(){
    $field = $this->loadRefExClassField();
    $class = $field->loadRefExClass();
    return "CExObject_{$class->_id}-{$field->name}";
  }
  
  /**
   * @param integer $field_id
   *
   * @return CExClassFieldTranslation
   */
  static function tr($field_id) {
    static $cache = array();

    $lang = CAppUI::pref("LOCALE");
    
    if (isset($cache[$lang][$field_id])) {
      return $cache[$lang][$field_id];
    }
    
    $trans = new self;
    $trans->lang = $lang;
    $trans->ex_class_field_id = $field_id;
    
    if ($trans->loadMatchingObject()) {
      $cache[$lang][$field_id] = $trans;
    }
    
    return $trans;
  }

  /**
   * @see parent::updateFormFields()
   */
  function updateFormFields(){
    parent::updateFormFields();
    
    $this->_view = $this->std;
  }
  
  function fillIfEmpty($str) {
    if (!$this->_id) {
      $this->std = $this->desc = $this->court = $str;
      $this->updateFormFields();
      $this->std = $this->desc = $this->court = "";
    }
  }
  
  /**
   * @param bool $cache [optional]
   *
   * @return CExClassField
   */
  function loadRefExClassField($cache = true){
    return $this->_ref_ex_class_field = $this->loadFwdRef("ex_class_field_id", $cache);
  }

  /**
   * @see parent::store()
   */
  function store(){
    if ($msg = parent::store()) {
      return $msg;
    }
    
    CExObject::clearLocales();

    return null;
  }
}
