<?php 
/**
 * View Edit Source
 *  
 * @category PRINTING
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version  SVN: $Id:$ 
 * @link     http://www.mediboard.org
 */

CCanDo::checkEdit();

$source_id  = CView::get("source_id", "num default|0", true);
CValue::setSession("class", "CSourceLPR");

CView::checkin();

$source_lpr = new CSourceLPR();
$source_lpr->load($source_id);

if (!$source_lpr->_id) {
  $source_lpr->valueDefaults();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("source_lpr", $source_lpr);

$smarty->display("inc_edit_source_lpr.tpl");
