<?php
//�ޤJTadTools���禡�w
if (!file_exists(XOOPS_ROOT_PATH."/modules/tadtools/tad_function.php")) {
    redirect_header("http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50", 3, _TAD_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH."/modules/tadtools/tad_function.php";

define("_TAD_ASSIGNMENT_UPLOAD_DIR", XOOPS_ROOT_PATH."/uploads/tad_assignment/");
define("_TAD_ASSIGNMENT_UPLOAD_URL", XOOPS_URL."/uploads/tad_assignment/");


//�H�y�������o�Y��tad_assignment���
function get_tad_assignment($assn="")
{
    global $xoopsDB;
    if (empty($assn)) {
        return;
    }
    $sql = "select * from ".$xoopsDB->prefix("tad_assignment")." where assn='$assn'";
    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    $data=$xoopsDB->fetchArray($result);
    return $data;
}


//�ഫ���ɶ��W�O
function day2ts($day="", $sy="-")
{
    if (empty($day)) {
        $day=date("Y-m-d H:i:s");
    }
    $dt=explode(" ", $day);

    $d=explode($sy, $dt[0]);
    $t=explode(":", $dt[1]);

    $ts=mktime($t['0'], $t['1'], $t['2'], $d['1'], $d['2'], $d['0']);
    return $ts;
}
/********************* �w�]��� *********************/
