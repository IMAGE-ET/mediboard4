{{* $Id: vw_bloodSalvage_sspi.tpl 11570 2011-03-13 14:05:30Z MyttO $ *}}

{{*
 * @package Mediboard
 * @subpackage bloodSalvage
 * @version $Revision: 11570 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{assign var="module" value="bloodSalvage"}}
{{assign var="object" value=$blood_salvage}}
{{mb_script module="bloodSalvage" script="bloodSalvage"}}

<script type="text/javascript">
Main.add(function () {
  var url = new Url("bloodSalvage", "httpreq_liste_patients_bs");
  url.addParam("date","{{$date}}");
  url.periodicalUpdate('listRSPO', { frequency: 90 });
  {{if $selOp->_id}}
    url.setModuleAction("bloodSalvage","httpreq_vw_sspi_bs");
    url.addParam("date","{{$date}}");
    url.requestUpdate("bloodSalvageSSPI");
  {{/if}}  
});
</script>

<table class="main">
<tr>
	<td class="halfPane" id="listRSPO"></td>
  <td class="halfPane">
 	{{if $selOp->_id}}
    <div id="bloodSalvageSSPI"></div>
	{{else}}
	  <div class="small-info">Veuillez sélectionner un patient.</div>
	{{/if}}
	</td>
</tr>
</table>