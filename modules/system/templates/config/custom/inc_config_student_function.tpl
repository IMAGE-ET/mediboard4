{{if $is_last}}
  <select name="c[{{$_feature}}]" onchange="" {{if $is_inherited}} disabled="disabled" {{/if}}>
    {{foreach from="CMediusers::loadFonctions"|static_call:null key=function_id item=_function}}
      <option value="{{$function_id}}" {{if $function_id == $value}}selected="selected"{{/if}}>
        {{$_function->text}}
      </option>
    {{/foreach}}
  </select>
{{else}}
  {{if $value}}
    {{$value}}
  {{/if}}
{{/if}}