<?php

/**
 * Discipline
 *
 * @category Mediusers
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: do_discipline_aed.php 19463 2013-06-07 10:36:29Z lryo $
 * @link     http://www.mediboard.org
 */

$do = new CDoObjectAddEdit("CDiscipline", "discipline_id");
$do->doIt();
