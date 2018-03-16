<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<div class="row">
            <div class="col-md-4">
                <div class="dashboard-stat2">
                    <div class="display">
                        <h1 class="font-green-sharp"><?=$arrCount["robot"]?></h1>
                        <a href="<?=\yii\helpers\Url::toRoute('index/index')?>" class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-android tooltips" data-original-title="Android"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat2">
                    <div class="display">
                        <h1 class="text-info"><?=$arrCount["customer"]?></h1>
                        <a href="<?=\yii\helpers\Url::toRoute('customer/index')?>" class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-smugmug tooltips" data-original-title="Smugmug"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-stat2">
                    <div class="display">
                        <h1 class="font-purple-sharp"><?=$arrCount["info"]?></h1>
                        <a href="<?=\yii\helpers\Url::toRoute('info/index')?>" class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-outlook tooltips" data-original-title="Outlook"></a>
                    </div>
                </div>
            </div>
 </div>
