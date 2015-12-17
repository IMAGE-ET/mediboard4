<?php
/**
 * $Id: vw_suivi_salles.php 19701 2013-06-27 16:22:52Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19701 $
 */

global $can;
$can->read = 1;
$can->edit = 0;

CAppUI::requireModuleFile("dPbloc", "vw_suivi_salles");
