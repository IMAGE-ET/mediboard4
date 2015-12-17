<!-- $Id: print_pack.tpl 332 2006-07-13 14:32:40Z mytto $ -->

{{foreach from=$listCr item=curr_cr}}
  <h1 class="newpage">Nouveau document</h1>
  <p>{{$curr_cr->document}}</p>
{{/foreach}}