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

<link type="text/css" rel="stylesheet" href="../style/jsmind.css" />
<script type="text/javascript" src="../js/jsmind.js"></script>
<script type="text/javascript" src="../js/jsmind.draggable.js"></script>
<!--/sidebar-->
<!--main-->


<div class="main">



    <div class="main-content">

        <div id="content" style="opacity: 1;">
            <div class="wrapper wrapper-no-gap">


                <div id="jsmind_container"  >


                </div>
            </div>



        </div>
    </div>
</div>
<!--/main-->
<style type="text/css">
    li{margin-top:2px; margin-bottom:2px;}
    button{width:140px;}
    select{width:140px;}
    #layout{width:1230px;}
    #jsmind_nav{width:210px;height:600px;border:solid 1px #ccc;overflow:auto;float:left;}
    .file_input{width:100px;}
    button.sub{width:100px;}

    #jsmind_container{
        float:left;
        width:1000px;
        height:600px;
        border:solid 1px #ccc;
        background:#f4f4f4;
    }

    jmnode[nodeid="open"]{
        background-color:red!important;
    }

</style>

<script type="text/javascript">
    //    var mind = {
    //        /* 元数据，定义思维导图的名称、作者、版本等信息 */
    //        "meta":{
    //            "name":"jsMind-demo-tree",
    //            "author":"hizzgdev@163.com",
    //            "version":"0.2"
    //        },
    //        /* 数据格式声明 */
    //        "format":"node_tree",
    //        /* 数据内容 */
    //        "data":{"id":"root","topic":"jsMind","children":[
    //                {"id":"easy","topic":"Easy","direction":"left","expanded":false,"children":[
    //                        {"id":"easy1","topic":"Easy to show"},
    //                        {"id":"easy2","topic":"Easy to edit"},
    //                        {"id":"easy3","topic":"Easy to store"},
    //                        {"id":"easy4","topic":"Easy to embed"}
    //                    ]},
    //                {"id":"open","topic":"Open Source","direction":"right","expanded":true,"children":[
    //                        {"id":"open1","topic":"on GitHub"},
    //                        {"id":"open2","topic":"BSD License"}
    //                    ]},
    //                {"id":"powerful","topic":"Powerful","direction":"right","children":[
    //                        {"id":"powerful1","topic":"Base on Javascript"},
    //                        {"id":"powerful2","topic":"Base on HTML5"},
    //                        {"id":"powerful3","topic":"Depends on you"}
    //                    ]},
    //                {"id":"other","topic":"test node","direction":"left","children":[
    //                        {"id":"other1","topic":"I'm from local variable"},
    //                        {"id":"other2","topic":"I can do everything"}
    //                    ]}
    //            ]}
    //    };
 
    var mind = {
        /* 元数据，定义思维导图的名称、作者、版本等信息 */
        "meta":{
            "name":"example",
            "author":"hizzgdev@163.com",
            "version":"0.2"
        },
        /* 数据格式声明 */
        "format":"node_array",
        /* 数据内容 */
        "data":[
            {"id":"root", "isroot":true, "topic":"jsMind"},

            {"id":"easy", "parentid":"root", "topic":"Easy", "direction":"left"},
            {"id":"easy1", "parentid":"easy", "topic":"Easy to show"},
            {"id":"easy2", "parentid":"easy", "topic":"Easy to edit"},
            {"id":"easy3", "parentid":"easy", "topic":"Easy to store"},
            {"id":"easy4", "parentid":"easy", "topic":"Easy to embed"},

            {"id":"open", "parentid":"root", "topic":"Open Source", "expanded":false, "direction":"right"},
            {"id":"open1", "parentid":"open", "topic":"on GitHub"},
            {"id":"open2", "parentid":"open", "topic":"BSD License"},

            {"id":"powerful", "parentid":"root", "topic":"Powerful", "direction":"right"},
            {"id":"powerful1", "parentid":"powerful", "topic":"Base on Javascript"},
            {"id":"powerful2", "parentid":"powerful", "topic":"Base on HTML5"},
            {"id":"powerful3", "parentid":"powerful", "topic":"Depends on you"},
        ]
    };


    var options = {
        container:'jsmind_container',
        editable:true,
        theme:'info'
    };

    var jm = new jsMind(options);
    // 让 jm 显示这个 mind 即可
    jm.show(mind); 
 
</script>



