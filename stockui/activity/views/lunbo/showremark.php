<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>



<!--sidebar-->
<?=
$this->render(
        '../layouts/robot_left.php'
)
?>


<!--/sidebar-->
<!--main-->


<div class="main">


    <div class="main-content">
        <!--topbar-->

        <!--/topbar-->
        <div id="content" style="opacity: 1;">
            <div class="wrapper wrapper-no-gap">

                <div class="mp-user-article-timer clearfix">
                    <div class="control-select-with-nav">

                        <input type="text" class="form_input" id="start_time"  name="date"  value="<?= $time ?>" placeholder="请选择日期">
                        <select type="text" class="form_input" id="remarktype"   name="type" style="margin-right: 10px">
                            <option value="0" >选择类型</option>
                            <option value="0"  >多空观点</option>
                            <option value="1"  >操作计划</option>
                            <option value="2"  >其他</option>
                        </select>


                        <a  id="hehe" class="btn btn-success"  > 搜索</a>

                    </div>

                </div>

                <!---->
                <!--<div class="popular-public-list">-->
                <!---->

                <!--/-->
                <!---->
                <div class="popular-public-list">
                    <div class="mp-account-list">
                        <table class="table">
                            <colgroup>
                                <col width="100"> 
                                <col width="150">
                                <col width="120">
                                <col width="50">
                                <col width="350">
                                <col width="50">
                                <col width="220">

                            </colgroup>
                            <thead>
                                <tr>
                                    <th>排行</th>
                                    <th class="">公众号名称</th>
                                    <th class="">日期</th>
                                    <th class="">多或空</th>
                                    <th>内容 </th>
                                    <th >排序  </th>
                                    <th >POWER  </th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody id="rankBody">


                                <?php foreach ($list as $key => $value) { ?>

                                    <tr>
                                        <td>
                                            <span class="table-rank table-rank1 "><?= $key + 1 ?></span>
                                        </td>
                                        <td>
                                            <div class="media-list">
                                                <div class="item-media">
                                                    <a>
                                                        <img class="lazy"
                                                             data-original="http://cdnlogo.xiguaji.com/BizLogo/MzI1MzAwODMyMQ==.jpg-BizLogoCut"
                                                             src="http://thirdwx.qlogo.cn/mmopen/Q3auHgzwzM4NGEndWFTMNgM8E5rMicItrr3ia7JlS4giciajr8uyrCZ4ALPWF8funPd82aaFj8ywbMD0BvlhXgibgkxYDcpRiaEzeKXg9dAxFAXQg/132"
                                                             style="display: inline;">
                                                    </a>
                                                </div>
                                                <div class="item-inner">
                                                    <div class="item-title"><a   href="<?= \yii\helpers\Url::toRoute(["/lunbo/showremark", 'gzh_id' => $value['gzh_id'], 'time' => $time, 'type' => $type]) ?>"    class=""><?= $value['gzh_name'] ?></a></div>
                                                    <div class="item-sub-title">kuwoxiaobei</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td> <?= $value['date']; ?>    </td>
                                        <td>
                                            <?php if ($value['type'] == 0) {
                                                echo $value['duokong'] ? '多' : '空';
                                            } else {
                                                echo '∅';
                                            } ?> 
                                        </td>
                                        <td>
                                            <textarea  idnum="<?= $value['id']; ?>"><?= $value['content']; ?>  </textarea>
                                        </td>
                                        <td>
                                            <input value="<?= $value['sort']; ?>"  style="width:50px" class="sort"  idnum="<?= $value['id']; ?>" />   
                                        </td>
                                        <td>
                                            <input value="<?= $value['power']; ?>"  style="width:50px" class="power"  idnum="<?= $value['id']; ?>" />   
                                        </td>
                                        <td>

                                            <a  href="javascript:deleteType(<?= $value['id'] ?>)"  class="btn btn-danger"      title="删除" aria-label="删除" data-pjax="0"><span >删除</span></a>
                                             
                                        </td>
                                    </tr>

<?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/-->
                <!--</div>-->
                <!--/-->
            </div>



        </div>
    </div>
</div>
<!--/main-->

<!-- Dynamic Modal -->
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<div class="modal fade" id="remoteModalAttention" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div id="add_type" class="layer_robot " style="display: none;">
    <form id="form_submit_type"  role="form" class="form-horizontal col-md-10">
        <div class="form-group" style="margin-top: 20px">
            <div class="col-md-3">
                <label>日期</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form_input" id="end_time"  name="date"  value="" placeholder="请选择日期">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label>多空选项</label>
            </div>
            <div class="col-md-9">
                <input type="radio" class="form_input" id="duokong"  name="duokong"  value="1"  >看多
                <input type="radio" class="form_input" id="duokong"  name="duokong"  value="0"  >看空

            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label>内容</label>
            </div>
            <div class="col-md-9">
                <textarea id="pinglun" name="content"> </textarea>

            </div>
        </div>
        <input type="hidden" id="gzh_id" name="gzh_id">
    </form>
</div>
<style>
    textarea {
        border-bottom: none;
        border-top:  none;
        border-left:1px dashed #89a;
        border-right:1px dashed  #89a;
        width: 350px;
        height:100px;
    }
    
    .sort ,.power{
        border: none;
    }    
    
    input{
        text-align:center;
    }
    
</style>
<script src="../js/jquery-2.0.2.min.js"></script>
<script src="../js/layer/layer.js"></script>
<script src="../js/laydate/laydate.js"></script>
<script type="text/javascript">
    
        $('.sort').change(function(){
        $.ajax({
            url:'<?= \yii\helpers\Url::toRoute("/lunbo/editsort") ?>',
            type:'post',
            data:{'sort':$(this).val(),'id':$(this).attr('idnum')},
            success:function (data) {
                data = JSON.parse(data);
                if(data['code'] == 0){
                    //console.log(data['info']);
                    layer.msg(data['info']);
                }else if(data['code'] == 1){
                    layer.msg(data['修改成功']);
                    //                    window.location = data['url'];
                }
            }
        });
                
    }) 
    
         $('.power').change(function(){
        $.ajax({
            url:'<?= \yii\helpers\Url::toRoute("/lunbo/editpower") ?>',
            type:'post',
            data:{'power':$(this).val(),'id':$(this).attr('idnum')},
            success:function (data) {
                data = JSON.parse(data);
                if(data['code'] == 0){
                    //console.log(data['info']);
                    layer.msg(data['info']);
                }else if(data['code'] == 1){
                    layer.msg(data['修改成功']);
                    //                    window.location = data['url'];
                }
            }
        });
                
    })    
    
    function deleteType(user_id){
        layer.confirm('确定删除该评论吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:'<?= Url::toRoute(['/lunbo/del']) ?>',
                type:'post',
                data:{'id':user_id},
                success:function (data) {
                    data = JSON.parse(data);
                    if(data.code == 1){
                        layer.alert("删除成功",{
                            //                                skin: 'layui-layer-molv', //样式类名  自定义样式
                            closeBtn: 1    // 是否显示关闭按钮
                            ,anim: 1 //动画类型
                            ,btn: ['确定'] //按钮
                            ,icon: 6    // icon
                            ,yes:function(){
                                location.reload();
                            }
                        });
                            
                    }else{
                        layer.alert(data.info);
                    }
                }
            });
        });
    }
    
    $('textarea').change(function(){
        $.ajax({
            url:'<?= \yii\helpers\Url::toRoute("/lunbo/editcontent") ?>',
            type:'post',
            data:{'content':$(this).val(),'id':$(this).attr('idnum')},
            success:function (data) {
                data = JSON.parse(data);
                if(data['code'] == 0){
                    //console.log(data['info']);
                    layer.msg(data['info']);
                }else if(data['code'] == 1){
                    layer.msg(data['修改成功']);
                    //                    window.location = data['url'];
                }
            }
        });
                
    })   
    
    
    $('#hehe').click(function(){
        search = $('#start_time').val();
        url = "<?= \yii\helpers\Url::toRoute(["/lunbo/showremark"]) ?>?time="+search+"&type="+$('#remarktype').val();
        window.location.href = url;
                
    })
                        
                        
    function addType(id){
        $("#robottype_type_name").val(id);
        $("#robottype_type_code").val("");
        $("#robottype_type_code").attr("disabled",false);
        layer.open({
            type: 1,
            title: "新增公众号评论",
            closeBtn: 1,
            btn:['确定','取消'],
            area:['450px','280px'],
            content: $("#add_type"),
            yes: function(){
                           
                $.ajax({
                    url:'<?= \yii\helpers\Url::toRoute("/robot-type/typecreate") ?>',
                    type:'post',
                    data:$('#form_submit_type').serialize(),
                    success:function (data) {
                        data = JSON.parse(data);
                        if(data['code'] == 0){
                            //console.log(data['info']);
                            layer.msg(data['info']);
                        }else if(data['code'] == 1){
                            window.location = data['url'];
                        }
                    }
                });
            }
        });
    }

