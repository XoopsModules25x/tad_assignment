<?php
//�϶��D�禡 (�C�X�ثe�}��W�Ǫ��@�~����)
function tad_new_assignment($options)
{
    global $xoopsDB, $xoopsModule;
    $now    = xoops_getUserTimestamp(time());
    $sql    = "select assn,title,uid,start_date from " . $xoopsDB->prefix("tad_assignment") . " where start_date < '$now' and end_date > '$now'";
    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());

    $i     = 0;
    $block = "";
    while (list($assn, $title, $uid, $start_date) = $xoopsDB->fetchRow($result)) {
        $uid_name = XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = XoopsUser::getUnameFromId($uid, 0);
        }

        $block[$i]['assn']       = $assn;
        $block[$i]['title']      = $title;
        $block[$i]['uid_name']   = $uid_name;
        $block[$i]['start_date'] = date("Y-m-d", $start_date);
        $i++;
    }

    return $block;
}
