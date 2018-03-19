<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>


<html>
<head>
    <meta content="webkit" name="renderer">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>热门公众号榜单</title>
    <link rel="dns-prefetch" href="//bizcdn2.xiguaji.com/">
    <link href="http://zs.xiguaji.com/Content/css/bootstrap.min.css?newv=0314" rel="stylesheet">
    <link rel="stylesheet" href="http://zs.xiguaji.com/Content/css/font-awesome.min.css?newv=0314">
    <link rel="stylesheet" type="text/css" href="http://zs.xiguaji.com/Content/css/iconfont.css?newv=03141">
    <link href="http://zs.xiguaji.com/Content/css/select2.css?newv=0314" rel="stylesheet">
    <link href="http://zs.xiguaji.com/Content/css/animate.css?newv=0314" rel="stylesheet">
    <link href="http://zs.xiguaji.com/Content/css/jquery.growl.css?newv=0314" rel="stylesheet">
    <link href="http://zs.xiguaji.com/Content/js/plugin/malihu-custom-scrollbar/jquery.mCustomScrollbar.css?newv=0314"
          rel="stylesheet">
    <!--[if lt IE 8]>
    <link href="~/Content/css/bootstrap-ie7.css" rel="stylesheet">
    <![endif]-->
    <link href="http://zs.xiguaji.com/Content/css/xiguaji.css?newv=636568035657557626" rel="stylesheet">
    <link href="http://zs.xiguaji.com/Content/css/xiguaji-controls.css?newv=0314" rel="stylesheet">
    <link href="http://zs.xiguaji.com/Content/css/bootstrap-switch.css?newv=0314" rel="stylesheet">
    <link href="http://zs.xiguaji.com/Content/css/bootstrap-daterangepicker.css?newv=0314" rel="stylesheet">
    <script src="http://zs.xiguaji.com/Content/js/respond.min.js?newv=0314"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body class="body-w" style="overflow-y: visible;">
<!--sidebar-->
<div class="sidebar">
    <div class="brand">
        <div class="brand-logo"><a href="http://www.xiguaji.com">小明自用平台</a></div>
    </div>
    <nav class="mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;">
        <div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;"
             tabindex="0">
            <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y"
                 style="position:relative; top:0; left:0;" dir="ltr">
                <ul style="">







                    <li id="toolBox" class="open active">
                        <a href="#" title="工具箱"><i class="iconfont icon-gaojigongneng"></i> <span
                                    class="menu-item-parent">工具箱</span><b class="collapse-sign"><em
                                        class="fa fa-angle-up fa-right fa-up"></em></b></a>

                    </li>


                    <li><a href="http://www.xiguaji.com/Knowledge" title="帮助中心" target="_blank"><i
                                    class="iconfont icon-bangzhu"></i> <span class="menu-item-parent">帮助中心</span></a>
                    </li>

                </ul>
            </div>
        </div>
        <div id="mCSB_1_scrollbar_vertical"
             class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: none;">
            <div class="mCSB_draggerContainer">
                <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                     style="position: absolute; min-height: 50px; height: 0px; top: 0px;">
                    <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                </div>
                <div class="mCSB_draggerRail"></div>
            </div>
        </div>
    </nav>


    <div class="side-brand">
        <div class="side-info">
            <a href="#" id="topbar_message">
                <i class="iconfont icon-tongzhi"></i>
                <i id="topbar_message_count" class="fa fa-circle ico-new-msg" style="display:none;"></i> 消息
                <em class="notification" style=" display:none;"></em>
            </a>
            <a href="#" id="topbar_talk"><i class="iconfont icon-kefu16px"></i> 客服</a>
        </div>
        <div class="side-user-area">
            <div class="pull-left user-area">
                <div class="pull-left icon-user">

                    <img src="http://thirdwx.qlogo.cn/mmopen/Q3auHgzwzM4NGEndWFTMNgM8E5rMicItrr3ia7JlS4giciajr8uyrCZ4ALPWF8funPd82aaFj8ywbMD0BvlhXgibgkxYDcpRiaEzeKXg9dAxFAXQg/132">


                </div>
                <span class="try-version">试用版</span>


                <div class="user-info">
                    <a href="#/Home/MemberInfo" data-toggle="tooltip" data-placement="top" data-original-title="个人中心">徐小明</a>
                    <span class="user-id">ID:00276011</span>
                </div>

            </div>
            <a id="btn-logout" class="pull-right btns-exit" href="/Login/Logout" data-logout-msg="确认是否要退出？"
               data-toggle="tooltip" data-placement="top" data-original-title="注销">
                <!--<i class="fa fa-power-off" aria-hidden="true"></i>-->
                <i class="iconfont icon-tuichu"></i>
            </a>
        </div>
    </div>


    <div class="message-panel" id="message-panel">
        <div class="message-panel-head">系统消息</div>
        <div class="message-loading"><i class="fa fa-spinner fa-spin"></i><span class="sr-only">Loading...</span></div>

    </div>


    <div class="message-panel customer-service" id="talk-panel" style="display:none;">
        <div class="message-panel-head">客服中心</div>
        <div class="customer-service-main">
            <h6>微信咨询</h6>
            <div class="service-code">
                <img src="/Content/images/qr-code.jpg">
                <p><span class="sweep-code">扫一扫，联系微信客服</span></p>
            </div>

            <div class="customer-media">
                <h6>QQ客服</h6>
                <div class="customer-name">
                    <div class="customer-qqnumber">小葵 2880446370</div>
                    <a href="tencent://message/?uin=2880446370&amp;Site=&amp;Menu=yes" class="btns-conversation">交谈</a>
                </div>
            </div>
        </div>
    </div>

