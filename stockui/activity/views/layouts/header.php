<?php

use yii\helpers\Url;

//$user_info = Yii::$app->user->identity;
$user_info = Yii::$app->user->identity;

//$user_info['phone']='a';
//$user_info['contact']='a';
//$user_info['email']='a';
//$user_info['address']='a';
//$user_info['company_name']='a';

//print_r($user_info);

?>
    <div class="usher_header">
        <div class="usher_header_center">
            <img src="../img/logo.png" id="logo" onclick="clickButton();"/>
            <h6>欢迎登录机器人云用户管理系统</h6>
            <div class="header_right">
                <p class="userInfor"><img src="../img/icon_default_avatar_n.png"/><span><?= $user_info['username'] ?></span></p>
                <a href="<?=Yii::$app->params['mother_url'].'/site/logout' ?>"><p class="loginOut"><img src="../img/icon_logout_n.png"/><span>退出登录</span></p></a>
            </div>
        </div>
    </div>

<script>
    function clickButton()
    {
        window.location.href = "<?php echo Yii::$app->params['mother_url']  ;?>";
    }

</script>