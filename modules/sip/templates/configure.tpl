{{* $Id: configure.tpl 12588 2011-07-06 14:37:28Z lryo $ *}}

{{*
 * @package Mediboard
 * @subpackage sip
 * @version $Revision: 12588 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<script type="text/javascript">
  Main.add(Control.Tabs.create.curry('tabs-configure', true));
</script>

<ul id="tabs-configure" class="control_tabs">
  <li><a href="#SIP">{{tr}}SIP{{/tr}}</a></li>
  <li><a href="#actions">{{tr}}sip_config-actions{{/tr}}</a></li>
</ul>

<hr class="control_tabs" />

<div id="SIP" style="display: none;">
  {{mb_include template=inc_config_sip}}
</div>

<div id="actions" style="display: none;">
  {{mb_include template=inc_config_actions}}
</div>