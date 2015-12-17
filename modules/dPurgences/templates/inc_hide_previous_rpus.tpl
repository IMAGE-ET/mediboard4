{{* $Id: inc_attente.tpl 8487 2010-04-07 10:02:06Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage dPurgences
 * @version $Revision: 8487 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}


<div>
	<label style="visibility: hidden;" class="missing" title="Cacher les admissions">
	  <input type="checkbox" onchange="Missing.toggle(this);" />
	  {{tr}}Hide{{/tr}}
	  <span>0</span> admission(s) sans RPU
	</label>
</div>

<script type="text/javascript">
Missing = {
  refresh: function() {
    var label = $$("label.missing")[0];
    var count = $$('tr.missing').length;
    label.setVisibility(count != 0);
    label.down("span").update(count);
	},
	
	toggle: function(checkbox) {
  	$$('tr.missing').invoke('setVisible', !checkbox.checked);
	}
}
</script>
