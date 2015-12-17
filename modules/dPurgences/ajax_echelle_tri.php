<?php
/**
 * $Id: ajax_echelle_tri.php 28128 2015-04-29 13:16:11Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage Urgences
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28128 $
 */

CCanDo::checkRead();
$rpu_id       = CValue::getOrSession("rpu_id");

$rpu    = new CRPU;
$rpu->load($rpu_id);
$rpu->loadRefEchelleTri();
$rpu->updateFormFields();
$rpu->_ref_sejour->loadRefGrossesse();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("rpu"    , $rpu);
$smarty->assign("sejour" , $rpu->_ref_sejour);
$smarty->assign("patient", $rpu->_ref_sejour->_ref_patient);

$smarty->display("vw_echelle_tri.tpl");