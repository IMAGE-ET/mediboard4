{{* $Id: interv_title.tpl 28047 2015-04-22 06:47:03Z flaviencrochard $ *}}

{{*
 * @package Mediboard
 * @subpackage dPbloc
 * @version $Revision: 28047 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{assign var=colspan value=$_extra+$_duree+$_by_prat+4}}
{{if !$_compact}}
  {{assign var=colspan value=$colspan+$_materiel}}
{{/if}}
<th class="title" colspan="{{$colspan}}">{{tr}}COperation{{/tr}}</th>