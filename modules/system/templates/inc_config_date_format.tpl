{{* $Id: inc_config_date_format.tpl 10842 2010-12-08 21:57:35Z MyttO $ *}}

{{*
 * @package Mediboard
 * @subpackage system
 * @version $Revision: 10842 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<tr>
  <th style="width: 50%">
    <label for="{{$var}}" title="{{tr}}config-{{$var}}-desc{{/tr}}">
      {{tr}}config-{{$var}}{{/tr}}
    </label>  
  </th>
  <td>
    <input type="text" name="{{$var}}" value="{{$conf.$var}}" />
    {{$smarty.now|date_format:$conf.$var}}
  </td>
</tr>
