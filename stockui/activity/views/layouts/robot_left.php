<?php

use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use dmstr\widgets\Menu;
use robotUser\models\Robot;

$session = \Yii::$app->session;

if(strripos($_SERVER['REQUEST_URI'],'?')>0){
    $url_str_temp =  substr($_SERVER['REQUEST_URI'],0,strripos($_SERVER['REQUEST_URI'],'?')); 
}  else {
    $url_str_temp = $_SERVER['REQUEST_URI'];
}
$url_str = substr($url_str_temp,0,($last = strripos($url_str_temp,'/')));
$begin = strripos($url_str,'/');
$url_str = substr($url_str_temp,$begin);
 
?>

<div class="sidebar">
    <div class="brand">
        <div class="brand-logo"><a href="http://www.xiguaji.com">小明自用平台</a></div>
    </div>
    <nav class="mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;">
        <div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;"
             tabindex="0">
            <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y"
                 style="position:relative; top:0; left:0;" dir="ltr">
                <ul style="">


                    <li id="toolBox" <?php if ($url_str == '/lunbo/index'  ) {echo "  class='open active'";}?> >
                        <a href="<?= \yii\helpers\Url::toRoute(["/lunbo/index" ]) ?>" title="公众号列表">  <span
                                class="menu-item-parent">公众号列表</span> </a>
                    </li>

                    <li   <?php if ($url_str == '/lunbo/showremark'  ) {echo "  class='open active'";}?>><a href="<?= \yii\helpers\Url::toRoute(["/lunbo/showremark" ]) ?>" title="评论列表" > <span class="menu-item-parent">评论列表</span></a>
                    </li>

                </ul>
            </div>
        </div>

    </nav>


    <div class="side-brand">

        <div class="side-user-area">
            <div class="pull-left user-area">
                <div class="pull-left icon-user">

                    <img src="http://thirdwx.qlogo.cn/mmopen/Q3auHgzwzM4NGEndWFTMNgM8E5rMicItrr3ia7JlS4giciajr8uyrCZ4ALPWF8funPd82aaFj8ywbMD0BvlhXgibgkxYDcpRiaEzeKXg9dAxFAXQg/132">


                </div>



                <div class="user-info">
                    <a href="#/Home/MemberInfo" data-toggle="tooltip" data-placement="top" data-original-title="个人中心">徐小明</a>
                    <span class="user-id">ID:00276011</span>
                </div>

            </div>
            <a id="btn-logout" class="pull-right btns-exit" href="/Login/Logout" data-logout-msg="确认是否要退出？"
               data-toggle="tooltip" data-placement="top" data-original-title="注销">

                <i class="iconfont icon-tuichu"></i>
            </a>
        </div>
    </div>




</div>