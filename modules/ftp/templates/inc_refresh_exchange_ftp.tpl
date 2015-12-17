<table class="main">
  <tr>
    <td class="halfPane" rowspan="3" colspan="2">
      <table class="tbl">
        <tr>
          <th class="title" colspan="16">{{tr}}CExchangeFTP{{/tr}}</th>
        </tr>
        <tr>
          <th class="narrow"></th>
          <th class="narrow"></th>
          <th>{{mb_title object=$exchange_ftp field="echange_ftp_id"}}</th>
          <th>{{mb_title object=$exchange_ftp field="date_echange"}}</th>
          <th>{{mb_title object=$exchange_ftp field="emetteur"}}</th>
          <th>{{mb_title object=$exchange_ftp field="destinataire"}}</th>
          <th>{{mb_title object=$exchange_ftp field="function_name"}}</th>
          <th>{{mb_title object=$exchange_ftp field="input"}}</th>
          <th>{{mb_title object=$exchange_ftp field="output"}}</th>
          <th>{{mb_title object=$exchange_ftp field="response_time"}}</th>
        </tr>
        {{foreach from=$echangesFTP item=_exchange_ftp}}
          <tbody id="echange_{{$_exchange_ftp->_id}}">
          {{mb_include template="inc_exchange_ftp" object=$_exchange_ftp}}
          </tbody>
          {{foreachelse}}
          <tr>
            <td colspan="16" class="empty">
              {{tr}}CExchangeFTP.none{{/tr}}
            </td>
          </tr>
        {{/foreach}}
      </table>
    </td>
  </tr>
</table>