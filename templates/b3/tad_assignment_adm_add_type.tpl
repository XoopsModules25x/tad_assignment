<link href="<{$xoops_url}>/modules/tadtools/css/font-awesome/css/font-awesome.css" rel="stylesheet">
  <div class="container-fluid">


    <h2><{$smarty.const._MA_TADASSIGN_ADD_TYPE_TITLE}></h2>

  <form action="add_type.php" method="post" id="myForm" name="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
    <input type="file" name="file" size="30">
    <input type="hidden" name="op" value="add_type">
    <button type="submit"  class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
  </form>

  <script>
  function delete_func(ftype){
    var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
    if (!sure)  return;
    location.href="add_type.php?op=del_type&type=" + ftype;
  }
  </script>

  <table class="table table-striped table-bordered table-hover">
    <tr><th><{$smarty.const._MA_TADASSIGN_TYPE_LIST}></th></tr>
  <{foreach from=$all item=data}>
    <tr>
        <td>
          <a href="javascript:delete_func('<{$data.$type}>');" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
          <{$data.type}>
        </td>
    </tr>
  <{/foreach}>
  </table>
</div>