</script>

<script>
    //            $('#start_time').change(function(){
    //                alert(1);
    //                
    //            })
            
            
            
            
    function stopguangzhu (id){
        $.ajax({
            url:'<?= \yii\helpers\Url::toRoute(["stopguangzhu"]) ?>',
            type:'post',
            data:{'id': id },
            success:function (data) {
                data = JSON.parse(data);

                if(data['code'] == 1){

                    window.location.reload();
                }else {
                    layer.msg(data['info']);
                }

            }
        });
    }


    function addType(remark_id){ 
        $("#gzh_id").val(remark_id);
        $("#robottype_type_name").val("");
        $("#robottype_type_code").val("");
        $("#robottype_type_code").attr("disabled",false);
        layer.open({
            type: 1,
            title: "新建评论",
            closeBtn: 1,
            btn:['确定','取消'],
            area:['450px','350px'],
            content: $("#add_type"),
            yes: function(){
 
                $.ajax({
                    url:'<?= \yii\helpers\Url::toRoute(["/lunbo/update"]) ?>',
                    type:'post',
                    data:$('#form_submit_type').serialize(),
                    success:function (data) {
                        data = JSON.parse(data);
                        if(data['code'] == 0){
                            //console.log(data['info']);
                            layer.msg(data['info']);
                        }else if(data['code'] == 1){
                            window.location.href = "<?= \yii\helpers\Url::toRoute(["/lunbo/index"]) ?>";
                        }
                    }
                });
            }
        });
    }
    
    var start = {
        elem: "#start_time",
        //                min: laydate.now(0, "YYYY-MM-DD"),
        format: "YYYY-MM-DD",
        istime: false
    };
    var end = {
        elem: "#end_time",
        min: laydate.now(0, "YYYY-MM-DD"),
        format: "YYYY-MM-DD",
        istime: false
    };
    laydate(start);
    laydate(end);
    
    function hehe(){
        if($('#end_time').val()!=''){
            if($('#start_time').val()<=$('#end_time').val()){
           
                return true;
            }else{
                layer.alert('时间选择有误 : 开始时间大于结束时间!')
                return false;
            }
        }

    }
    
</script>
<!-- /.modal -->



<script src="../js/jquery.growl.js"></script>
<script src="../js/jquery-ui-1.9.2.min.js"></script>

<script src="../js/bootstrap.min.js"></script>