</div>
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
                        <a id="btnPreDay" href="javascript:void(0);" class="select-nav select-nav-left"><i
                                    class="fa fa-caret-left"></i></a>
                        <select id="selDateCode" class="time-select select2-hidden-accessible" data-select=""
                                style="width:180px" tabindex="-1" aria-hidden="true">
                            <option selected="selected" value="20180315">03月15日公众号榜单</option>
                            <option value="20180314">03月14日公众号榜单</option>
                            <option value="20180313">03月13日公众号榜单</option>
                            <option value="20180312">03月12日公众号榜单</option>
                            <option value="20180311">03月11日公众号榜单</option>
                            <option value="20180310">03月10日公众号榜单</option>
                            <option value="20180309">03月09日公众号榜单</option>
                            <option value="20180308">03月08日公众号榜单</option>
                            <option value="20180307">03月07日公众号榜单</option>
                            <option value="20180306">03月06日公众号榜单</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                       style="width: 180px;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0"
                                        aria-labelledby="select2-selDateCode-container"><span
                                            class="select2-selection__rendered" id="select2-selDateCode-container"
                                            title="03月15日公众号榜单">03月15日公众号榜单</span><span class="select2-selection__arrow"
                                                                                        role="presentation"><b
                                                role="presentation"></b><i
                                                class="fa fa-angle-down"></i></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        <a id="btnNextDay" href="javascript:void(0);" class="select-nav select-nav-right"><i
                                    class="fa fa-caret-right"></i></a>
                    </div>

                </div>

                <!---->
                <div class="popular-public-list">
                    <!---->
                    <div class="wrapper-col-left">
                        <div class="mp-classify-title">分类</div>
                        <div class="mp-classify-list">
                            <ul>
                                <li class="active"><a href="javascript:void(0);" data-tagid="35">情感励志</a></li>
                                <li class=""><a href="javascript:void(0);" data-tagid="27">搞笑趣闻</a></li>
                                <li><a href="javascript:void(0);" data-tagid="31">影音娱乐</a></li>
                                <li><a href="javascript:void(0);" data-tagid="97">旅游</a></li>

                            </ul>
                        </div>
                    </div>
                    <!--/-->
                    <!---->
                    <div class="wrapper-col-right">
                        <div class="mp-account-list">
                            <table class="table">
                                <colgroup>
                                    <col width="100">
                                    <col>
                                    <col width="120">
                                    <col width="120">
                                    <col width="120">
                                    <col width="120">
                                    <col width="120">
                                    <col width="140">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>排行</th>
                                    <th class="text-left">公众号</th>
                                    <th>预估粉丝 <i class="fa fa-info-circle icon-info" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="根据公众号历史7天的阅读点赞数据进行活跃粉丝的预估"></i></th>
                                    <th>首小时阅读 <i class="fa fa-info-circle icon-info" data-toggle="tooltip"
                                                 data-placement="top"
                                                 data-original-title="根据公众号发文后第一个小时收获到的阅读数进行排名，可以更加有效的反应出公众号的当天文章真实表现"></i>
                                    </th>
                                    <th>24小时阅读</th>
                                    <th>24小时点赞</th>
                                    <th>文章数</th>
                                    <th>关注</th>
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
                                                    <div class="item-title"><a
                                                                href="<?= \yii\helpers\Url::toRoute(["/lunbo/showgzh", 'gzh_name' => $value['gzh_name']]) ?>"
                                                                class=""><?= $value['gzh_name'] ?></a></div>
                                                    <div class="item-sub-title">kuwoxiaobei</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            191万
                                        </td>
                                        <td>80000</td>
                                        <td>100000+</td>
                                        <td>7456</td>
                                        <td><a class="btn btn-success pull-right" href="#" onclick="addType();">新建评论</a>  </td>
                                        <td>
                                            <a data-bizid="1546113" class="btn btn-success"
                                                onclick="stopguangzhu(<?= $value['id'] ?>);">  停止关注</a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/-->
                </div>
                <!--/-->
            </div>


            <script type="text/javascript">


            </script>
        </div>
    </div>
