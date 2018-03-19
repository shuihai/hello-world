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
                </div>
                <hr/>
                <div class="speech_QA">
                    <div class="q_a">
                        <div class="q_a_left q_a_build">
                            <input type="hidden" id="voice_id" value="<?= Html::encode($voice_id) ?>"/>
                            <div>
                                <i>Q:　</i>
                                <div class="question">
                                    <?php
                                    if ($voice_id > 0) {
                                        foreach ($voice_question as $key => $value) {
                                            ?>
                                            <p>
                                                <input type="text" id="" class="question_q" maxlength="30"
                                                       placeholder="请输入30字以内的问句"
                                                       value="<?= Html::encode($value['question']) ?>"
                                                       q_num="<?= Html::encode($value['id']) ?>"/>
                                                <i class="delImg"></i>
                                            </p>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p>
                                            <input type="text" id="" class="question_q" maxlength="30"
                                                   placeholder="请输入30字以内的问句"/>
                                            <i class="delImg"></i>
                                        </p>
                                    <?php } ?>

                                </div>
                                <button class="addNewquestion">添加新问题</button>
                            </div>
                            <div>
                                <i>A:　</i>
                                <div class="answer">
                                    <?php
                                    if ($voice_id > 0) {
                                        foreach ($voice_answer as $key => $value) {
                                            ?>
                                            <p>
                                                <input type="text" id="" class="answer_a" maxlength="30"
                                                       placeholder="请输入30字以内的答句"
                                                       value="<?= Html::encode($value['answer']) ?>"
                                                       q_num="<?= Html::encode($value['id']) ?>"/>
                                                <i class="delImg"></i>
                                            </p>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p>
                                            <input type="text" id="" class="answer_a" maxlength="30"
                                                   placeholder="请输入30字以内的答句"/>
                                            <i class="delImg"></i>
                                        </p>
                                    <?php } ?>

                                </div>


                                <button class="addNewanswer">添加新答案</button>
                            </div>
                        </div>
                    </div>
                    <div class="build_btn">
                        <a href="javascript:;" onClick="javascript :history.back(-1);" class="cancel">取消</a>
                        <a href="javascript:;" class="save">保存</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/jq1.11.2.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/index.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    window.q_num = 99999
    window.a_num = 99999
    $(document).on("click", ".addNewquestion", function () {
        window.q_num++
        var op = '<p>' +
            '<input type="text" class="question_q" maxlength="30" placeholder="请输入30字以内的问句" q_num="' + window.q_num + '"/>' +
            '<i class="delImg"></i>' +
            '</p>';
        if ($(this).siblings(".question").children("p:last").find("input").val() == "") {
            layer.msg("请先完成当前问题再添加新问题");
            return false;
        }

        //其他验证
        question_flag = 0;
        $('.question_q').each(function (index) {
            if ($.trim($(this).val()) == "") {
                question_flag = 1;
            }

        })
        if (question_flag == 1) {
            layer.msg("请先完成之前问题再添加新问题");
            return false;
        }

        $(".question").append(op);
    })

    $(document).on("click", ".addNewanswer", function () {
        window.a_num++;
        var op = '<p>' +
            '<input type="text" class="answer_a" maxlength="30" placeholder="请输入30字以内的答句" a_num="' + window.a_num + '"/>' +
            '<i class="delImg"></i>' +
            '</p>';
        if ($(this).siblings(".answer").children("p:last").find("input").val() == "") {
            layer.msg("请先完成当前答案再添加新答案");
            return false;
        }

        //其他验证
        answer_flag = 0;
        $('.answer_a').each(function (index) {
            if ($.trim($(this).val()) == "") {
                answer_flag = 1;
            }

        })
        if (answer_flag == 1) {
            layer.msg("请先完成之前答案再添加新答案");
            return false;
        }


        $(".answer").append(op);
    })
    $(document).on("click", ".question .delImg", function () {
        if ($(".question>p").length == 1) {
            layer.msg("最少保留一个问题");
            return false;
        } else {
            $(this).parent("p").remove();
        }
    })
    $(document).on("click", ".answer .delImg", function () {
        if ($(".answer>p").length == 1) {
            layer.msg("最少保留一个答案");
            return false;
        } else {
            $(this).parent("p").remove();
        }
    })


    function arrRepeat(arr) {
        var hash = {};
        for (var i in arr) {
            if (hash[arr[i]])
                return true;
            hash[arr[i]] = true;
        }
        return false;

    }

    //保存
    $(".save").click(function () {
        //问题相关
        a = [];
        question_list = [];
        answer_list = [];
        window.saveflag = true;
        $('.question_q').each(function (index) {
            q_num = index //$(this).attr('q_num') ;
            question = $(this).val();
            a[index] = {'q_num': q_num, 'question': question}
            question_list[index] = question;

        });

        $('.question_q').each(function (index) {
            if ($.trim($(this).val()) == "") {
                layer.msg("请先完成问题再保存");
                window.saveflag = false;
                return;
            }

        })
        //        a=[1,2]

        if (arrRepeat(question_list)) {
            console.log(arrRepeat(question_list))
            console.log(question_list)
            layer.msg("问题出现重复");
            window.saveflag = false;
            return;
        }
        ;

        //答案相关
        b = [];
        window.saveflag = true;
        $('.answer_a').each(function (index) {
            a_num = index //$(this).attr('a_num') ;
            answer = $(this).val();
            b[index] = {'a_num': a_num, 'answer': answer}
            answer_list[index] = answer;

        });

        $('.answer_a').each(function (index) {
            if ($.trim($(this).val()) == "") {
                layer.msg("请先完成答案再保存");
                window.saveflag = false;
                return;
            }

        })

        if (arrRepeat(answer_list)) {
            console.log(arrRepeat(answer_list))
            console.log(answer_list)
            layer.msg("答案出现重复");
            window.saveflag = false;
            return;
        }
        ;


        if (window.saveflag == false) {

            return;
        }


        $.ajax({
            url: '<?= \yii\helpers\Url::toRoute(["add"]) ?>',
            type: 'post',
            data: {'data1': a, 'data2': b, 'voice_id': $('#voice_id').val()},
            success: function (data) {
                data = JSON.parse(data);

                if (data['code'] == 1) {
                    //   window.location.href = data['data'];

                    window.location.href = '<?= \yii\helpers\Url::toRoute(["/speech/index"]) ?>';
                } else {
                    layer.msg(data['info']);
                }
                //                    if(data['code'] == 1){
                //                        layer.msg("保存成功");
                //                        window.time=1
                //                        setInterval( changeTime( window.time), 1000);
                //                    }else {
                //                        layer.msg("保存失败");
                //                    }
            }
        });

        //        $(".wait_ul li .wait_span_del").remove();

    })


</script>