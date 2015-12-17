<?php
/**
 * $Id: httpreq_vw_examens_catalogues.php 19285 2013-05-26 13:10:13Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage Labo
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19285 $
 */

CCanDo::checkRead();

$catalogue_labo_id = CValue::getOrSession("catalogue_labo_id");

// Chargement du catalogue demandé
$catalogue = new CCatalogueLabo;
$catalogue->load($catalogue_labo_id);
$catalogue->loadRefs();

// Création du template
$smarty = new CSmartyDP();

$smarty->assign("search", 0);
$smarty->assign("catalogue", $catalogue);

$smarty->display("inc_vw_examens_catalogues.tpl");
