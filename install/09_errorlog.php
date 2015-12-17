<?php

/**
 * Installation error log
 *  
 * @package    Mediboard
 * @subpackage Installer
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version    SVN: $Id: 09_errorlog.php 18445 2013-03-17 16:08:44Z phenxdesign $ 
 * @link       http://www.mediboard.org
 */

require_once "includes/checkauth.php";

showHeader();

// Disable output buffer to be able to see big error logs
ob_end_clean();

// Escape if the file doesn't exist
@readfile("../tmp/mb-log.html");

showFooter();
