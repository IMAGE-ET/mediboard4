<?php

/**
 * $Id$
 *  
 * @category XDS
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision$
 * @link     http://www.mediboard.org
 */
 
/**
 * Xpath class for XDS
 */
class CXDSXPath extends CMbXPath {

  /**
   * @see parent::__construct()
   */
  function __construct($xml) {
    parent::__construct($xml);
    $this->registerNamespace("rim", "urn:oasis:names:tc:ebxml-regrep:xsd:rim:3.0");
    $this->registerNamespace("xds", "urn:ihe:iti:xds-b:2007");
  }

  /**
   * Return the list of extrinsic objects
   *
   * @return DOMNodeList
   */
  function getExtrinsicObjects() {
    return $this->query("//rim:ExtrinsicObject");
  }

  /**
   * Return the value of unique ID
   *
   * @param DOMNode $node                 Node
   * @param String  $identificationScheme Specify the external Identifier
   *
   * @return string
   */
  function getExternalIdentifier($node, $identificationScheme) {
    return $this->queryAttributNode("rim:ExternalIdentifier[@identificationScheme='$identificationScheme']", $node, "value");
  }

  /**
   * Return the value of classification
   *
   * @param DOMNode $node                 Node
   * @param String  $classificationScheme Specify the classification
   *
   * @return string
   */
  function getClassification($node, $classificationScheme) {
    return $this->queryAttributNode("rim:Classification[@classificationScheme='$classificationScheme']", $node, "nodeRepresentation");
  }

  /**
   * Return the value of the slot
   *
   * @param DOMNode $node     Node
   * @param String  $name     Name of the slot
   * @param bool    $multiple Multiple value in the slot
   *
   * @return array|string
   */
  function getSlot($node, $name, $multiple = false) {
    if ($multiple) {
      return $this->getMultipleTextNodes("rim:Slot[@name='$name']/rim:ValueList/rim:Value", $node);
    }
    return $this->queryTextNode("rim:Slot[@name='$name']/rim:ValueList/rim:Value", $node);
  }

  /**
   * Return the document
   *
   * @param DOMNode $extrinsicObject Node of the extrinsic object
   *
   * @return String
   */
  function getDocument($extrinsicObject) {
    $identifiant = $this->queryAttributNode(".", $extrinsicObject, "id");
    return $this->queryTextNode("//xds:Document[@id='$identifiant']");
  }

  /**
   * Return the target object on the association
   *
   * @param String $associationType association type
   * @param String $sourceObject    source object
   *
   * @return string
   */
  function getAssociationTargetObject($associationType, $sourceObject) {
    return $this->queryAttributNode("//rim:Association[@associationType='$associationType' and @sourceObject='$sourceObject']", null, "targetObject");
  }
}