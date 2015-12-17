{{* $Id: configure_handler.tpl 15621 2012-05-22 13:29:29Z mytto $ *}}

{{*
 * @package Mediboard
 * @subpackage system
 * @version $Revision: 15621 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{mb_default var=type value=object}}
{{assign var=col value="`$type`_handlers"}}
{{assign var=class value=$class_handler}}


<tr>
  <th class="category" colspan="10">{{tr}}{{$class}}{{/tr}}</th>
</tr>

<tr>
  <th style="width: 50%">
    <label for="{{$col}}[{{$class}}]" title="{{tr}}config-{{$col}}-{{$class}}-desc{{/tr}}">
      {{tr}}config-{{$col}}-{{$class}}{{/tr}}
    </label>  
  </th>
  <td>
    <select class="bool" name="{{$col}}[{{$class}}]">
      <option value="0" {{if 0 == @$conf.$col.$class}} selected="selected" {{/if}}>{{tr}}bool.0{{/tr}}</option>
      <option value="1" {{if 1 == @$conf.$col.$class}} selected="selected" {{/if}}>{{tr}}bool.1{{/tr}}</option>
    </select>
  </td>
</tr>