{{* $Id: interv_header.tpl 28047 2015-04-22 06:47:03Z flaviencrochard $ *}}

{{*
 * @package Mediboard
 * @subpackage dPbloc
 * @version $Revision: 28047 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<!-- Intervention -->
<th>Intervention</th>
<th>Cot�</th>
<th>Anesth�sie</th>
{{if !$_compact}}
  <th>Remarques</th>
  {{if $_materiel}}
    <th>Mat�riel</th>
  {{/if}}
{{else}}
  <th>Rques{{if $_materiel}} / Mat.{{/if}}</th>
{{/if}}
{{if $_extra}}
  <th>Extra</th>
{{/if}}
{{if $_duree}}
  <th>Dur�e</th>
{{/if}}
{{if $_by_prat}}
  <th>Salle</th>
{{/if}}