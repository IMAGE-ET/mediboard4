<?php
/**
 * $Id: CTechniqueComp.class.php 25824 2014-11-10 13:48:27Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Cabinet
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25824 $
 */

/**
 * Les techniques complémentaires permettent de préciser les gestes d'anesthésie
 */
class CTechniqueComp extends CMbObject {
  // DB Table key
  public $technique_id;

  // DB References
  public $consultation_anesth_id;

  // DB fields
  public $technique;

  // References
  /** @var CConsultAnesth */
  public $_ref_consult_anesth;

  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec = parent::getSpec();
    $spec->table = 'techniques_anesth';
    $spec->key   = 'technique_id';
    return $spec;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $props = parent::getProps();
    $props["consultation_anesth_id"] = "ref notNull class|CConsultAnesth cascade";
    $props["technique"]              = "text helped";
    return $props;
  }

  /**
   * Charge la consultation d'anesthésie associée
   *
   * @return CConsultAnesth
   */
  function loadRefConsultAnesth() {
    return $this->loadFwdRef("consultation_anesth_id", true);
  }

  /**
   * @see parent::getPerm()
   */
  function getPerm($permType) {
    return $this->loadRefConsultAnesth()->getPerm($permType);
  }
}
