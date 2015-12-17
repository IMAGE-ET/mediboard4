{{* $Id: vw_bloodSalvage.tpl 19658 2013-06-25 08:02:51Z rhum1 $ *}}

{{*
 * @package Mediboard
 * @subpackage bloodSalvage
 * @version $Revision: 19658 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{assign var="module" value="bloodSalvage"}}
{{assign var="object" value=$blood_salvage}}

{{mb_script module=bloodSalvage script=bloodSalvage}}
{{mb_script module=bloc         script=edit_planning}}

<script type="text/javascript">

Main.add(function () {
  var url = new Url("bloodSalvage", "httpreq_liste_plages");
  url.addParam("date", "{{$date}}");
  url.addParam("operation_id", "{{$selOp->_id}}");
  url.periodicalUpdate('listplages', { frequency: 90 });
  {{if $selOp->_id}}
    // Effet sur le programme
    new PairEffect("listplages", { sEffect : "appear", bStartVisible : true });
    url.setModuleAction("bloodSalvage","httpreq_vw_bloodSalvage");
    url.requestUpdate('bloodSalvage');
  {{/if}}  
});
</script>

<table class="main">
  <tr>
    <td class="halfPane" id="listplages"></td>
    <td class="halfPane">
      {{if $selOp->_id}}
        {{mb_include template=inc_bloodSalvage_header}}
        <div id="bloodSalvage"></div>
      {{else}}
        <div class="small-info">
          Veuillez s�lectionner une intervention dans la liste.
        </div>
      {{/if}}
    </td>
  </tr>
</table>
