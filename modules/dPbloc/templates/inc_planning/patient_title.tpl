{{* $Id: patient_title.tpl 24558 2014-08-26 09:52:47Z flaviencrochard $ *}}

{{*
 * @package Mediboard
 * @subpackage dPbloc
 * @version $Revision: 24558 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{if $_coordonnees}}
<th class="title" colspan="4">
{{elseif $_show_identity}}
<th class="title" colspan="3">
{{else}}
<th class="title" colspan="2">
{{/if}}
  Patient
</th>