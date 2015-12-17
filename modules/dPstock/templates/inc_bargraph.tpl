{{* $Id: inc_bargraph.tpl 19286 2013-05-26 16:59:04Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage Stock
 * @version $Revision: 19286 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{**
  * $stock ref|CProductStockGroup or ref|CProductStockService
  *}}
{{assign var=colors value=","|explode:"critical,min,optimum,max"}}
{{assign var=zone value=$stock->_zone}}

{{if $stock->order_threshold_critical || !$conf.dPstock.CProductStock.hide_bargraph}}
<div class="bargraph {{$conf.dPstock.CProductStock.advanced_bargraph|ternary:'advanced':''}}" 
     onmouseover="ObjectTooltip.createEx(this, '{{$stock->_guid}}')">
  <div class="value {{$colors.$zone}}">
    <div class="{{$colors.$zone}}" style="width: {{$stock->_quantity}}%;"></div>
  </div>
  
  {{if $conf.dPstock.CProductStock.advanced_bargraph}}
    <div class="threshold{{if $stock->_quantity < $stock->_max}} {{$colors.3}}{{/if}}">
      <div class="{{$colors.0}}" style="width: {{$stock->_critical}}%;"></div>
      <div class="{{$colors.1}}" style="width: {{$stock->_min}}%;"></div>
      <div class="{{$colors.2}}" style="width: {{$stock->_optimum}}%;"></div>
      {{if $stock->_quantity > $stock->_max}}<div class="{{$colors.3}}" style="width: {{$stock->_max}}%;"></div>{{/if}}
    </div>
  {{/if}}
</div>
{{/if}}