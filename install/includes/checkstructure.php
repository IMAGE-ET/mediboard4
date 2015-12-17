<?php
/**
 * $Id: checkstructure.php 22458 2014-03-15 15:00:05Z phenxdesign $
 *  
 * @package    Mediboard
 * @subpackage Installer
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    SVN: $Id: checkstructure.php 22458 2014-03-15 15:00:05Z phenxdesign $ 
 * @link       http://www.mediboard.org
 */

require_once "header.php";

$db = CMbDb::getStd();

if (!$db->getOne("SELECT * FROM users")) {
  showHeader();
?>

<div class="small-error">
  Erreur : la structure de la base de données principale n'a pas été construite, il est
  donc impossible de finaliser l'installation.
  <br />Retourner à l'étape précédente pour construire la structure.
</div>

<?php
showFooter();
}
