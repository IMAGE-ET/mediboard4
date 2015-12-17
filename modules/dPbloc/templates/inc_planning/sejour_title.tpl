{{* $Id: sejour_title.tpl 24225 2014-07-30 08:58:06Z asmiane $ *}}

{{*
 * @package Mediboard
 * @subpackage dPbloc
 * @version $Revision: 24225 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{assign var=colspan value=3}}
{{if $prestation->_id}}
  {{assign var=colspan value=$colspan+1}}
{{/if}}
{{if !$_compact}}
  {{if $_show_comment_sejour}}
    {{assign var=colspan value=$colspan+1}}
  {{/if}}
  {{if $_convalescence}}
    {{assign var=colspan value=$colspan+1}}
  {{/if}}
{{else}}
  {{if $_show_comment_sejour || $_convalescence}}
    {{assign var=colspan value=$colspan+1}}
  {{/if}}
{{/if}}

<th class="title" colspan="{{$colspan}}">Sejour</th>