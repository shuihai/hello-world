<?php
use yii\widgets\Breadcrumbs;
?>


    <section class="content-header">
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>
<!--    <section class="user-content">-->
<!--        <div class="page-container">-->
            <?= $content ?>
<!--        </div>-->
<!--    </section>-->
ss

<div class="footer">
    <span class="use_clause">使用条款</span>
    <span class="conceal">隐私政策</span>
    <p>©2017　　天津智汇时代科技有限公司</p>
</div>