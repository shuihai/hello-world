<?php
use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use dmstr\widgets\Menu;


if(strripos($_SERVER['REQUEST_URI'],'?')>0){
    $url_str_temp =  substr($_SERVER['REQUEST_URI'],0,strripos($_SERVER['REQUEST_URI'],'?')); 
}  else {
    $url_str_temp = $_SERVER['REQUEST_URI'];
}
$url_str = substr($url_str_temp,0,($last = strripos($url_str_temp,'/')));
$begin = strripos($url_str,'/');
$url_str = substr($url_str_temp,$begin);

 
//if ($url_str == '/report/reportnew' && $_GET['type'] == Params::REPORT_WEEK) {echo " style="color: #FFFFFF;"'";}


?>
        <!--侧边栏menu-->
        <div class="col-md-2 pull-left indexMenu">
            <div class="row">
                <ul class="list-group indexLeftUl">
                    <a href="<?= \yii\helpers\Url::toRoute(["/robot-info/index"] ) ?>"><li class="indexLeftSet"><div class="pull-left indexRobot" <?php if ($url_str == '/robot-info/index'  ) {echo " style='background: url(../img/ico_robot_selected.png);'";}?>></div><span class="pull-left" <?php if ($url_str == '/robot-info/index'  ) {echo " style='color: #FFFFFF;'";}?>>机器人设置</span></li></a>
                    <a href="<?= \yii\helpers\Url::toRoute(["/activity/index"] ) ?>"><li class="indexLeftPart"><div class="pull-left indexLaba" <?php if ($url_str == '/activity/index'  ) {echo " style='background: url(../img/ico_sale_selected.png);'";}?>></div><span class="pull-left" <?php if ($url_str == '/activity/index'  ) {echo " style='color: #FFFFFF;'";}?>>营销活动</span></li></a>
                    <a href="<?= \yii\helpers\Url::toRoute(["/meeting/statistic"] ) ?>"><li class="indexLeftMeeting"><div class="pull-left indexHuiyi" <?php if ($url_str == '/meeting/statistic'  ) {echo " style='background: url(../img/ico_meeting_selected.png);'";}?>></div><span class="pull-left" <?php if ($url_str == '/meeting/statistic'  ) {echo " style='color: #FFFFFF;'";}?>>会议统计</span></li></a>			
                    <a href="<?= \yii\helpers\Url::toRoute(["/speech/speech_index"] ) ?>"><li class="indexLeftYuyin"><div class="pull-left indexYuyin" <?php if ($url_str == '/speech/speech_index'  ) {echo " style='background: url(../img/icon_yuyin_sel.png);'";}?>></div><span class="pull-left" <?php if ($url_str == '/speech/speech_index'  ) {echo " style='color: #FFFFFF;'";}?>>语音管理</span></li></a>			
                </ul>
            </div>

        </div>
        <!--侧边栏menu-->
