<?php
/*-----------�ޤJ�ɮװ�--------------*/
$xoopsOption['template_main'] = "tad_assignment_adm_add_type.tpl";
include_once "header.php";
include_once "../function.php";

/*-----------function��--------------*/

//
function add_type_form()
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;

    $all    = "";
    $sql    = "select * from " . $xoopsDB->prefix("tad_assignment_types") . " order by `type`";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $i      = 0;
    while (list($type) = $xoopsDB->fetchRow($result)) {
        $all[$i]['type'] = ($_GET['t'] == $type) ? "<b style='color:red;'>$type</b>" : $type;
        $i++;
    }
    $xoopsTpl->assign('all', $all);
}

//
function add_type()
{
    global $xoopsDB;
    $sql = "replace into " . $xoopsDB->prefix("tad_assignment_types") . " (`type`) values('{$_FILES['file']['type']}')";
    $xoopsDB->queryF($sql) or web_error($sql);

    mk_type();
}

//
function del_type($type = "")
{
    global $xoopsDB;
    $sql = "delete from " . $xoopsDB->prefix("tad_assignment_types") . " where type='{$type}'";
    $xoopsDB->queryF($sql) or web_error($sql);

    mk_type();
}

function mk_type()
{
    global $xoopsDB;
    $sql    = "select * from " . $xoopsDB->prefix("tad_assignment_types") . " order by `type`";
    $result = $xoopsDB->query($sql) or web_error($sql);
    while (list($type) = $xoopsDB->fetchRow($result)) {
        $all[] = "\"$type\"";
    }

    $txt = "<?php\n\$all_types=array(" . implode(",\n", $all) . ");\n?>";

    $fp = fopen(XOOPS_ROOT_PATH . "/uploads/tad_assignment/allow_types.php", 'w');
    fwrite($fp, $txt);
    fclose($fp);
}
/*-----------����ʧ@�P�_��----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op   = system_CleanVars($_REQUEST, 'op', '', 'string');
$assn = system_CleanVars($_REQUEST, 'assn', 0, 'int');
$type = system_CleanVars($_REQUEST, 'type', '', 'string');

switch ($op) {

    //
    case "add_type";
        add_type();
        header("location: {$_SERVER['PHP_SELF']}?t={$_FILES['file']['type']}");
        exit;
        break;

    case "del_type";
        del_type($type);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
        break;

    //�w�]�ʧ@
    default:
        add_type_form();
        break;

}

/*-----------�q�X���G��--------------*/
include_once 'footer.php';
