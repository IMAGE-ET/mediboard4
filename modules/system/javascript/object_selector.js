/* $Id: object_selector.js 8209 2010-03-04 20:01:54Z phenxdesign $ */

/**
 * @package Mediboard
 * @subpackage system
 * @version $Revision: 8209 $
 * @author SARL OpenXtrem
 * @license GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 */

ObjectSelector = {
  sForm    : null,
  sId      : null,
  sView    : null,
  sClass   : null,
  onlyclass: null,

  options : {
    width : 600,
    height: 500
  },
   
  pop: function() {
    var oForm = getForm(this.sForm);
    var url = new Url("system", "object_selector");
    url.addParam("onlyclass", this.onlyclass);
    url.addParam("selClass", oForm[this.sClass].value);
    url.popup(this.options.width, this.options.height, "Object Selector");
  },
  
  set: function(oObject) {
    var oForm = getForm(this.sForm);
    
    if (oForm[this.sView]) {
      $V(oForm[this.sView], oObject.view);
    }
    
    $V(oForm[this.sClass], oObject.objClass);
    $V(oForm[this.sId], oObject.id);
  }
};