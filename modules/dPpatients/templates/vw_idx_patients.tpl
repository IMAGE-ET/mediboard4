{{* $Id: vw_idx_patients.tpl 28482 2015-06-02 15:33:42Z rhum1 $ *}}

{{mb_script module="dPcompteRendu" script="document"}}
{{mb_script module="patients" script="patient"}}

<script>
  markAsSelected = function(anchor) {
    if (anchor) {
      $(anchor).up('tr').addUniqueClassName('selected');
    }
  };
</script>

<table class="main">
  <tr>
    <td class="halfPane">
      {{mb_include template="inc_list_patient"}}
    </td>
    {{if !$board}}
    <td class="halfPane" id="vwPatient">
      <div class="small-info">
        Veuillez sélectionner un patient sur la gauche pour pouvoir le visualiser
      </div>
    </td>
    {{/if}}
  </tr>
</table>