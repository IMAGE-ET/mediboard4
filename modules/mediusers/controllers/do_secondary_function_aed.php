<?php

/**
 * Secondary function
 *
 * @category Mediusers
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: do_secondary_function_aed.php 19463 2013-06-07 10:36:29Z lryo $
 * @link     http://www.mediboard.org
 */

$do = new CDoObjectAddEdit("CSecondaryFunction", "secondary_function_id");
$do->doIt();
