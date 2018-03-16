<?php

namespace activity\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

class SpeechController extends CommonController {

    /**
     * @inheritdoc
     */
    public function init() {
        $this->enableCsrfValidation = false;
    }

    /**
     * 设置主页
     */
    public function actionIndex() {
        $session = \Yii::$app->session;
        $user_info = Yii::$app->user->identity;
        $user_id = $user_info['user_id'];
        $robot_id =$session->get('robot_id' );
  
        
 


        $list = [];
        $voice = Yii::$app->db->createCommand('SELECT * FROM voice  where user_id=:user_id  and robot_id=:robot_id  and status=1 order by id')
                ->bindValues([':user_id' => $user_id, ':robot_id' => $robot_id])
                ->queryAll();

        foreach ($voice as $key => $value) {
            $voice_answer = Yii::$app->db->createCommand('SELECT * FROM voice_answer where voice_id=:voice_id  and status=1 order by id')
                    ->bindValues([':voice_id' => $value['id']])
                    ->queryAll();
            $voice_question = Yii::$app->db->createCommand('SELECT * FROM voice_question where voice_id=:voice_id  and status=1 order by id')
                    ->bindValues([':voice_id' => $value['id']])
                    ->queryAll();
            $value['voice_answer'] = $voice_answer;
            $value['voice_question'] = $voice_question;
            $list[] = $value;
        }
//        var_dump($list);die;

        return $this->render('index', ['list' => $list,'user_id' => $user_id,'robot_id' => $robot_id]);
    }

    /**
     * 编辑页
     */
    public function actionBuild() {
        $session = \Yii::$app->session;


        if ( Yii::$app->request->get('voice_id') ) {
            $voice_id = Yii::$app->request->get('voice_id');

            $voice_answer = Yii::$app->db->createCommand('SELECT * FROM voice_answer where voice_id=:voice_id  and status=1 order by id')
                    ->bindValues([':voice_id' => $voice_id])
                    ->queryAll();
            $voice_question = Yii::$app->db->createCommand('SELECT * FROM voice_question where voice_id=:voice_id  and status=1 order by id')
                    ->bindValues([':voice_id' => $voice_id])
                    ->queryAll();

            return $this->render('build', ['voice_id' => $voice_id, 'voice_question' => $voice_question, 'voice_answer' => $voice_answer]);
        } else {
            $voice_id = 0;
            return $this->render('build', ['voice_id' => $voice_id]);
        }
    }

    /**
     * 添加对话
     */
    public function actionDelete() {
        $session = \Yii::$app->session;
        $user_info = Yii::$app->user->identity;
        $user_id = $user_info['user_id'];
        $robot_id = Yii::$app->request->post('robot_id');
 
        
        
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        if ((Yii::$app->request->post('voice_id'))) {
            
            $res = $connection->createCommand('update `voice` set `status`=0 where `id` = :id and `status`=1')
                    ->bindValues([':id' => Yii::$app->request->post('voice_id')])
                    ->execute();
            $res1 =$connection->createCommand('update `voice_answer` set `status`=0 where `voice_id` = :id and `status`=1')
                    ->bindValues([':id' => Yii::$app->request->post('voice_id')])
                    ->execute();
            $res2 =$connection->createCommand('update `voice_question` set `status`=0 where `voice_id` = :id and `status`=1')
                    ->bindValues([':id' => Yii::$app->request->post('voice_id')])
                    ->execute();
            
            if ($res  &&$res1 &&$res2) {
                $transaction->commit();
                return Json::encode(['code' => 1, 'info' => '成功']);
            }else{
                $transaction->rollBack();
                return Json::encode(['code' => 0, 'info' => '操作失败']);
            }
        } elseif (Yii::$app->request->post('user_id') && Yii::$app->request->post('robot_id')) {

            $res =$connection->createCommand('update `voice` set `status`=0 where `user_id` = :user_id and `robot_id` = :robot_id ')
                    ->bindValues([':user_id' => Yii::$app->request->post('user_id'),':robot_id' => Yii::$app->request->post('robot_id')])
                    ->execute();
            
            if ($res) {
                $transaction->commit();
                return Json::encode(['code' => 1, 'info' => '成功']);
            }else{
                $transaction->rollBack();
                return Json::encode(['code' => 0, 'info' => '操作失败']);
            }
        }
    }

