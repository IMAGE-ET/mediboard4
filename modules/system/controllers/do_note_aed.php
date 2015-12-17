<?php
/**
 * $Id: do_note_aed.php 19290 2013-05-26 19:48:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage System
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19290 $
 */

$do = new CDoObjectAddEdit("CNote", "note_id");
$do->doIt();
