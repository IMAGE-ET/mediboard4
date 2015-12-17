{{mb_script module=patients script=antecedent ajax=true}}
{{mb_default var=name_span value="atcd_allergies"}}
{{mb_default var=show_atcd value=1}}
{{mb_default var=sejour_id value=0}}
{{unique_id var=unique_atcd}}
<script>
  Main.add(function(){
    Antecedent.loadAntecedents('{{$patient->_guid}}', '{{$show_atcd}}', '{{$sejour_id}}', '{{$unique_atcd}}');
  });
</script>
<span id="{{$name_span}}">
  <span id="id_antecedents_allergies_{{$patient->_guid}}_{{$unique_atcd}}"></span>
</span>