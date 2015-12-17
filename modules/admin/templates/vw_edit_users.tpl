{{* $Id: vw_edit_users.tpl 14912 2012-03-15 17:52:57Z rhum1 $ *}}

{{*
 * @package Mediboard
 * @subpackage admin
 * @version $Revision: 14912 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<table class="main">
  <tr>
    <td class="halfPane">
      <a class="button new" href="?m={{$m}}&amp;user_id=0">
        {{tr}}CUser-title-create{{/tr}}
      </a>
      {{mb_include template=inc_list_users}}
    </td>
    <td class="halfPane">
      {{if $can->edit}}
        {{mb_include template=inc_edit_user}}
      {{else}}
        {{mb_include template=inc_vw_user}}
      {{/if}}
    </td>
  </tr>
</table>