<script type="text/javascript">
  function changePage(page) {
    $V(getForm('filterEchange').page, page);
  }

  Main.add(function() {
    getForm('filterEchange').onsubmit();
  });
</script>

<table class="main layout">
  <!-- Filtres -->
  <tr>
    <td class="separator expand" onclick="MbObject.toggleColumn(this, $(this).next())"></td>
    <td>
      <form action="?" name="filterEchange" method="get"onsubmit="return onSubmitFormAjax(this, null, 'resultExchangeFTP_table')">
        <input type="hidden" name="m" value="{{$m}}" />
        <input type="hidden" name="a" value="ajax_search_exchange_ftp"/>
        <input type="hidden" name="page" value="{{$page}}" onchange="this.form.onSubmit()" />

        <table class="main form">
          <tr>
            <th>Date d'échange</th>
            <td class="narrow">
              {{mb_field object=$exchange_ftp field="_date_min" form="filterEchange" register=true}}
              <b>&raquo;</b>
              {{mb_field object=$exchange_ftp field="_date_max" form="filterEchange" register=true}}</td>
            <th>{{mb_label object=$exchange_ftp field="echange_ftp_id"}}</th>
            <td>{{mb_field object=$exchange_ftp field="echange_ftp_id"}}</td>
            <th>Fonctions</th>
            <td>
              <select class="str" name="function">
                <option value="">&mdash; Liste des fonctions</option>
                {{foreach from=$functions item=_function}}
                  <option value="{{$_function}}" {{if $function == $_function}} selected="selected"{{/if}}>
                    {{$_function}}
                  </option>
                {{/foreach}}
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <button type="submit" class="search" onclick="$V(getForm('filterEchange').page, 0);">{{tr}}Filter{{/tr}}</button>
            </td>
          </tr>
        </table>
        {{if $total_exchange_ftp != 0}}
          {{mb_include module=system template=inc_pagination total=$total_exchange_ftp current=$page change_page='changePage' jumper='10'}}
        {{/if}}
      </form>
    </td>
  </tr>
</table>

<div id="resultExchangeFTP_table" style="overflow: hidden"></div>
