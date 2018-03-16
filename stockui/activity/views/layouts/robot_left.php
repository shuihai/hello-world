<?php

use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use dmstr\widgets\Menu;
use robotUser\models\Robot;

$session = \Yii::$app->session;



if (strripos($_SERVER['REQUEST_URI'], '?') > 0) {
    $url_str_temp = substr($_SERVER['REQUEST_URI'], 0, strripos($_SERVER['REQUEST_URI'], '?'));
} else {
    $url_str_temp = $_SERVER['REQUEST_URI'];
}
$url_str = substr($url_str_temp, 0, ($last = strripos($url_str_temp, '/')));
$begin = strripos($url_str, '/');
$url_str = substr($url_str_temp, $begin);
?>

<div class="usher_content_center_left">
    <ul>
        <li><a href="<?= \yii\helpers\Url::toRoute(["/lunbo/index"] ) ?>" <?php if ($url_str == '/lunbo/index' || $url_str == '/' ) {echo ' style="color: #508DF7;"';}?>>轮播图设置</a></li><i></i>
        <li><a href="<?= \yii\helpers\Url::toRoute(["/speech/index"] ) ?>" <?php if ($url_str == '/speech/index' || $url_str == '/speech/build' ) {echo ' style="color: #508DF7;"';}?>>离线语音设置</a> </li><i></i>
    </ul>
</div>