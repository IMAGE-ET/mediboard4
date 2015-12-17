{{* $Id: inc_field_autocomplete.tpl 26111 2014-11-28 14:28:09Z armengaudmc $ *}}

{{*
 * @package Mediboard
 * @subpackage system
 * @version $Revision: 26111 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{if $view_field == 1}}
  {{assign var=f value=$field}}
{{else}}
  {{assign var=f value=$view_field}}
{{/if}}

<ul>
{{foreach from=$matches item=match}}
  <li id="autocomplete-{{$match->_guid}}" data-id="{{$match->_id}}" data-guid="{{$match->_guid}}">
  {{if $template}}
    {{include file=$template nodebug=true}}
  {{else}}
    {{mb_include module=system template=CMbObject_autocomplete nodebug=true}}
  {{/if}}
  </li>
{{foreachelse}}
    <li>
      <span class="informal">
        {{if isset($ref_spec|smarty:nodefaults)}}
          <span class="view"></span>
        {{else}}
          <span class="view" style="display: none;">{{$input}}</span>
        {{/if}}
        <span style="font-style: italic;">{{tr}}No result{{/tr}}</span>
      </span>
    </li>
{{/foreach}}
</ul>