<?php
/**
 * $Id: CUrlRestriction.class.php 19376 2013-06-02 20:13:59Z phenxdesign $
 *  
 * @package    Mediboard
 * @subpackage Installer
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    SVN: $Id: CUrlRestriction.class.php 19376 2013-06-02 20:13:59Z phenxdesign $ 
 * @link       http://www.mediboard.org
 */

/**
 * URL restriction
 */
class CUrlRestriction extends CPrerequisite {
  public $url = "";
  public $description = "";

  /**
   * Get the last HTTP code from a requested URL (follow redirection)
   * 
   * @param string $url URL to request
   * 
   * @return string
   */
  private function getHTTPResponseCode($url) {
    ini_set("default_socket_timeout", 2);
    @file_get_contents($url);
    $headers = $http_response_header;
  
    $response = false;
    if (is_array($headers)) {
      foreach ($headers as $header) {
        if (substr($header, 0, 4) == "HTTP") {
          $response = explode(" ", $header);
          $response = $response[1];
        }
      }
    }
    
    return $response;
  }

  /**
   * @see parent::check()
   */
  function check($strict = true){
    $code = substr($this->getHTTPResponseCode($this->url), 0, 3);
    return $code == 403;
  }

  /**
   * @see parent::getAll()
   */
  function getAll(){
    $http = "http://";
    if (array_key_exists("HTTPS", $_SERVER)) {
      $http = "https://";
    }

    $address = $_SERVER['SERVER_ADDR'];

    // IPv6 address
    if (strpos($address, ":") !== false) {
      $address = "[$address]";
    }

    $url = $http.dirname(dirname($address.$_SERVER['REQUEST_URI']));

    $restrictions = array();
    
    $restriction = new self;
    $restriction->url = "$url/files";
    $restriction->description = "R�pertoire des fichiers utilisateur";
    $restrictions[] = $restriction;
    
    $restriction = new self;
    $restriction->url = "$url/tmp";
    $restriction->description = "R�pertoire des fichiers temporaires";
    $restrictions[] = $restriction;
    
    $restriction = new self;
    $restriction->url = "$url/tmp/mb-log.html";
    $restriction->description = "Journal d'erreurs syst�me";
    $restrictions[] = $restriction;
    
    return $restrictions;
  }
}
