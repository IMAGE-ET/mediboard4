<?php
/**
 * $Id: CDFMObject.class.php 28915 2015-07-09 07:59:37Z phenxdesign $
 *
 * @category FileUtils
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 28915 $
 * @link     http://www.mediboard.org
 */

/**
 * Delphi Form object (in DFM files)
 */
class CDFMObject {
  public $id;
  public $classname;
  public $csscolor;
  public $picture_data;
  public $valeur;
  public $color;

  public $zeros = 0;
  public $ischild  = false;
  public $children = array();
  public $parent;

  /**
   * Costruct an object from it's ID and classname
   *
   * @param string $classname Class name
   * @param string $id        ID
   */
  function __construct($classname, $id) {
    $this->classname = $classname;
    $this->id        = $id;
  }

  /**
   * Build the image data URI
   *
   * @return null|string
   */
  function getImageDataUri() {
    if (empty($this->picture_data)) {
      return null;
    }

    $type = $this->picture_data["type"];
    $data = $this->picture_data["data"];

    switch ($type) {
      case "TJPEGImage":
        return "data:image/jpeg;base64,".base64_encode($data);

      case "TPNGImage":
        return "data:image/png;base64,".base64_encode($data);
    }

    return null;
  }
}
