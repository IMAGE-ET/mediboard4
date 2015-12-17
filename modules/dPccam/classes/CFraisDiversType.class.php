<?php
/**
 * $Id: CFraisDiversType.class.php 21993 2014-02-11 08:25:28Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage ccam
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 21993 $
 */

/**
 * Type de frais divers
 */
class CFraisDiversType extends CMbObject {
  public $frais_divers_type_id;

  // DB fields
  public $code;
  public $libelle;
  public $tarif;
  public $facturable;

  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec = parent::getSpec();
    $spec->table = "frais_divers_type";
    $spec->key   = "frais_divers_type_id";
    $spec->uniques["code"] = array("code");
    return $spec;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $props = parent::getProps();
    $props["code"]        = "str notNull maxLength|16";
    $props["libelle"]     = "str notNull";
    $props["tarif"]       = "currency notNull";
    $props["facturable"]  = "bool notNull default|0";
    return $props;
  }

  /**
   * @see parent::updateFormFields()
   */
  function updateFormFields() {
    parent::updateFormFields();
    $this->_view = "$this->libelle ($this->code)";
  }

  /**
   * @see parent::getBackProps()
   */
  function getBackProps() {
    $backProps = parent::getBackProps();
    $backProps["frais_divers"] = "CFraisDivers type_id";
    return $backProps;
  }
}
