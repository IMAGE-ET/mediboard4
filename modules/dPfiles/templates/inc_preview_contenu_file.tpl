<!-- $Id: inc_preview_contenu_file.tpl 17668 2013-01-04 15:46:01Z phenxdesign $ -->

{{mb_default var=display_as_is value=false}}

<!-- Dialog -->
{{if $dialog && $show_editor}}
  <div class="greedyPane" style="height: 500px">
    <textarea id="htmlarea">
      {{$includeInfosFile}}
    </textarea>
  </div>

<!-- Display as is -->
{{elseif $display_as_is}}
  {{$includeInfosFile|smarty:nodefaults}}

<!-- Ajax -->
{{else}}
  <div class="preview greedyPane" style="white-space: normal; margin: 0 auto; font-size: 60%;  padding: 5px; width: 95%; max-width: 21cm;">
    {{$includeInfosFile|smarty:nodefaults}}
  </div>
{{/if}}
