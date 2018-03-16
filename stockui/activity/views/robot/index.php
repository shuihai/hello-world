<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>




<div class="container box">
    <!--header-->



    <?=
    $this->render(
            '../layouts/header.php'
    )
    ?>



    <!--header-->

    <div class="row">
        <?=
        $this->render(
                '../layouts/robot_left.php'
        )
        ?>

        <!--右边栏内容区-->
        <div class="col-md-10 pull-left indexContent">
            <div class="row">
                <div class="col-md-12 aroundSetLou1" >
                    <div class="indexRoad" ><a href="<?= \yii\helpers\Url::toRoute(["/robot-info/index"]) ?>">机器人设置</a>  /&nbsp;/  <a href="javascript:;">首页设置</a> </div>
                </div>
            </div>
            <div class="row meeting_border"></div>
            <div class="col-md-12" style="padding:0 0 0 60px ;">
                <div class="row">
                    <div class="col-md-12 aroundSetLou2" >
                        <h2 style="margin-top: 0; display: inline-block; padding-right: 10px;">酒店轮播图</h2>*最多上传9张图片,图片尺寸要求为1010x1288，大小在2M以内，格式为jpg、jpeg、png、bmp，轮播图默认时长为5s。											
                    </div>
                </div>					
                <div class="col-md-12 ">
                    <div class="row ">
                        <div class="page-container">
                            <div class="uploder-container uploder-container_1">sssssssssssssssssssss
                                <div class="cxuploder">
                                    <div class="statusBar" style="">
                                        <div class="btns">
                                            <div class="jxfilePicker webuploader-container"><div class="webuploader-pick"></div><div id="rt_rt_1budcs14vc72oloeqmm31g5" style="position: absolute; top: 0px; left: 0px; width: 120px; height: 36px; overflow: hidden; bottom: auto; right: auto;"><input type="file" name="file" style="display: none;" class="webuploader-element-invisible" multiple="multiple" accept="image/*"><label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255);"></label></div></div>
                                        </div>
                                    </div>
                                    <div class="queueList filled">
                                        <ul class="filelist">
                                            <?php foreach ($list as $key => $value) { ?>
                                                <li id="old_<?= Html::encode($value['id']) ?>"><p class="imgWrap"><img src="<?= \Yii::getAlias('@hotel') . '/' . $value['image'] ?>"></p><p class="progress"><span></span></p><div class="file-panel"><span class="cancel" style="margin-right:95px " onclick="removeOld('old_<?= Html::encode($value['id']) ?>')">删除</span></div></li>
                                            <?php } ?>  
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
            <div class="meeting_footer">
                <a href="javascript:;" class="meet_btn meet_save">保存</a>
            </div>


        </div>
        <form id="form">
            <?php foreach ($list as $key => $value) { ?>
                <input type="hidden" name="img[]" value="<?= Html::encode($value['image']) ?>" class="old_<?= Html::encode($value['id']) ?> hehe">
            <?php } ?>  
        </form>
        <!--右边栏内容区-->
    </div>



</div>


<style>
    .cxuploder .filelist li{width: 250px ; height: 290px !important; margin-top: 50px;}
    .cxuploder .filelist li p.imgWrap{height: 250px; width: 250px;}
    .cxuploder .filelist li img{width: 250px; height: 250px;}
</style>

<script type="text/javascript" src="../js/webuploader2/webuploader.js" ></script>
<!--	<script type="text/javascript" src="../js/webuploader/.js" ></script>-->
<script type="text/javascript" src="../js/indexSet.js" charset="utf-8"></script>
<script src="../js/layer/layer.js"></script>