</div>
<!--/main-->
<div id="loadingLayer" class="corporate-account-layer" style="display: none;">
    <div class="loading-page">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span>正在加载中...</span>
    </div>
</div>
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
                <label>类型名称</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="RobotType[type_name]" id="robottype_type_name"  class="form-control" placeholder="请输入类型名称"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label>类型编号</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="RobotType[type_code]" id="robottype_type_code"  class="form-control" maxlength="2"  placeholder="请输入编号"/>
            </div>
        </div>
        <input type="hidden" id="robottype_type_id" name="RobotType[type_id]">
    </form>
</div>
<script src="http://zs.xiguaji.com/Content/js/jquery-2.0.2.min.js"></script>
<script src="./js/layer/layer.js"></script>
<script>
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


    function addType(){
        $("#robottype_type_name").val("");
        $("#robottype_type_code").val("");
        $("#robottype_type_code").attr("disabled",false);
        layer.open({
            type: 1,
            title: "新增类型",
            closeBtn: 1,
            btn:['确定','取消'],
            area:['450px','280px'],
            content: $("#add_type"),
            yes: function(){
                var re = new RegExp(/^[a-zA-Z0-9]{2}$/);
                if(!re.test($("#robottype_type_code").val())){
                    layer.msg("类型编号格式错误，必须为00-99,aa-zz");
                    return false;
                }
                $.ajax({
                    url:'/robot-type/typecreate',
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
<!-- /.modal -->



<script src="http://zs.xiguaji.com/Content/js/plugin/notify/jquery.growl.js"></script>
<script src="http://zs.xiguaji.com/Content/js/jquery-ui-1.9.2.min.js"></script>

<script src="http://zs.xiguaji.com/Content/js/bootstrap.min.js"></script>
<!--<script src="http://zs.xiguaji.com/Content/js/select2.min.js"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/lazyload/jquery.lazyload.js"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/jquery-validate/jquery.validate.min.js"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/icheck.min.js"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/easypiechart.js"></script>-->
<!--[if lt IE 9]>
<!--<script type="text/javascript" src="/Content/js/plugin/tagcanvas/excanvas.js?newv=1201"></script><![endif]-->-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/tagcanvas/tagcanvas.min.js?newv=1201"-->
<!--        type="text/javascript"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/highcharts.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/msie-fix/jquery.mb.browser.min.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/notify/smartmessagebox.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/malihu-custom-scrollbar/jquery.mCustomScrollbar.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/bootstrap-switch.js?newv=1201"></script>-->
<!--<script src="/Content/js/xiguaji-extend-plugin.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/bootstrap-timepicker/moment.js?newv=1201"></script>-->
<!--<script src="/http://zs.xiguaji.comContent/js/plugin/bootstrap-timepicker/bootstrap-daterangepicker.js?newv=1201"></script>-->
<!--<script src="/Content/js/xiguaji.js?v=636568035657557626"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/jquery.more.js?newv=1201"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/ue/ueditor.config.js?v=20180316"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/ue/ueditor.all.min.js?v=20180316"></script>-->
<!--<script src="http://zs.xiguaji.com/Content/js/plugin/ue/zh-cn.js?v=20180316"></script>-->
<!---->
<!--<script type="text/javascript">-->
<!--    document.domain = 'xiguaji.com';-->
<!--</script>-->
<!---->
<!---->
<!--<script type="text/javascript" src="/Content/js/icheck.min.js"></script>-->
<!--<script type="text/javascript" src="/content/js/jquery.masonry.min.js"></script>-->
<!--<script type="text/javascript" src="/Content/js/jquery.tmpl.min.js"></script>-->
<!--<script type="text/javascript" src="/content/js/highcharts.js"></script>-->
</body>
</html>