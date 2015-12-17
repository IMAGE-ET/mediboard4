{{* $Id: httpreq_do_ccam_autocomplete.tpl 26632 2014-12-31 09:03:17Z rhum1 $ *}}

{{*
 * @package Mediboard
 * @subpackage dPccam
 * @version $Revision: 26632 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

<ul>
  {{foreach from=$codes item=_code}}
    <li>
      <div class="compact" style="float: right;">
        {{foreach from=$_code->activites item=_activite}}
          {{foreach from=$_activite->phases item=_phase}}
             {{if $_phase->tarif}}
             <span title="activité {{$_activite->numero}}, phase {{$_phase->phase}}">
               &bullet;
               {{$_phase->tarif|currency}}
               {{if $_phase->tarif != $_phase->tarif2}}
                 ({{$_phase->tarif2|currency}})
               {{/if}}
             </span>
             {{/if}}
          {{/foreach}}
        {{/foreach}}
      </div>
      <strong class="code">{{$_code->code}}</strong>
      <br />
      <small>{{$_code->libelleLong|smarty:nodefaults|emphasize:$keywords}}</small>
    </li>
  {{foreachelse}}
    <li>
      <span style="font-style: italic;">{{tr}}No result{{/tr}}</span>
    </li>
  {{/foreach}}
</ul>