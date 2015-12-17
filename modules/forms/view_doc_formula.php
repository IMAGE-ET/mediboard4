<?php
/**
 * $Id: view_doc_formula.php 17759 2013-01-14 11:27:24Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage forms
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 17759 $
 */

CCanDo::checkEdit();

$smarty = new CSmartyDP();
$smarty->display("inc_doc_formula.tpl");
