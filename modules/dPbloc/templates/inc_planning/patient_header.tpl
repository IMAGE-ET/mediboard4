{{* $Id: patient_header.tpl 24558 2014-08-26 09:52:47Z flaviencrochard $ *}}

{{*
 * @package Mediboard
 * @subpackage dPbloc
 * @version $Revision: 24558 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<!-- Patient -->
{{if $_show_identity}}
  <th>Nom - Prénom</th>
{{/if}}
<th>Age</th>
<th>Sexe</th>
{{if $_coordonnees}}
<th>Telephone</th>
{{/if}}