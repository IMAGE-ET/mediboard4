{{* $Id: inc_product_selector_products_list.tpl 19286 2013-05-26 16:59:04Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage Stock
 * @version $Revision: 19286 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{$count}} 
{{if $count==0}}
  {{tr}}CProduct.one{{/tr}}
{{else}}
  {{tr}}CProduct.more{{/tr}}
{{/if}}
{{if $total}}(sur {{$total}}) {{/if}} trouvé{{if $count>1}}s{{/if}}<br />
<select name="product" id="product" size="20" style="width: 250px;" onchange="refreshProductInfo(this.value);">
  {{foreach from=$list_products item=curr_product}}
  <option value="{{$curr_product->_id}}" {{if $curr_product->_id==$selected_product}}selected="selected"{{/if}}>{{$curr_product->_view}}</option>
  {{/foreach}}
</select>
