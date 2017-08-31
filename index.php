<?php
/*-----------�ޤJ�ɮװ�--------------*/
include "header.php";
$xoopsOption['template_main'] = "tad_assignment_index.html";
include_once XOOPS_ROOT_PATH."/header.php";
/*-----------function��--------------*/

//�C�X�Ҧ�tad_assignment���
function list_tad_assignment_menu()
{
    global $xoopsDB,$xoopsModule,$xoopsTpl;
    $now=xoops_getUserTimestamp(time());
    $sql = "select assn,title,uid,start_date from ".$xoopsDB->prefix("tad_assignment")." where start_date < '$now' and end_date > '$now'";
    $result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    $i=0;
    $data="";
    while (list($assn, $title, $uid, $start_date)=$xoopsDB->fetchRow($result)) {
        $uid_name=XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name=XoopsUser::getUnameFromId($uid, 0);
        }
        $data[$i]['assn']=$assn;
        $data[$i]['title']=$title;
        $data[$i]['uid_name']=$uid_name;
        $data[$i]['start_date']=date("Y-m-d H:i", xoops_getUserTimestamp($start_date));
        $i++;
    }

    $xoopsTpl->assign('all', $data);
    $xoopsTpl->assign('now_op', 'list_tad_assignment_menu');
}




//tad_assignment_file�s����
function tad_assignment_file_form($assn="")
{
    global $xoopsDB,$xoopsTpl;

    $DBV=get_tad_assignment($assn);
    foreach ($DBV as $k=>$v) {
        $$k=$v;
        $xoopsTpl->assign($k, $v);
    }


    $xoopsTpl->assign('note', nl2br($note));
    $xoopsTpl->assign('now_op', 'tad_assignment_file_form');
}

//�s�W��ƨ�tad_assignment_file��
function insert_tad_assignment_file()
{
    global $xoopsDB;
    $assignment=get_tad_assignment($_POST['assn']);

    if ($_POST['passwd']!=$assignment['passwd']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_ASSIGNMENT_WRONG_PASSWD);
        exit;
    }
    $now=date("Y-m-d H:i:s");

    $sql = "insert into ".$xoopsDB->prefix("tad_assignment_file")." (`assn` , `my_passwd` , `show_name` , `desc` , `author` , `email` ,`score`,`comment` , `up_time`) values('{$_POST['assn']}','{$_POST['my_passwd']}','{$_POST['show_name']}','{$_POST['desc']}','{$_POST['author']}','{$_POST['email']}' ,0, '', '$now')";
    $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    //���o�̫�s�W��ƪ��y���s��
    $asfsn=$xoopsDB->getInsertId();

    upload_file($asfsn, $_POST['assn']);

    return $_POST['assn'];
}

//�W���ɮ�
function upload_file($asfsn="", $assn="")
{
    global $xoopsDB;
    include_once XOOPS_ROOT_PATH."/modules/tadtools/upload/class.upload.php";
    set_time_limit(0);
    ini_set('memory_limit', '150M');
    $flv_handle = new upload($_FILES['file'], "zh_TW");
    if ($flv_handle->uploaded) {
        //$name=substr($_FILES['file']['name'],0,-4);
        $flv_handle->file_safe_name = false;
        $flv_handle->mime_check = false;

        $flv_handle->auto_create_dir = true;
        $flv_handle->file_new_name_body   = "{$asfsn}";
        $flv_handle->process(_TAD_ASSIGNMENT_UPLOAD_DIR."{$assn}/");
        $now=date("Y-m-d H:i:s");
        if ($flv_handle->processed) {
            $flv_handle->clean();
            $sql = "update ".$xoopsDB->prefix("tad_assignment_file")." set file_name='{$_FILES['file']['name']}',file_size='{$_FILES['file']['size']}' ,file_type='{$_FILES['file']['type']}',`up_time`='$now'  where asfsn='$asfsn'";
            $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
        } else {
            $sql = "delete from ".$xoopsDB->prefix("tad_assignment_file")." where asfsn='{$asfsn}'";
            $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
            redirect_header($_SERVER['PHP_SELF'], 3, "Error:".$flv_handle->error);
        }
    }
}



/*-----------����ʧ@�P�_��----------*/
$_REQUEST['op']=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$assn = (!isset($_REQUEST['assn']))? "":intval($_REQUEST['assn']);

switch ($_REQUEST['op']) {

  //�s�W���
  case "insert_tad_assignment_file":
  $assn=insert_tad_assignment_file();
  header("location: show.php?assn=$assn");
  break;

  //�w�]�ʧ@
  default:
  if (!empty($assn)) {
      tad_assignment_file_form($assn);
  } else {
      list_tad_assignment_menu();
  }
  break;
}

/*-----------�q�X���G��--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu)) ;
$xoopsTpl->assign("bootstrap", get_bootstrap()) ;
$xoopsTpl->assign("jquery", get_jquery(true)) ;
$xoopsTpl->assign("isAdmin", $isAdmin) ;

include_once XOOPS_ROOT_PATH.'/footer.php';
