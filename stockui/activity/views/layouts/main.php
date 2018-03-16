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
        <meta charset="<?= Yii::$app->charset ?>"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="stylesheet" type="text/css" href="../css/index.css"/>
    </head>


    <body>

        <?php
        $this->beginBody();
  
        ?>
        <?= $content ?>


        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>