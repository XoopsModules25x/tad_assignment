<?php
/*-----------�ޤJ�ɮװ�--------------*/
$xoopsOption['template_main'] = "tad_assignment_adm_main.tpl";
include_once "header.php";
include_once "../function.php";
/*-----------function��--------------*/

//�C�X�Ҧ�tad_assignment���
function list_tad_assignment($show_function = 1)
{
    global $xoopsDB, $xoopsModule, $xoopsTpl;
    $sql = "select * from " . $xoopsDB->prefix("tad_assignment") . " order by start_date desc";

    //PageBar(��Ƽ�, �C����ܴX�����, �̦h��ܴX�ӭ��ƿﶵ);
    $result = $xoopsDB->query($sql) or web_error($sql);
    $total  = $xoopsDB->getRowsNum($result);

    //getPageBar($��sql�y�k, �C����ܴX�����, �̦h��ܴX�ӭ��ƿﶵ);
    $PageBar = getPageBar($sql, 10, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql);

    $data = "";
    $i    = 0;
    while ($all = $xoopsDB->fetchArray($result)) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $uid_name = XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = XoopsUser::getUnameFromId($uid, 0);
        }

        $start_date = date("Y-m-d H:i", xoops_getUserTimestamp($start_date));
        $end_date   = date("Y-m-d H:i", xoops_getUserTimestamp($end_date));

        $all_data[$i]['assn']       = $assn;
        $all_data[$i]['title']      = $title;
        $all_data[$i]['passwd']     = $passwd;
        $all_data[$i]['start_date'] = $start_date;
        $all_data[$i]['end_date']   = $end_date;
        $all_data[$i]['uid_name']   = $uid_name;
        $all_data[$i]['show']       = $show;
        $i++;

    }

    $xoopsTpl->assign('all_data', $all_data);
    $xoopsTpl->assign('bar', $bar);

}

//�R��tad_assignment�Y����Ƹ��
function delete_tad_assignment($assn = "")
{
    global $xoopsDB;
    $sql = "delete from " . $xoopsDB->prefix("tad_assignment") . " where assn='$assn'";
    $xoopsDB->queryF($sql) or web_error($sql);
}

/*-----------����ʧ@�P�_��----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op   = system_CleanVars($_REQUEST, 'op', '', 'string');
$assn = system_CleanVars($_REQUEST, 'assn', 0, 'int');

switch ($op) {

    //�R�����
    case "delete_tad_assignment";
        delete_tad_assignment($assn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
        break;

    //�w�]�ʧ@
    default:
        list_tad_assignment();
        break;

}

/*-----------�q�X���G��--------------*/
include_once 'footer.php';
