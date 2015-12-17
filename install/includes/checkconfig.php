<?php
/**
 * $Id: checkconfig.php 18445 2013-03-17 16:08:44Z phenxdesign $
 *  
 * @package    Mediboard
 * @subpackage Installer
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    SVN: $Id: checkconfig.php 18445 2013-03-17 16:08:44Z phenxdesign $ 
 * @link       http://www.mediboard.org
 */

require_once "header.php";

if (!@include_once $mbpath."includes/config.php") {
  showHeader();
?>
  
  <div class="small-error">
    Erreur : Le fichier de configuration n'a pas été validé, merci de revenir à l'étape 
    précédente.
  </div>
  
<?php
  showFooter();
}
?>