<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/index.css" />
<link rel="stylesheet" href="../js/webuploader2/webuploader.css" />
<link rel="stylesheet" href="../css/cxuploader.css" />
<script>
    
    function removeFile2( fileid ) {

            
        var $li = $('#'+fileid);
        $li.remove();
            
        $li2 = $('.'+fileid);
        $li2.remove();
            
    }
        
    //user_home_image_add
    $('.meet_save').click(function(){
       
        if($('.hehe').length>9){
            
            layer.alert('上传图片总数不能超过九张');return false;
        }
        $.ajax({
            url:'<?= \yii\helpers\Url::toRoute(["user_home_image_add", 'robot_id' => $robot_id]) ?>',
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
    
    function removeOld( file ) {
        var $li = $('#'+file);
        $li.remove();
            
        $li2 = $('.'+file);
        $li2.remove();
            
        //            $li.off().find('.file-panel').off().end().remove();
    } 
    
    jQuery(function() {

        uploader = new Array();//创建 uploader数组
        // 优化retina, 在retina下这个值是2
        var ratio = window.devicePixelRatio || 1,
        // 缩略图大小
        thumbnailWidth = 100 * ratio,
        thumbnailHeight = 100 * ratio,
        supportTransition = (function(){
            var s = document.createElement('p').style,
            r = 'transition' in s ||
                'WebkitTransition' in s ||
                'MozTransition' in s ||
                'msTransition' in s ||
                'OTransition' in s;
            s = null;
            return r;
        })();
        // 所有文件的进度信息，key为file id
        var percentages = {};
        var state = 'pedding';

        //可行性判断
        if ( !WebUploader.Uploader.support() ) {
            alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
            throw new Error( 'WebUploader does not support the browser you are using.' );
        }

        //循环页面中每个上传域
        $('.uploder-container').each(function(index){

            // 添加的文件数量
            var fileCount = 0;
            // 添加的文件总大小
            var fileSize = 0;

            var filePicker=$(this).find('.filePicker');//上传按钮实例
            var queueList=$(this).find('.queueList');//拖拽容器实例
            var jxfilePicker=$(this).find('.jxfilePicker');//继续添加按钮实例
            var placeholder=$(this).find('.placeholder');//按钮与虚线框实例
            var statusBar=$(this).find('.statusBar');//再次添加按钮容器实例
            var info =statusBar.find('.info');//提示信息容器实例

            // 图片容器       	
            //            var queue = $('<ul class="filelist"></ul>').appendTo( queueList);
            var queue = $('.filelist');

            //            alert(1)

            //初始化上传实例
            uploader[index] = WebUploader.create({
                pick: {
                    id: filePicker,
                    label: '',
                    multiple: false 
                },
                dnd: queueList,

                //这里可以根据 index 或者其他，使用变量形式
                accept: {
                    title: 'Images',
                    extensions: 'jpg,jpeg,bmp,png',
                    mimeTypes: 'image/jpg,image/jpeg,image/png'
                },

                // swf文件路径
                swf: 'webuploader/Uploader.swf',

                disableGlobalDnd: true,//禁用浏览器的拖拽功能，否则图片会被浏览器打开

                chunked: false,//是否分片处理大文件的上传
                 fileNumLimit: <?= $limit  ?>,//一次最多上传文件个数

                server: '<?= \yii\helpers\Url::toRoute(['uploadimg/img']) ?>',//上传地址

                fileNumLimit: 9,//一次最多上传文件个数

                fileSizeLimit: 8 * 1024 * 1024,    // 总共的最大限制8M

                fileSingleSizeLimit: 2 * 1024 * 1024 ,   // 单文件的最大限制2M

                auto :true,

                formData: {                
                    token:index//可以在这里附加控件编号，从而区分是哪个控件上传的
                }
            });


            // 添加“添加文件”的按钮
            uploader[index].addButton({
                id: jxfilePicker,
                label: '上传轮播图'
            });

            //当文件加入队列时触发	uploader[0].upload();
            uploader[index].onFileQueued = function( file ) {
                //alert(111);
                fileCount++;
                fileSize += file.size;

                if ( fileCount === 1 ) {
                    placeholder.addClass( 'element-invisible' );
                    statusBar.show();
                    //placeholder.hide();
                    jxfilePicker.show();
                }


                
                addFile( file,uploader[index],queue);
                setState( 'ready' ,uploader[index],placeholder,queue,statusBar,jxfilePicker);
                updateStatus('ready',info,fileCount,fileSize);
            };

            //当文件被移除队列后触发。
            uploader[index].onFileDequeued = function( file ) {
                fileCount--;
                fileSize -= file.size;

                if ( !fileCount ) {
                    setState( 'pedding',uploader[index],placeholder,queue,statusBar,jxfilePicker);
                    updateStatus('pedding',info,fileCount,fileSize);
                }              
                removeFile( file );



            };

            uploader[index].on('uploadSuccess',function(file,response){
     
                $('<input type="hidden" name="img[]" value='+response["_raw"]+' class="'+file.id+' hehe"'+'>').appendTo("#form");

            });


            //可以在这里附加额外上传数据

            uploader[index].on('uploadBeforeSend',function(object,data,header) {
                /*var tt=$("input[name='id']").val();
data=$.extend(data,{
modelid:tt
});*/
                //alert("上传前触发");
            });

        });



        // 当有文件添加进来时执行，负责view的创建
        function addFile( file,now_uploader,queue) {
            var $li = $( '<li id="' + file.id + '">' +
                // '<p class="title">' + file.name + '</p>' +
            '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '</li>' ),

            $btns = $('<div class="file-panel">' +
                '<span class="cancel" style="margin-right:95px"  onclick="removeFile2('+"'"+file.id+"'"+')" >删除</span>'
            //                  '<span class="rotateRight">向右旋转</span>' +

        ).appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>');

            $wrap.text( '预览中' );
            if(file.flog == true){
                var img = $('<img src="'+file.ret+'">');
                $wrap.empty().append( img );
            }else{
                now_uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        $wrap.text( '不能预览' );
                        return;
                    }

                    var img = $('<img src="'+src+'">');
                    $wrap.empty().append( img );
                }, thumbnailWidth, thumbnailHeight );
            }

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;



            /*
    file.on('statuschange', function( cur, prev ) {
    if ( prev === 'progress' ) {
    $prgress.hide().width(0);
    } else if ( prev === 'queued' ) {
    $li.off( 'mouseenter mouseleave' );
    $btns.remove();
    }

    // 成功
    if ( cur === 'error' || cur === 'invalid' ) {
    console.log( file.statusText );
    showError( file.statusText );
    percentages[ file.id ][ 1 ] = 1;
    } else if ( cur === 'interrupt' ) {
    showError( 'interrupt' );
    } else if ( cur === 'queued' ) {
    percentages[ file.id ][ 1 ] = 0;
    } else if ( cur === 'progress' ) {
    $info.remove();
    $prgress.css('display', 'block');
    } else if ( cur === 'complete' ) {
    $li.append( '<span class="success"></span>' );
    }

    $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
    });
             */


            //          $li.on( 'mouseenter', function() {
            //              $btns.stop().animate({height: 30});
            //          });
            //
            //          $li.on( 'mouseleave', function() {
            //              $btns.stop().animate({height: 0});
            //          });


            $btns.on( 'click', 'span', function() {
                var index = $(this).index(),
                deg;

                switch ( index ) {
                    case 0:
                        //                        now_uploader.removeFile( file );
                        return;

                    case 1:
                        file.rotation += 90;
                        break;

                    case 2:
                        file.rotation -= 90;
                        break;
                }

                if ( supportTransition ) {
                    deg = 'rotate(' + file.rotation + 'deg)';
                    $wrap.css({
                        '-webkit-transform': deg,
                        '-mos-transform': deg,
                        '-o-transform': deg,
                        'transform': deg
                    });
                } else {
                    $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');

                }


            });

            $li.appendTo(queue);
        }


        // 负责view的销毁
        function removeFile( file ) {
            //            var $li = $('#'+file.id);
            //            delete percentages[ file.id ];
            //            
            //            $li2 = $('.'+file.id);
            //            $li2.remove();
            //            alert(1)
            
            var $li = $('#'+file.id);
            $li.remove();
            
            $li2 = $('.'+file.id);
            $li2.remove();
            
            
            //            $li.off().find('.file-panel').off().end().remove();
        } 

        function setState( val, now_uploader,placeHolder,queue,statusBar,jxfilePicker) {

            switch ( val ) {
                case 'pedding':
                    placeHolder.removeClass( 'element-invisible' );
                    queue.parent().removeClass('filled');
                    queue.hide();
                    statusBar.addClass( 'element-invisible' );
                    now_uploader.refresh();
                    break;

                case 'ready':
                    placeHolder.addClass( 'element-invisible' );
                    jxfilePicker.removeClass( 'element-invisible');
                    queue.parent().addClass('filled');
                    queue.show();
                    statusBar.removeClass('element-invisible');
                    now_uploader.refresh();
                    break;              
            }


        }

        function updateStatus(val,info,f_count,f_size) {
            var text = '';

            if ( val === 'ready' ) {
                text = '选中' + f_count + '张图片，共' +
                    WebUploader.formatSize( f_size ) + '。';
            } 

            info.html( text );
        } 
                 
 


    });
</script>