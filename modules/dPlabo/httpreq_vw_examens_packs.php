<?php
/**
 * $Id: httpreq_vw_examens_packs.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

$user = CMediusers::get();

$pack_examens_labo_id = CValue::getOrSession("pack_examens_labo_id");

// Chargement du pack demandé
$pack = new CPackExamensLabo;
$pack->load($pack_examens_labo_id);
$pack->loadRefs();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("pack", $pack);

$smarty->display("inc_vw_examens_packs.tpl");
