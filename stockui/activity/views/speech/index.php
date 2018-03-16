<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>




<div id="usher">

    <?=
    $this->render(
            '../layouts/header.php'
    )
    ?>
<input type="hidden" id="user_id" value="<?= Html::encode($user_id) ?>"/>
<input type="hidden" id="robot_id" value="<?= Html::encode($robot_id) ?>"/>

    <div class="usher_content">
        <div class="usher_content_center">
            <?=
            $this->render(
                    '../layouts/robot_left.php'
            )
            ?>


            <div class="usher_content_center_right">
                <div class="right_navigationBar">
                    <h3>离线语音设置</h3>
                    <div class="speech_navigationBtn">
                        <a href="javascript:;" class="speech_del">全部删除</a>
                        <a href="<?= \yii\helpers\Url::toRoute(["/speech/build"]) ?>" class="speech_build">创建语音</a>
                    </div>
                </div>
                <hr />
                <div class="speech_QA">
                    <?php foreach ($list as $key => $value) { ?>
                        <div class="q_a">
                            <div class="q_a_left">
                                <i>Q:　</i>
                                <div class="question">
                                    <?php foreach ($value['voice_question'] as $k => $v) { ?>
                                        <span><?= Html::encode($v['question']) ?></span>
                                    <?php } ?>  

                                </div>
                                <i>A:　</i>
                                <div class="answer">
                                    <?php foreach ($value['voice_answer'] as $k => $v) { ?>
                                        <span><?= Html::encode($v['answer']) ?></span>
                                    <?php } ?>  

                                </div>
                            </div>
                            <div class="q_a_right">
                                <a href="<?= \yii\helpers\Url::toRoute(["/speech/build", 'voice_id' => $value['id']]) ?>" class="q_aEdit">编辑</a>
                                <a href="#" class="q_aDelete" onClick="javascript:window.voice_id=<?= $value['id'] ?>;">删除</a>
                            </div>
                        </div>
                    <?php } ?>  

                </div>
            </div>
        </div>
    </div>
</div>
<!--删除弹窗-->
<div class="del_modal">
    <div class="modal_back"></div>
    <div class="modal_center">
        <div class="modal_header"><span class="close_del"></span></div>
        <div class="modal_body">
            是否确定删除？
        </div>
        <div class="modal_footer">
            <span class="confirm_del">确定</span>
            <span class="cancel_del">取消</span>
        </div>
    </div>
</div>

<script src="../js/jq1.11.2.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/index.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    //单个删除
    $(document).on("click",".q_aDelete",function(){
        $(".del_modal").show();
        $(".confirm_del").click(function(){
				            
            $.ajax({
                url:'<?= \yii\helpers\Url::toRoute(["delete"]) ?>',
                type:'post',
                data:{'voice_id':window.voice_id },
                success:function (data) {
                    data = JSON.parse(data);
            
                    if(data['code'] == 1){
                 
                        window.location.href = '<?= \yii\helpers\Url::toRoute(["/speech/index"]) ?>';
                    }else {
                        layer.msg(data['info']);
                    }
 
                }
            });
        })
        
        $(".cancel_del").click(function(){
            $(".del_modal").hide();
        })
        $(".close_del").click(function(){
            $(".del_modal").hide();
        })
    })
		
    //全部删除
    $(".speech_del").click(function(){
                $(".del_modal").show();
        $(".confirm_del").click(function(){
				            
            $.ajax({
                url:'<?= \yii\helpers\Url::toRoute(["delete"]) ?>',
                type:'post',
                data:{'user_id':$('#user_id').val(),'robot_id':$('#robot_id').val() },
                success:function (data) {
                    data = JSON.parse(data);
            
                    if(data['code'] == 1){
                 
                        window.location.href = '<?= \yii\helpers\Url::toRoute(["/speech/index"]) ?>';
                    }else {
                        layer.msg(data['info']);
                    }
 
                }
            });
        })
        
        $(".cancel_del").click(function(){
            $(".del_modal").hide();
        })
        $(".close_del").click(function(){
            $(".del_modal").hide();
        })
        //        $(".speech_QA .q_a").remove();
    })
</script>