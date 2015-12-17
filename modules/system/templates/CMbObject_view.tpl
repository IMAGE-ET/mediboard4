{{* $Id: CMbObject_view.tpl 18590 2013-03-28 14:24:01Z lryo $ *}}

{{*
 * @package Mediboard
 * @subpackage system
 * @version $Revision: 18590 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{if $object->_id && !$object->_can->read}}
  <div class="small-info">
    {{tr}}{{$object->_class}}{{/tr}} : {{tr}}access-forbidden{{/tr}}
  </div>
  {{mb_return}}
{{/if}}

<table class="tbl">
  <tr>
    <th class="title text">
      {{mb_include module=system template=inc_object_idsante400}}
      {{mb_include module=system template=inc_object_history}}
      {{mb_include module=system template=inc_object_notes}}
      
      {{$object}}
    </th>
  </tr>
  <tr>
    <td>
      {{foreach from=$object->_specs key=prop item=spec}}
			{{mb_include module=system template=inc_field_view}}
      {{/foreach}}
    </td>
  </tr>
</table>