<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (class_exists('robotUser\assets\AppAsset2')) {
    robotUser\assets\AppAsset2::register($this);
} else {
    return "assets2文件路径错误";
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
    </head>


    <body>

        <?php
        $this->beginBody();
        $directoryAsset = null;
        ?>

        <div class="container box">
            <!--header-->

            <?=
            $this->render(
                    'header2.php', ['directoryAsset' => $directoryAsset]
            )
            ?>

            <!--header-->

            <div class="row">
                <!--侧边栏menu-->
                <?=
                $this->render(
                        'left2.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?= $content ?>

                <!--侧边栏menu-->

                <!--右边栏内容区-->

            </div>

            <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>