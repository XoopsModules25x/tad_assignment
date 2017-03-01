<?php
$modversion = array();

//---�Ҳհ򥻸�T---//
$modversion['name']        = _MI_TADASSIGN_NAME;
$modversion['version']     = 2.41;
$modversion['description'] = _MI_TADASSIGN_DESC;
$modversion['author']      = _MI_TADASSIGN_AUTHOR;
$modversion['credits']     = _MI_TADASSIGN_CREDITS;
$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.tpl/';
$modversion['image']       = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname']     = basename(dirname(__FILE__));

//---�Ҳժ��A��T---//
$modversion['release_date']        = '2017-01-08';
$modversion['module_website_url']  = 'http://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status']       = 'release';
$modversion['author_website_url']  = 'http://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php']             = 5.3;
$modversion['min_xoops']           = '2.5';
$modversion['min_tadtools']        = '2.02';

//---paypal��T---//
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'tad0616@gmail.com';
$modversion['paypal']['item_name']     = 'Donation : ' . _MI_TAD_WEB;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---��ƪ�[�c---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1]        = "tad_assignment";
$modversion['tables'][2]        = "tad_assignment_file";
$modversion['tables'][3]        = "tad_assignment_types";

//---�Ұʫ�x�޲z�ɭ����---//
$modversion['system_menu'] = 1;

//---�w�˳]�w---//
$modversion['onInstall']   = "include/onInstall.php";
$modversion['onUpdate']    = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---�޲z�����]�w---//
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu']  = "admin/menu.php";

//---�ϥΪ̥D���]�w---//
$modversion['hasMain']        = 1;
$modversion['sub'][2]['name'] = _MI_TADASSIGN_SMNAME2;
$modversion['sub'][2]['url']  = "show.php";

//---�˪O�]�w---//
$i                                          = 1;
$modversion['templates'][$i]['file']        = 'tad_assignment_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_index.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'tad_assignment_show.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_show.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'tad_assignment_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_adm_main.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'tad_assignment_adm_add.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_adm_add.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'tad_assignment_adm_add_type.tpl';
$modversion['templates'][$i]['description'] = 'tad_assignment_adm_add_type.tpl';

//---�϶��]�w---//
$modversion['blocks'][1]['file']        = "tad_new_assignment.php";
$modversion['blocks'][1]['name']        = _MI_TADASSIGN_BNAME1;
$modversion['blocks'][1]['description'] = _MI_TADASSIGN_BDESC1;
$modversion['blocks'][1]['show_func']   = "tad_new_assignment";
$modversion['blocks'][1]['template']    = "tad_new_assignment.tpl";
