/* $Id: $ */

/**
 * @package Mediboard
 * @subpackage ssr
 * @version $Revision: 7795 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

ModalValidation = {
  window: null,
  kine_id: null,

  form: function() {
    return getForm("editSelectedEvent");
  },

  formModal: function() {
    return getForm("TreatEvents");
  },

  toggleSejour: function(sejour_id, type) {
    $('list-evenements-modal').select('input.CSejour-'+sejour_id+'.'+type).each(function(checkbox) {
      checkbox.checked = true;
      checkbox.onchange();
    });
  },

  select: function() {
    var event_ids = [];
    $$(".event.selected").each(function(e){
      var matches = e.className.match(/CEvenementSSR-([0-9]+)/);
      if (matches) {
        event_ids.push(matches[1]);
      }
    });

    var form = this.form();
    $V(form.event_ids, event_ids.join('|'));
    return $V(form.event_ids);
  },

  selectCheckboxes: function() {
    // Réalisations-annulations
    var realise_ids = [];
    var annule_ids  = [];
    var modulateurs = [];
    var phases      = [];
    var nb_patient  = [];
    var nb_interv  = [];
    var commentaires    = [];
    var commentaires_id = [];

    $('list-evenements-modal').select('input[type="checkbox"]').each(function(checkbox) {
      if (checkbox.checked) {
        if (checkbox.hasClassName('realise'   )) realise_ids.push(checkbox.value);
        if (checkbox.hasClassName('annule'    )) annule_ids .push(checkbox.value);
        if (checkbox.hasClassName('modulateur')) modulateurs.push(checkbox.value);
        if (checkbox.hasClassName('phase'     )) phases     .push(checkbox.value);
      }
    });

    $('list-evenements-modal').select('input[type="text"]').each(function(input) {
      if ($V(input)) {
        if (input.hasClassName('nb_patient')) nb_patient.push(input.form.get('evenement_id') + "-" + input.value);
        if (input.hasClassName('nb_interv')) nb_interv.push(input.form.get('evenement_id') + "-" + input.value);
      }
      if (input.hasClassName('commentaires')) commentaires.push(input.id + "-" + input.value);
    });
    $('list-evenements-modal').select('textarea').each(function(input) {
      if (input.hasClassName('commentaires')) {
        commentaires_id.push(input.id);
        commentaires.push(input.value);
      }
    });

    var form = this.formModal();
    $V(form.realise_ids , realise_ids.join('|'));
    $V(form.annule_ids  , annule_ids .join('|'));
    $V(form.modulateurs , modulateurs.join('|'));
    $V(form.phases      , phases     .join('|'));
    $V(form.nb_patient  , nb_patient .join('|'));
    $V(form.nb_interv   , nb_interv .join('|'));
    $V(form.commentaires, commentaires.join('|'));
    $V(form.commentaires_id, commentaires_id.join('|'));
  },

  checkedAllNbPatients: function () {
    var result_nb_interv = true;
    var result_nb_patient = true;
    $('list-evenements-modal').select('input[type="text"]').each(function(input) {
      if (!$V(input) ) {
        var evenement_guid = "CEvenementSSR-"+input.form.get('evenement_id');
        var annule = null;
        $('list-evenements-modal').select('input[type="checkbox"]').each(function(evt) {
          if (evt.hasClassName('annule') && evt.hasClassName(evenement_guid)) {
            annule = evt;
          }
        });
        if (annule && !annule.checked) {
          //Si l'evenement n'est pas annulé
          if (input.hasClassName('nb_patient')) {
            result_nb_patient = false;
          }
          else {
            result_nb_interv = false;
          }
        }
      }
    });

    if (!result_nb_patient || !result_nb_interv) {
      alert("Veuillez renseigner le nombre de patient et le nombre d'intervenants pour les séances collectives");
    }
    return result_nb_patient && result_nb_interv;
  },

  set: function(values) {
    Form.fromObject(this.form(), values);
  },

  // Erase mode
  submit: function() {
    this.select();
    return onSubmitFormAjax(this.form(), { onComplete: function() { 
      PlanningTechnicien.show(this.kine_id, null, null, 650, true);
    } });
  },

  submitModal: function() {
    this.selectCheckboxes();
    if (this.checkedAllNbPatients() == true) {
      return onSubmitFormAjax(this.formModal(), function() {
        PlanningTechnicien.show(this.kine_id, null, null, 650, true);
        ModalValidation.close();
      });
    }
  },

  update: function() {
    this.select();
    this.open();

    var form = this.form();
    var url = new Url("ssr", "ajax_update_modal_evenements");
    url.addParam("token_field_evts", $V(form.event_ids));
    url.requestUpdate("modal_evenements", function() {
      ModalValidation.window.position();
    });
  },

  open: function(){
    this.window = Modal.open($('modal_evenements'), {
      width: -100,
      height: 500
    });
  },

  close: function() {
    this.window.close();
    $('modal_evenements').update();
  },

  editComm: function(acte_id){
    var div = $('show_com_'+acte_id);
    if (div.getStyle("display") == "none") {
      div.show();
    }
    else {
      div.hide();
    }
  }
};