<?php 
/**
 * View Printing Sources
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
$class      = CView::get("class", "enum list|CSourceLPR|CSourceSMB default|CSourceLPR", true);

CView::checkin();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("source_id" , $source_id);
$smarty->assign("class"     , $class);

$smarty->display("vw_idx_sources.tpl");
