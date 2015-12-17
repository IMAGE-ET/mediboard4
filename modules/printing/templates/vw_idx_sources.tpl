{{*
 * View Printing Sources
 *  
 * @category PRINTING
 * @package  Mediboard
 * @author   SARL OpenXtrem <dev@openxtrem.com>
 * @license  GNU General Public License, see http://www.gnu.org/licenses/gpl.html 
 * @version  SVN: $Id:$ 
 * @link     http://www.mediboard.org
*}}

<script>
  function editSource(id, klass) {
    var action = "ajax_edit_source_";
    if (!klass) {
      return;
    }
    switch (klass) {
      case "CSourceLPR":
        action += "lpr";
        break;
      case "CSourceSMB":
        action += "smb";
    }
    var url = new Url("printing", action);
    url.addParam("source_id", id);
    url.addParam("class", klass);
    url.requestUpdate("edit_source");
  }

  function refreshList() {
    var url = new Url("printing", "ajax_list_sources");
    url.requestUpdate("list_sources");
  }

  function testPrint(klass, id) {
    var url = new Url("printing", "ajax_test_print");
    url.addParam("id", id);
    url.addParam("class", klass);
    url.requestUpdate("result_print");
  }

  Main.add(function() {
    refreshList();
    editSource('{{$source_id}}', '{{$class}}');
  });
</script>

<table class="main">
  <tr>
    <td id="list_sources" style="width: 45%;"></td>
    <!-- Création / Modification de la source -->
    <td id="edit_source"></td>
  </tr>
</table>