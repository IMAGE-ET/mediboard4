<?php

/**
 * dPbloc
 *
 * @category Bloc
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version  SVN: $Id: do_salle_aed.php 19148 2013-05-15 12:41:42Z rhum1 $
 * @link     http://www.mediboard.org
 */

$do = new CDoObjectAddEdit("CSalle", "salle_id");
$do->doIt();
