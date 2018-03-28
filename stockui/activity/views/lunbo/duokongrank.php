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

<!--<script src="../js/echarts.min.js"></script>-->
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
<!--/sidebar-->
<!--main-->


<div class="main">



    <div class="main-content">

        <div id="content" style="opacity: 1;">
            <div class="wrapper wrapper-no-gap">


                <div id="main" style="width: 1000px;height:1200px;" >


                </div>
            </div>



        </div>
    </div>
</div>
<!--/main-->
<!--<style type="text/css">
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

</style>-->

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));
    var labelRight = {
        normal: {
            position: 'right',
            color: "black"
        }
    };
    var itemleft = {
        normal: { 
            color:'#A2CD5A'
        }
    };


    option = {
        title: {
            text: '多空力量排行',
            subtext: 'From ExcelHome',
            sublink: 'http://e.weibo.com/1341556070/AjwF2AgQm'
        },
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            top: 80,
            bottom: 30
        },
        xAxis: {
            type : 'value',
            position: 'top',
            splitLine: {lineStyle:{type:'dashed'}},
        },
        yAxis: {
            type : 'category',
            axisLine: {show: false},
            axisLabel: {show: false},
            axisTick: {show: false},
            splitLine: {show: false},
            data : [
               <?php
                        $str='';
                        foreach ($list as $key => $value) {
                            $str.= "'".$value['content'] ."'". ',';
                        }
                        echo trim( $str,',') ;
                        ?>
                
                
//                'ten', 'nine', 'eight', 'seven', 'six', 'five', 'four', 'three', 'two', 'one'
            ]
        },
        series : [
            {
             
            
                name:'多空力量',
                type:'bar',
                stack: '总量',
                // itemStyle : {
                //      borderColor:'black',
                //      color:'black'
             
                //  },
            
                label: {
                   
                    normal: {
                        show: true,
             
                        formatter: '{b}'
                    }
                },
                data:[
                    <?php
                  
                        foreach ($list  as $key => $value) {?>
                            {value: <?= $value['value'] ?>,<?php  if($value['value']<0){ echo 'itemStyle : itemleft';} ?> },

                       <?php } ?>
                    
                    
//                    {value: -0.07, itemStyle : itemleft },
//                    {value: -0.09, label: labelRight},
//                    {value: 0.2,  itemStyle : itemleft},
//                    {value:  0.44,  itemStyle : itemleft},
//                    {value: -0.23   },
//                    0.08,
//                    {value: -0.17, label: labelRight},
//                    0.47,
//                    {value: -0.36, label: labelRight},
//                    0.18
                ]
            }
        ]
    };
    myChart.setOption(option);
 
 
  
 
</script>



