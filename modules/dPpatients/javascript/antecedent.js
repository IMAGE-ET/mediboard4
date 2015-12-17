Antecedent = {
  remove: function(oForm, onComplete) {
    var oOptions = {
      typeName: 'cet antécédent',
      ajax: 1,
      target: 'systemMsg'
    };

    onComplete = onComplete || Prototype.emptyFunction;
    var oOptionsAjax = {
      onComplete: function() {
        if (window.reloadAtcd) {
          reloadAtcd();
        }
        onComplete();
      }
    };

    confirmDeletion(oForm, oOptions, oOptionsAjax);
  },

  cancel: function(oForm, onComplete) {
    $V(oForm.annule, 1);
    onSubmitFormAjax(oForm, function(){
        if (window.reloadAtcdMajeur) {
          reloadAtcdMajeur();
        }
        if (window.reloadAtcd) {
          reloadAtcd();
        }
        if (window.reloadAtcdOp) {
          reloadAtcdOp();
        }
        if (onComplete) {
          onComplete();
        }
    });
    $V(oForm.annule, '');
  },

  restore: function(oForm, onComplete) {
    $V(oForm.annule, '0');
    onSubmitFormAjax(oForm, function() {
      if (window.reloadAtcd) {
        reloadAtcd();
      }
      if (onComplete) {
        onComplete();
      }
    });
    $V(oForm.annule, '');
  },

  toggleCancelled: function(list) {
    $(list).select('.cancelled').invoke('toggle');
  },

  editAntecedents: function(patient_id, type, callback, antecedent_id){
    var url = new Url("dPpatients", "ajax_edit_antecedents");
    url.addParam("patient_id", patient_id);
    url.addParam("type", type);
    if (antecedent_id) {
      url.addParam("antecedent_id", antecedent_id);
    }
    if (callback) {
      url.addParam('callback', callback);
    }

    url.requestModal(700, 400);
  },

  closeTooltip: function(object_guid) {
    $(object_guid+'_tooltip').up('.tooltip').remove();
  },

  duplicate: function(form) {
    $V(form.dosql, 'do_duplicate_antecedent_aed');
    onSubmitFormAjax(form, {onComplete: function(){
      if (onComplete) {
        $V(form.dosql, 'do_antecedent_aed');
      }
    }});
  },

  loadAntecedents: function(patient_guid, show_atcd, sejour_id, unique_atcd) {
    var url = new Url('soins', 'vw_antecedents_allergies');
    url.addParam('patient_guid' , patient_guid);
    url.addParam('show_atcd'    , show_atcd);
    url.addParam('sejour_id'    , sejour_id);
    url.requestUpdate('id_antecedents_allergies_'+patient_guid+'_'+unique_atcd);
  }
};