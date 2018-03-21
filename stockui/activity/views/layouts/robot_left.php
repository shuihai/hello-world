<?php

use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use dmstr\widgets\Menu;
use robotUser\models\Robot;

$session = \Yii::$app->session;


 
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


                    <li id="toolBox" class="open active">
                        <a href="#" title="工具箱">  <span
                                class="menu-item-parent">工具箱</span><b class="collapse-sign"><em
                                    class="fa fa-angle-up fa-right fa-up"></em></b></a>
                    </li>

                    <li><a href="http://www.xiguaji.com/Knowledge" title="帮助中心" target="_blank"> <span class="menu-item-parent">帮助中心</span></a>
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