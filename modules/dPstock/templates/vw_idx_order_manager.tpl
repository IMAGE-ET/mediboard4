{{* $Id: vw_idx_order_manager.tpl 19286 2013-05-26 16:59:04Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage Stock
 * @version $Revision: 19286 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html
*}}

{{mb_script module=stock script=order_manager}}

<script type="text/javascript">
Main.add(function () {
  // Menu tabs initialization
  var tabs = Control.Tabs.create('tab_orders', true);
  
  // Orders lists have to be shown
  refreshAll();
});

refreshAll = function(form) {
  refreshLists(form);
  refreshReceptionsList(0);
  return false;
}

refreshReceptionsList = function(page){
  var url = new Url("dPstock", "httpreq_vw_receptions_list");
  url.addParam("start", page);
  url.addParam("keywords", $V(getForm("orders-list-filter").keywords));
  url.requestUpdate("list-receptions");
}

confirmPurge = function(element, view, type) {
  var form = element.form;
  if (confirm("ATTENTION : Vous �tes sur le point de supprimer une commande, ainsi que tous les objets qui s'y rattachent")) {
    form._purge.value = 1;
    confirmDeletion(form,  {
      typeName:'la commande',
      objName:view,
      ajax: true
    }, {
      onComplete: refreshListOrders.curry(type, form)
    });
  }
}

resetPages = function(form) {
  orderTypes.each(function(t){
    $V(form["start["+t+"]"], 0, false);
  });
}
</script>

<div class="main">
  <!-- Action buttons -->
  <div style="float: right;">
    <button type="button" class="change" onclick="popupOrder(null, null, null, true);">{{tr}}CProductOrder-_autofill{{/tr}}</button>
    <button type="button" class="new"    onclick="popupOrder(null, null, null);">{{tr}}CProductOrder-title-create{{/tr}}</button>
  </div>

  <!-- Filter -->
  <form name="orders-list-filter" action="?" method="get" onsubmit="return refreshAll(this)">
    <input type="hidden" name="start[waiting]"   value="0" onchange="refreshListOrders('waiting', this.form)" />
    <input type="hidden" name="start[locked]"    value="0" onchange="refreshListOrders('locked', this.form)" />
    <input type="hidden" name="start[pending]"   value="0" onchange="refreshListOrders('pending', this.form)" />
    <input type="hidden" name="start[received]"  value="0" onchange="refreshListOrders('received', this.form, $('received-invoiced').checked)" />
    <input type="hidden" name="start[cancelled]" value="0" onchange="refreshListOrders('cancelled', this.form)" />
    
    <select name="category_id" onchange="resetPages(this.form); this.form.onsubmit()">
      <option value="" >&ndash; {{tr}}CProductCategory.all{{/tr}}</option>
    {{foreach from=$list_categories item=_category}}
      <option value="{{$_category->category_id}}" {{if $category_id==$_category->_id}}selected="selected"{{/if}}>{{$_category->name}}</option>
    {{/foreach}}
    </select>
    <input type="text" name="keywords" onchange="resetPages(this.form)" />
    
    <button type="submit" class="search">{{tr}}Filter{{/tr}}</button>
    <button type="button" class="cancel notext" onclick="resetPages(this.form); $(this.form).clear(false); this.form.onsubmit();">{{tr}}Empty{{/tr}}</button>
  </form>

  <!-- Tabs titles -->
  <ul id="tab_orders" class="control_tabs">
    <li><a href="#list-orders-waiting" class="empty">A valider <small>(0)</small></a></li>
    <li><a href="#list-orders-locked" class="empty">A passer <small>(0)</small></a></li>
    <li><a href="#list-orders-pending" class="empty">A recevoir <small>(0)</small></a></li>
    <li><a href="#list-orders-received" class="empty">Re�ues <small>(0)</small></a></li>
    <li><a href="#list-orders-cancelled" class="empty">Annul�es <small>(0)</small></a></li>
    <li style="margin-left: 4em;"><a href="#list-receptions" class="empty">R�ceptions <small>(0)</small></a></li>
  </ul>
  <hr class="control_tabs" />
  
  <!-- Tabs containers -->
  <div id="list-orders-waiting" style="display: none;"></div>
  <div id="list-orders-locked" style="display: none;"></div>
  <div id="list-orders-pending" style="display: none;"></div>
  <div id="list-orders-received" style="display: none;"></div>
  <div id="list-orders-cancelled" style="display: none;"></div>
  <div id="list-receptions" style="display: none;"></div>
</div>