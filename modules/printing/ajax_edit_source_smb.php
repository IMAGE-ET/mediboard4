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
CValue::setSession("class", "CSourceSMB");

CView::checkin();

$source_smb = new CSourceSMB();
$source_smb->load($source_id);

if (!$source_smb->_id) {
  $source_smb->valueDefaults();
}

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("source_smb", $source_smb);

$smarty->display("inc_edit_source_smb.tpl");
