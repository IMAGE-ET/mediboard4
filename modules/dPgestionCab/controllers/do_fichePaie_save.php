<?php
/**
 * $Id: do_fichePaie_save.php 19621 2013-06-20 20:40:45Z phenxdesign $
 *
 * @package    Mediboard
 * @subpackage GestionCab
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 19621 $
 */

mbTrace("Start");
$do = new CDoObjectAddEdit("CFichePaie");
$do->redirect = null;
$do->doIt();
mbTrace("End");

$fichePaie = new CFichePaie();
$fichePaie->load($do->_obj->_id);
$fichePaie->loadRefsFwd();
$fichePaie->_ref_params_paie->loadRefsFwd();

// Création du template
$smarty = new CSmartyDP();
$smarty->assign("fichePaie" , $fichePaie);

$fichePaie->final_file = $smarty->fetch("print_fiche.tpl");
mbTrace($fichePaie->store());
CApp::rip();
