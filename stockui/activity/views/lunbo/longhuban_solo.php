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

                <div class="pull-right">
                
                        <h3>三日内最高幅度  <?= $up_decimal*100 . '%'; ?>  </h3>
                        <h3>大于10%的概率  <?= $up_probability*100 . '%'; ?>  </h3>

              

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
                                <col width="100">
                                <col width="100"> 
                                <col width="300">
                                <col width="100">
                                <col width="100">
                               <col width="100">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>序号</th>
                                    <th>名称</th>
                                    <th class="">代码</th>
                                    <th class="">营业部</th>
                                    <th class="">up1</th>
                                    <th class="">up2</th>
                                    <th>up3</th>
                                    <th >三日内收盘最大涨幅  </th>
                                    <th >是否大于10%  </th>

                                </tr>
                            </thead>
                            <tbody id="rankBody">


                                <?php foreach ($list as $key => $value) { ?>

                                    <tr>
                                        <td>
                                            <span class="table-rank table-rank1 "><?= $key + 1 ?></span>
                                        </td>
                                        <td>  <?= $value['longhu_stock_code']; ?>   </td>
                                        <td> <?= $value['longhu_stock_code']; ?>    </td>
                                        <td> <?= $value['yyb_name']; ?>    </td>
                                        <td>
                                            <?= $value['up1']; ?>  
                                        </td>
                                        <td><?= $value['up2']; ?>   </td>
                                        <td> <?= $value['up3']; ?>     </td>
                                        <td>    <?= $value['max']; ?>  </td>
                                        <td>    <?= $value['bigerthan10']; ?>  </td>
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
<script src="http://zs.xiguaji.com/Content/js/jquery-2.0.2.min.js"></script>
<script src="../js/layer/layer.js"></script>
<script src="../js/laydate/laydate.js"></script>
<script type="text/javascript">
    
    $('#hehe').click(function(){
        search = $('#start_time').val();
        url = "<?= \yii\helpers\Url::toRoute(["/lunbo/longhuban"]) ?>?time="+search+"&type="+$('#remarktype').val();
        window.location.href = url;
                
    })
 

</script>

<script>
    
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


