{{* $Id: vw_patients.tpl 10085 2010-09-16 09:20:46Z lryo $ *}}

{{*
 * @package Mediboard
 * @subpackage hprim21
 * @version $Revision: 10085 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<table class="main">
  <tr>
    <td class="halfPane">
      {{include file="inc_list_patient.tpl"}}
    </td>

    {{if $patient->_id}}
    <td class="halfPane" id="vwPatient">
      {{include file="inc_vw_patient.tpl"}}
    </td>
    {{/if}}
  </tr>
</table>