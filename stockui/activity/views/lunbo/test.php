<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>



<link rel="stylesheet" type="text/css" href="../js/cxuploader.css"/>
<link rel="stylesheet" type="text/css" href="../js/webuploader/webuploader.css"/>
<div id="usher">

    <?=
    $this->render(
            '../layouts/header.php'
    )
    ?>


    <div class="usher_content">
        <div class="usher_content_center">
            <?=
            $this->render(
                    '../layouts/robot_left.php'
            )
            ?>
            <div class="usher_content_center_right">
                <div class="right_navigationBar">
                    <h3>轮播图设置</h3>
                    <div id="filePicker">上传轮播图片</div>
                </div>
                <hr />
                <div class="img_set">
                    <p class="tishi">最多上传10张图片,图片尺寸要求为894X908，大小在2M以内，格式为jpg、jpeg、png、bmp</p>
                    <div id="uploader-demo">
                        <div id="fileList" class="uploader-list">
                            <?php foreach ($list as $key => $value) { ?>
                            <div id="old_<?=  $value['id'] ?>" class="file-item thumbnail upload-state-done"><img src="<?= \Yii::getAlias('@hotel') . '/' . $value['image'] ?>">
                                <div class="uploder-container">
                                    <div class="cxuploder">
                                        <div class="queueList">
                                            <div class="placeholder">
                                                <div class="filePicker webuploader-container">
                                                    <div class="webuploader-pick">

                                                    </div>
                                                    <div id="rt_rt_1c7qini1igs3196v1nohvvj1oc17" style="position: absolute; top: 25px; left: 80px; width: 20px; height: 20px; overflow: hidden; bottom: auto; right: auto;"><input type="file" name="file" class="webuploader-element-invisible" accept="image/jpg,image/jpeg,image/png,image/bmp"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="filelist">

                                            </ul>
                                        </div>
                                        <div class="statusBar" style="display:none;">
                                            <div class="btns">
                                                <div class="jxfilePicker webuploader-container">
                                                    <div class="webuploader-pick"></div>
                                                    <div id="rt_rt_1c7qini1jcklg49dtklb31eqqa" style="position: absolute; top: 0px; left: 0px; width: 20px; height: 20px; overflow: hidden; bottom: auto; right: auto;">
                                                        <input type="file" name="file" class="webuploader-element-invisible" accept="image/jpg,image/jpeg,image/png,image/bmp">
                                                        <label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="del_img" onclick="removeFile2('old_<?=  $value['id'] ?>')"></span><i class="hintlong" style="display: none;"></i>
                                <i class="hintshort"></i>
                            </div>
                            <?php } ?>  

                        </div>
                    </div>
                </div>
                <button class="img_save">保存</button>
            </div>
        </div>
    </div>
    <form id="form">
        <input type="hidden" id="user_id" value="<?= Html::encode($user_id) ?>"/>
        <input type="hidden" id="robot_id" value="<?= Html::encode($robot_id) ?>"/>
        <?php foreach ($list as $key => $value) { ?>
            <input type="hidden" name="img[]" value="<?= Html::encode($value['image']) ?>" class="old_<?= Html::encode($value['id']) ?> hehe">
        <?php } ?>  
    </form>

</div>

<script src="../js/jq1.11.2.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/webuploader/webuploader.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/slimscroll/jquery.slimscroll.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<!--s<script src="../js/cxuploader.js" type="text/javascript" charset="utf-8"></script>-->
<script src="../js/index.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

 
    window.server= '<?= \yii\helpers\Url::toRoute(['uploadimg/img']) ?>';
    
 
    
    $("body").on('click',".placeholder",function( ){
        
        window.file_id=$(this).parents('.upload-state-done').attr('id')    
        console.log(window.file_id)
    });
    
    $("body").on('click',".statusBar",function( ){
        
        window.file_id=$(this).parents('.upload-state-done').attr('id')    
        console.log(window.file_id)
    });
    
    function removeFile2( fileid ) {
        var $li = $('#'+fileid);
        $li.remove();
            
        $li2 = $('.'+fileid);
        $li2.remove();
            
    }
     
 


    //保存
    $(".img_save").click(function(){
        if($("#fileList>.file-item").length > 10){
            layer.msg("最多上传十张图片");
            return false;
        }
        
        $.ajax({
            url:'<?= \yii\helpers\Url::toRoute(["add", 'robot_id' => $robot_id]) ?>',
            type:'post',
            data:$('#form').serialize(),
            success:function (data) {
                data = JSON.parse(data);
                if(data['code'] == 1){
                    window.location.reload();
                }else {
                    alert(data['info']);
                }
            }
        });
    })
 

		
</script>
