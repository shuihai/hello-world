<?php
$session = \Yii::$app->session;
$robot_id = $session->get('robot_id');
?>

<div class="col-md-2 pull-left indexMenu">
    <div class="row">
        <ul class="list-group indexLeftUl">
            <a href="#"><li class="indexLeftSet"><div class="pull-left indexRobot"></div><span class="pull-left">机器人设置</span></li></a>
            <a href="marketing_tool.html"><li class="indexLeftPart"><div class="pull-left indexLaba"></div><span class="pull-left">营销工具</span></li></a>
            <a href="meeting_statistics.html"><li class="indexLeftMeeting"><div class="pull-left indexHuiyi"></div><span class="pull-left">会议统计</span></li></a>			
        </ul>
    </div>

</div>