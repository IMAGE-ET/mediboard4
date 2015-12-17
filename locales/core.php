<?php /** $Id: core.php 20730 2013-10-22 15:15:05Z phenxdesign $ **/

/**
 * @package Mediboard
 * @subpackage locales
 * @version $Revision: 20730 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

CAppUI::loadLocales();

// Encoding definition
require __DIR__."/".CAppUI::$lang."/meta.php";
