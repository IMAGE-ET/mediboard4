{{* $Id: idx_messages.tpl 13345 2011-10-01 12:32:00Z mytto $ *}}

{{*
 * @package Mediboard
 * @subpackage system
 * @version $Revision: 13345 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{mb_script module=system script=message}}

<script type="text/javascript">
Main.add(Message.refreshList);
</script>

<button class="new singleclick" onclick="Message.edit(0);">
  {{tr}}CMessage-title-create{{/tr}}
</button>

<button class="new singleclick" onclick="Message.createUpdate();" style="float:right;">
  {{tr}}CMessage-title-create_update{{/tr}}
</button>

<div id="list-messages"></div>
