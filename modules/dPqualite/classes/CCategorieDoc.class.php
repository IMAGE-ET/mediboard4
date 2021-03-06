<?php
/**
 * $Id: CCategorieDoc.class.php 19316 2013-05-28 09:33:17Z rhum1 $
 *
 * @package    Mediboard
 * @subpackage Qualite
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19316 $
 */

/**
 * Cat�gories de document qualit�
 * Class CCategorieDoc
 */
class CCategorieDoc extends CMbObject {
  // DB Table key
  public $doc_categorie_id;
    
  // DB Fields
  public $nom;
  public $code;

  /**
   * @see parent::getSpec()
   */
  function getSpec() {
    $spec = parent::getSpec();
    $spec->table = 'doc_categories';
    $spec->key   = 'doc_categorie_id';
    return $spec;
  }

  /**
   * @see parent::getBackProps()
   */
  function getBackProps() {
    $backProps = parent::getBackProps();
    $backProps["documents_ged"] = "CDocGed doc_categorie_id";
    return $backProps;
  }

  /**
   * @see parent::getProps()
   */
  function getProps() {
    $specs = parent::getProps();
    $specs["nom"]  = "str notNull maxLength|50";
    $specs["code"] = "str notNull maxLength|1";
    return $specs;
  }

  /**
   * @see parent::updateFormFields()
   */
  function updateFormFields() {
    parent::updateFormFields();
    $this->_view = "$this->code - $this->nom";
    $this->_shortview = $this->code; 
  }
}
