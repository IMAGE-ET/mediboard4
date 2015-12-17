{{* $Id: view_ex_object.tpl 26326 2014-12-10 14:52:16Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage forms
 * @version $Revision: 26326 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}


<p style="font-weight: bold; font-size: 1.1em;">
  {{$ex_object->_ref_ex_class->name}}
</p>
<hr style="border-color: #333; margin: 4px 0;" />
{{mb_include module=forms template=inc_vw_ex_object ex_object=$ex_object}}
