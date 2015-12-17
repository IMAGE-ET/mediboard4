{{* $Id: sejour_header.tpl 24225 2014-07-30 08:58:06Z asmiane $ *}}

{{*
 * @package Mediboard
 * @subpackage dPbloc
 * @version $Revision: 24225 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<!-- Sejour -->
<th>Hospi</th>
<th>Entrée</th>
{{if !$_compact}}
  <th>Chambre</th>
{{else}}
  <th>Lit</th>
{{/if}}
{{if $prestation->_id}}
  <th>{{$prestation}}</th>
{{/if}}
{{if !$_compact}}
  {{if $_show_comment_sejour}}
    <th>Rques</th>
  {{/if}}
  {{if $_convalescence}}
    <th>Conva.</th>
  {{/if}}
{{else}}
  {{if $_show_comment_sejour && $_convalescence}}
    <th>Rques / Conva.</th>
  {{elseif $_show_comment_sejour}}
    <th>Rques</th>
  {{elseif $_convalescence}}
    <th>Conva.</th>
  {{/if}}
{{/if}}
