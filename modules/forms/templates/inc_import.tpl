{{* $Id: inc_import.tpl 14702 2012-02-21 09:34:10Z phenxdesign $ *}}

{{*
 * @package Mediboard
 * @subpackage cahpp
 * @version $Revision: 14702 $
 * @author SARL OpenXtrem
*}}

<script type="text/javascript">
  window.parent.onUploadComplete({{$message|smarty:nodefaults|utf8_encode|@json}});
</script>
