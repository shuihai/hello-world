<?php

namespace activity\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

class LunboController extends CommonController {

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
        $this->layout=FALSE;
        $session = \Yii::$app->session;
        $user_info = Yii::$app->user->identity;
        $user_id = $user_info['user_id'];
        if (Yii::$app->request->get('robot_id')) {
            $session->set('robot_id', Yii::$app->request->get('robot_id'));
        }
        
        if (!$session->get('robot_id')) {
            $session->set('robot_id', Yii::$app->request->get('robot_id'));
        }
        $robot_id = $session->get('robot_id');

        $list = [];
        $list = Yii::$app->db->createCommand('SELECT * FROM home_image  where user_id=:user_id  and robot_id=:robot_id  and status=1 order by id')
                ->bindValues([':user_id' => $user_id, ':robot_id' => $robot_id])
                ->queryAll();
 

        return $this->render('index', ['list' => $list, 'user_id' => $user_id, 'robot_id' => $robot_id]);
    }

    public function actionAdd() {
        $session = \Yii::$app->session;
        $user_info = \Yii::$app->user->identity;
        $user_id = $user_info['user_id'];
        $robot_id = $session->get('robot_id');
        $post = Yii::$app->request->post();
         
   
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        //删除原来
        $flag0 = $connection->createCommand('SELECT * FROM home_image WHERE user_id=:user_id and robot_id=:robot_id and status=1')
                ->bindValues([':user_id' => $user_id, ':robot_id' => $robot_id])
                ->queryScalar('id');

        if ($flag0) {

            $flag1 = $connection->createCommand('delete from home_image WHERE user_id=:user_id and robot_id=:robot_id')
                    ->bindValues([':user_id' => $user_id, ':robot_id' => $robot_id])
                    ->execute();
        } else {
            $flag1 = 1;
        }

        $flag2 = 1;

        if (isset($post['img'])) {
            foreach ($post['img'] as $key => $value) {

                $flag3 = $connection->createCommand()->insert('home_image', [
                            'sort' => $key,
                            'image' => $value,
                            'thumbnail' => substr($value,0, strpos($value, '.')) . 'small' . substr($value,strpos($value, '.') ),
                            'status' => 1,
                            'robot_id' => $robot_id,
                            'user_id' => $user_id,
                        ])->execute();


                if (!$flag3) {
                    $flag2 = 0;
                }
            }

            if ($flag1 && $flag2) {
                $transaction->commit();
                return Json::encode(['code' => '1', 'info' => '添加成功']);
            } else {
                $transaction->rollBack();
                return Json::encode(['code' => 0, 'info' => '新增失败']);
            }
        } else {
            if ($flag1) {
                $transaction->commit();
                return Json::encode(['code' => '1', 'info' => '添加成功']);
            } else {
                $transaction->rollBack();
                return Json::encode(['code' => 0, 'info' => '新增失败']);
            }
        }
    }

}
