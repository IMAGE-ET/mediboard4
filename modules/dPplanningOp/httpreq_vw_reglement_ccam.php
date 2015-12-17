<?php
/**
 * $Id: httpreq_vw_reglement_ccam.php 19840 2013-07-09 19:36:14Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage PlanningOp
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19840 $
 */

// Recuperation de l'id de l'acte CCAM
$acte_ccam_id = CValue::getOrSession("acte_ccam_id");

// Chargement de l'acte CCAM
$acte = new CActeCCAM();
$acte->load($acte_ccam_id);

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("acte_ccam", $acte);
$smarty->display("inc_vw_reglement_ccam.tpl");
