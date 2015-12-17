<script>
  Printer = {
    editPrinter: function(id) {
      new Url("hospi", "ajax_edit_printer")
      .addParam("printer_id", id)
      .requestUpdate("edit_printer");
    },
    refreshList: function(id) {
      new Url("hospi", "ajax_list_printers")
      .addNotNullParam("printer_id", id)
      .requestUpdate("list_printers");
    },
    after_edit_printer: function(id) {
      Printer.refreshList(id);
      Printer.editPrinter(id);
    }
  };

  Main.add(function() {
    Printer.refreshList();
    Printer.editPrinter('{{$printer_id}}');
  });
</script>

<table class="main">
  <tr>
    <td id="list_printers" style="width: 45%;"></td>
    <!-- Création / Modification de l'imprimante -->
    <td id="edit_printer"></td>
  </tr>
</table>