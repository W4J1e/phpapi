<?php
// ================================ //
include "qb-date.php"; //更新日志引入
$note = $date20210124; //更新日志输出
// ================================ //
/*
  _  _    _____  ____    _______  ______            __  __ 
 | || |  / ____||  _ \  |__   __||  ____|    /\    |  \/  |
 | || |_| (___  | |_) |    | |   | |__      /  \   | \  / |
 |__   _|\___ \ |  _ <     | |   |  __|    / /\ \  | |\/| |
    | |  ____) || |_) |    | |   | |____  / ____ \ | |  | |
    |_| |_____/ |____/     |_|   |______|/_/    \_\|_|  |_|
    
    
    
    - Title:Q绑聚合查询程序API(后端)
    - Author:Hiker [ outlo0k@foxmail.com ]
*/
error_reporting(0); //禁止显示所有PHP错误,不影响正常功能使用,但去除会影响网页美观.

// ================================ //

    /*密钥验证 Start*/
if ($_GET["yex"] === "viphiker") {
    /*密钥验证 Start*/

// ================================ //

    /*手机号码反查接口*/
if ($_GET["api"] === "c") {
header('Content-type: text/json');
echo file_get_contents("http://8v4o.cn:81/mob-api.php?mod=cha&hm=".$_GET['hm']);
}
    /*手机号码反查接口*/
    
// ================================ //
    
    /*1号 QQ 反查手机接口*/
elseif ($_GET["api"] === "1") {
header('Content-type: text/json');
echo file_get_contents("http://qblingying.top/api.php?qq=".$_GET['qq']);
}
    /*1号 QQ 反查手机接口*/
    
// ================================ //
    
    /*2号 QQ 反查手机接口*/
elseif (($_GET["api"] === "2")) {
header('Content-type: text/json');
echo file_get_contents("http://new.fulimcp.cn/qb-api.php?mod=cha&qq=".$_GET['qq']);
}
    /*2号 QQ 反查手机接口*/
    
// ================================ //

    /*3号 QQ 反查手机接口*/
elseif (($_GET["api"] === "3")) {
header('Content-type: text/json');
echo file_get_contents("http://8v4o.cn:81/qb-api.php?mod=cha&qq=".$_GET['qq']);
}
    /*3号 QQ 反查手机接口*/

// ================================ //

    /*4号 QQ 反查手机接口*/
elseif (($_GET["api"] === "4")) {
header('Content-type: text/json');
echo file_get_contents("http://caonimaqb.wdnmd.in/458458.php?mod=cha&qq=".$_GET['qq']);
}
    /*4号 QQ 反查手机接口*/
    
// ================================ //

    /*如果接口不正确则提示*/
else {
header("Http/1.1 403 Forbidden");
$tips = "找不到接口或者接口已下线,请检查您的调用方式后重试.<br><br><b>更新日志</b>";
echo $tips.$note;
}
    /*如果接口不正确则提示*/
    
// ================================ //

    /*密钥验证 Stop*/
}
    /*密钥验证 Stop*/

// ================================ //

    /*如果密钥不正确则提示*/
else {
header("Http/1.1 403 Forbidden");
echo "未能成功发起密钥鉴权行为,请检查您的调用方式后重试.";
}
    /*如果密钥不正确则提示*/

// ================================ //
?>