    /**
     * 添加对话
     */
    public function actionAdd() {
        $session = \Yii::$app->session;
        $voice_id = Yii::$app->request->post('voice_id');
        $user_info = Yii::$app->user->identity;
        $user_id = $user_info['user_id'];
        $robot_id =$session->get('robot_id' );
 
 
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $flag_all = TRUE;
        $question_data = Yii::$app->request->post('data1');
        $question_data = $this->arraySortByKey($question_data, 'q_num');

        $answer_data = Yii::$app->request->post('data2');
        $answer_data = $this->arraySortByKey($answer_data, 'a_num');


        //voice_id不存在的情况
        if (!$voice_id) {
            $flag0 = $connection->createCommand()->insert('voice', [
                        'status' => 1,
                        'create_time' => time(),
                        'robot_id' => $robot_id,
                        'user_id' => $user_id
                    ])->execute();
            $voice_id = $connection->getLastInsertID();
        } else {//voice_id已经存在的情况
            //把之前问题置为删除状态
            $flag2 = Yii::$app->db->createCommand('UPDATE voice_question SET status=0  WHERE voice_id=:voice_id')
                    ->bindValues([':voice_id' => $voice_id])
                    ->execute();

            if (!$flag2) {
                $flag_all = FALSE;
            }
            //把之前答案置为删除状态
            $flag3 = Yii::$app->db->createCommand('UPDATE voice_answer SET status=0  WHERE voice_id=:voice_id')
                    ->bindValues([':voice_id' => $voice_id])
                    ->execute();
            if (!$flag3) {
                $flag_all = FALSE;
            }
        }

        //先判断问题有没有重复的
        foreach ($question_data as $key => $value) {
            $existed_question = Yii::$app->db->createCommand('SELECT * FROM voice_question WHERE question=:question and  voice_id<>:voice_id and status=1 and `user_id` = :user_id and `robot_id` = :robot_id ')
                    ->bindValues([':question' => $value['question'], ':voice_id' => $voice_id,':user_id' => $user_id,':robot_id' =>$robot_id])
                    ->queryOne();
            if ($existed_question) {
                return Json::encode(['code' => 0, 'info' => '问题已经存在']);
            }
        }




        //插入问题
        foreach ($question_data as $key => $value) {
            $flag1 = $connection->createCommand()->insert('voice_question', [
                        'status' => 1,
                        'question' => $value['question'],
                        'voice_id' => $voice_id,
                        'robot_id' => $robot_id,
                        'user_id' => $user_id
                    ])->execute();
            if (!$flag1) {
                $flag_all = FALSE;
            }
        }


        //插入答案
        foreach ($answer_data as $key => $value) {
            $flag1 = $connection->createCommand()->insert('voice_answer', [
                        'status' => 1,
                        'answer' => $value['answer'],
                        'voice_id' => $voice_id,
                        'robot_id' => $robot_id,
                        'user_id' => $user_id
                    ])->execute();
            if (!$flag1) {
                $flag_all = FALSE;
            }
        }


        if ($flag_all) {
            $transaction->commit();
            return Json::encode(['code' => 1, 'info' => '成功']);
        } else {
            $transaction->rollBack();
            return Json::encode(['code' => 0, 'info' => '操作失败']);
        }
    }

    function arraySortByKey($array, $key, $asc = true) {
        $result = array();
        // 整理出准备排序的数组
        foreach ($array as $k => &$v) {
            $values[$k] = isset($v[$key]) ? $v[$key] : '';
        }
        unset($v);
        // 对需要排序键值进行排序
        $asc ? asort($values) : arsort($values);
        // 重新排列原有数组
        foreach ($values as $k => $v) {
            $result[$k] = $array[$k];
        }

        return $result;
    }

}
