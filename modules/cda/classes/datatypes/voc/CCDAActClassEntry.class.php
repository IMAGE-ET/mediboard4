<?php

/**
 * $Id$
 *
 * @category CDA
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @link     http://www.mediboard.org
 */

/**
 * specDomain: V19444 (C-0-D11527-V13856-V19445-V19444-cpt)
 */
class CCDAActClassEntry extends CCDA_Datatype_Voc {

  public $_enumeration = array (
    'ENTRY',
    'BATTERY',
    'CLUSTER',
  );
  public $_union = array (
  );


  /**
   * Retourne les propri�t�s
   *
   * @return array
   */
  function getProps() {
    parent::getProps();
    $props["data"] = "str xml|data enum|".implode("|", $this->getEnumeration(true));
    return $props;
  }
}