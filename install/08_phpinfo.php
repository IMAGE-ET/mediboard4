<?php
/**
 * PHP general installation
 *  
 * @package    Mediboard
 * @subpackage Installer
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    SVN: $Id: 08_phpinfo.php 18445 2013-03-17 16:08:44Z phenxdesign $ 
 * @link       http://www.mediboard.org
 */

require_once "includes/checkauth.php";

showHeader();
?>

<div style="font-size: 14px;">
  
  <?php phpinfo(); ?>
  
</div>

<?php showFooter(); ?>