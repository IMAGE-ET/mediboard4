<?php
/**
 * $Id: do_plageconge_aed.php 20462 2013-09-25 14:20:38Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage dPpersonnel
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 20462 $
 */

$do = new CDoObjectAddEdit("CPlageConge", "plage_id");
$do->doIt();
