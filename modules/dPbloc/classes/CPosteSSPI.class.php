<?php
/**
 * $Id: CPosteSSPI.class.php 25649 2014-10-31 14:45:45Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Bloc
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 25649 $
 */

/**
 * Poste de SSPI (lit en salle de reveil)
 * Class CPosteSSPI
 */
class CPosteSSPI extends CMbObject {
  public $poste_sspi_id;
  
  // DB References
  public $group_id;
  public $bloc_id;

  // DB Fields
  public $nom;
  public $type;
  
  /** @var CBlocOperatoire */
  public $_ref_bloc;

  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec = parent::getSpec();
    $spec->table = 'poste_sspi';
    $spec->key   = 'poste_sspi_id';
    return $spec;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $props = parent::getProps();
    $props["bloc_id"]  = "ref class|CBlocOperatoire";
    $props["group_id"] = "ref class|CGroups notNull";
    $props["nom"]      = "str notNull seekable";
    $props["type"]     = "enum list|sspi|preop default|sspi";
    return $props;
  }

  /**
   * @see parent::getBackProps()
   */
  function getBackProps() {
    $backProps = parent::getBackProps();
    $backProps["operations"] = "COperation poste_sspi_id";
    $backProps["operations_preop"] = "COperation poste_preop_id";
    return $backProps;
  }

  /**
   * @see parent::updateFormFields()
   */
  function updateFormFields() {
    parent::updateFormFields();
    
    $this->_view = $this->nom;
  }

  /**
   * Chargement du bloc op�ratoire concern�
   *
   * @return CBlocOperatoire
   */
  function loadRefBloc() {
    return $this->_ref_bloc = $this->loadFwdRef("bloc_id");
  }
}
