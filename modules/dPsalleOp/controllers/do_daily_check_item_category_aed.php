<?php
/**
 * $Id: do_daily_check_item_category_aed.php 19615 2013-06-20 14:28:18Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage SalleOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19615 $
 */

$do = new CDoObjectAddEdit("CDailyCheckItemCategory");
$do->redirect = "m=dPsalleOp&a=vw_daily_check_item_category";
$do->doIt();
