{{* $Id: inc_object_value.tpl 19286 2013-05-26 16:59:04Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage Stock
 * @version $Revision: 19286 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{if $object->_class=="CProductStockGroup" && $field=="bargraph"}}
  {{include file="inc_bargraph.tpl" stock=$object}}
{{else}}
  {{mb_value object=$object field=$field}}
{{/if}}