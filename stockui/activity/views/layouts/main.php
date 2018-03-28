<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
 
if (class_exists('activity\assets\AppAsset')) {
    activity\assets\AppAsset::register($this);
} else {
    return "assets文件路径错误";
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
       <meta content="webkit" name="renderer">
        <meta charset="utf-8">
        <?= Html::csrfMetaTags() ?>
        <title>热门公众 单22</title>
        <?php $this->head() ?>
        <!--<link rel="dns-prefetch" href="//bizcdn2.xiguaji.com/">-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" href="http://zs.xiguaji.com/Content/css/font-awesome.min.css?newv=0314">-->
<!--        <link href="http://zs.xiguaji.com/Content/css/select2.css?newv=0314" rel="stylesheet">
        <link href="http://zs.xiguaji.com/Content/css/animate.css?newv=0314" rel="stylesheet">-->
        <!--<link href="http://zs.xiguaji.com/Content/css/jquery.growl.css?newv=0314" rel="stylesheet">-->
 
        <!--[if lt IE 8]>
        <link href="~/Content/css/bootstrap-ie7.css" rel="stylesheet">
        <![endif]-->
        <link href="../css/index2.css" rel="stylesheet">
        <!--<link href="http://zs.xiguaji.com/Content/css/xiguaji-controls.css?newv=0314" rel="stylesheet">-->
        <!--<link href="http://zs.xiguaji.com/Content/css/bootstrap-switch.css?newv=0314" rel="stylesheet">-->
        <!--<link href="http://zs.xiguaji.com/Content/css/bootstrap-daterangepicker.css?newv=0314" rel="stylesheet">-->
        <!--<script src="http://zs.xiguaji.com/Content/js/respond.min.js?newv=0314"></script>-->

        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>
     

    <body class="body-w" style="overflow-y: visible;">

        <?php
        $this->beginBody();
  
        ?>
        <?= $content ?>


        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>