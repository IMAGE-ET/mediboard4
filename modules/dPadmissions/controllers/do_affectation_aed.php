<?php

/**
 * $Id: do_affectation_aed.php 19111 2013-05-13 16:35:48Z rhum1 $
 *
 * @category Admissions
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  $Revision: 19111 $
 * @link     http://www.mediboard.org
 */

$do = new CDoObjectAddEdit("CAffectation", "affectation_id");
$do->doIt();
