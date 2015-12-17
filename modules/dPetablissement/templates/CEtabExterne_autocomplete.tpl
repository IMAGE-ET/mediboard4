{{* $Id: CEtabExterne_autocomplete.tpl 15006 2012-03-23 15:39:42Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage dPetablissement
 * @version $Revision: 15006 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<span class="view" style="float: left;">{{if $show_view}}{{$match->_view}}{{else}}{{$match->$f|emphasize:$input}}{{/if}}</span>

<div style="color: #666; font-size: 0.7em; padding-left: 0.5em; clear: both;">
  {{if $match->cp && $match->ville}}{{$match->cp}} {{$match->ville}}{{/if}}&nbsp;
</div>