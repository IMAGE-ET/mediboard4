<?php
/**
 * $Id: do_treat_evenements.php 28893 2015-07-07 15:08:19Z aurelie17 $
 *
 * @package    Mediboard
 * @subpackage SSR
 * @author     SARL OpenXtrem <dev@openxtrem.com>
 * @license    GNU General Public License, see http://www.gnu.org/licenses/gpl.html
 * @version    $Revision: 28893 $
 */

// Ajustement des actes CsARR
/** @var CActeCsARR[] $actes */
$actes = array();

// Récupération des modulateurs
$modulateurs = CValue::post("modulateurs");
$modulateurs = $modulateurs ? explode("|", $modulateurs) : array();
foreach ($modulateurs as $_modulateur) {
  list($acte_id, $modulateur) = explode("-", $_modulateur);

  if (!isset($actes[$acte_id])) {
    $acte = new CActeCsARR();
    $acte->load($acte_id);
    $acte->_modulateurs = array();
    $acte->_phases      = array();
    $actes[$acte_id] = $acte;
  }

  $acte = $actes[$acte_id];
  $acte->_modulateurs[] = $modulateur;
}

// Récupération des phases
$phases = CValue::post("phases");
$phases = $phases ? explode("|", $phases) : array();
foreach ($phases as $_phase) {
  list($acte_id, $phase) = explode("-", $_phase);
  if (!isset($actes[$acte_id])) {
    $acte = new CActeCsARR();
    $acte->load($acte_id);
    $acte->_modulateurs = array();
    $acte->_phases      = array();
    $actes[$acte_id] = $acte;
  }

  $acte = $actes[$acte_id];
  $acte->_phases[] = $phase;
}

// Récupération des commentaires
$commentaires_id = CValue::post("commentaires_id");
$commentaires_id = $commentaires_id ? explode("|", $commentaires_id) : array();
$commentaires = CValue::post("commentaires");
$commentaires = $commentaires ? explode("|", $commentaires) : array();
foreach ($commentaires as $key => $_commentaire) {
  $explode = explode("_", $commentaires_id[$key]);
  $acte_id = $explode[1];
  if (!isset($actes[$acte_id])) {
    $acte = new CActeCsARR();
    $acte->load($acte_id);
    $acte->_modulateurs = array();
    $acte->_phases      = array();
    $actes[$acte_id] = $acte;
  }
  $acte = $actes[$acte_id];
  $acte->commentaire = $_commentaire;
}

// Enregistrements des actes ajustés
foreach ($actes as $_acte) {
  $msg = $_acte->store();
  CAppUI::displayMsg($msg, "CActeCsARR-msg-modify");
}

$seances_collective = array();
// Réalisation des événements
$event_ids = CValue::post("realise_ids");
$event_ids = $event_ids ? explode("|", $event_ids) : array();
foreach ($event_ids as $_event_id) {
  $evenement = new CEvenementSSR();
  $evenement->load($_event_id);
  
  // Autres rééducateurs
  global $can;
  $therapeute_id = $evenement->therapeute_id;
  if ($evenement->seance_collective_id) {
    $seances_collective[$evenement->seance_collective_id] = $evenement;
    $therapeute_id = $evenement->loadRefSeanceCollective()->therapeute_id;
  }
  if ($therapeute_id !=  CAppUI::$instance->user_id && !$can->admin) {
    CAppUI::displayMsg("Impossible de modifier les événements d'un autre rééducateur", "CEvenementSSR-msg-modify");
    continue;
  }
  
  // Suppression des evenements SSR
  $evenement->realise = "1";
  $evenement->annule  = "0";
  $evenement->_traitement = "1";
  $msg = $evenement->store();
  CAppUI::displayMsg($msg, "CEvenementSSR-msg-modify");
}

// Annulation
$event_ids = CValue::post("annule_ids");
$event_ids = $event_ids ? explode("|", $event_ids) : array();
foreach ($event_ids as $_event_id) {
  $evenement = new CEvenementSSR();
  $evenement->load($_event_id);
  
  // Autres rééducateurs
  global $can;
  $therapeute_id = $evenement->therapeute_id;
  if ($evenement->seance_collective_id) {
    $seances_collective[$evenement->seance_collective_id] = $evenement;
    $therapeute_id = $evenement->loadRefSeanceCollective()->therapeute_id;
  }
  if ($therapeute_id !=  CAppUI::$instance->user_id && !$can->admin) {
    CAppUI::displayMsg("Impossible de modifier les événements d'un autre rééducateur", "CEvenementSSR-msg-modify");
    continue;
  }
  
  // Suppression des evenements SSR
  $evenement->realise = "0";
  $evenement->annule  = "1";
  $evenement->_traitement = "1";
  $msg = $evenement->store();
  CAppUI::displayMsg($msg, "CEvenementSSR-msg-modify");
}

foreach($seances_collective as $key => $event) {
  $collectif = new CEvenementSSR();
  $collectif->load($key);
  $realise = 1;
  $annule = 0;
  foreach ($collectif->loadRefsEvenementsSeance() as $_event_seance) {
    if (!$_event_seance->realise) { $realise = 0; }
    if ($_event_seance->annule) { $annule ++; }
  }
  $collectif->_traitement = 1;
  if ($annule == count($collectif->_ref_evenements_seance)) {
    $collectif->annule = 1;
  }
  $collectif->realise = $realise;
  $msg = $collectif->store();
  CAppUI::displayMsg($msg, "CEvenementSSR-msg-modify");
}

// Nombre d'intervenant pour les séances collectives
$nb_intervs = CValue::post("nb_interv");
$nb_inter_by_evnt = array();
if ($nb_intervs) {
  foreach(explode("|", $nb_intervs) as $_nb_interv) {
    list($evenement_id, $nb_interv) = explode("-", $_nb_interv);
    $nb_inter_by_evnt[$evenement_id] = $nb_interv;
  }
}

// Nombre de patient pour les séances collectives
$nb_patients = CValue::post("nb_patient");
$nb_patients = $nb_patients ? explode("|", $nb_patients) : array();
foreach ($nb_patients as $_nb_patients) {
  list($evenement_id, $nb_patient) = explode("-", $_nb_patients);
  $evenement = new CEvenementSSR();
  $evenement->load($evenement_id);
  if ($evenement->annule) {
    continue;
  }

  // Ajout du nombre de patient présent aux evenements SSR
  $evenement->nb_patient_seance     = $nb_patient;
  $evenement->nb_intervenant_seance = $nb_inter_by_evnt[$evenement_id];
  $evenement->_traitement = "1";
  $msg = $evenement->store();
  CAppUI::displayMsg($msg, "CEvenementSSR-msg-modify");
}

echo CAppUI::getMsg();
CApp::rip();
