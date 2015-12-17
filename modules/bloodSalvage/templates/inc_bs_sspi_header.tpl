{{* $Id: inc_bs_sspi_header.tpl 15772 2012-06-05 06:47:54Z flaviencrochard $ *}}

{{*
 * @package Mediboard
 * @subpackage bloodSalvage
 * @version $Revision: 15772 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{assign var=patient value=$blood_salvage->_ref_patient}}
<table class="tbl">
  <tr>
    <th class="title text" colspan="2">
      <a class="action" style="float: right;" title="Modifier le dossier administratif" href="?m=dPpatients&amp;tab=vw_edit_patients&amp;patient_id={{$patient->_id}}">
        <img src="images/icons/edit.png" title="{{tr}}Edit{{/tr}}" />
      </a>
      {{$patient->_view}}
      ({{$patient->_age}}
      {{if $patient->_annees != "??"}}- {{mb_value object=$patient field="naissance"}}{{/if}})
    </th>
  </tr>
</table>