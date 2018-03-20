<?php

namespace activity\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

class IndexController extends CommonController {

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
        $list = Yii::$app->db->createCommand('SELECT * FROM xiaoming_gzh  where  status=1 order by id')
                ->bindValues([':user_id' => $user_id, ':robot_id' => $robot_id])
                ->queryAll();
 

        return $this->render('index', ['list' => $list ]);
    }

    public function actionShowgzh() {
 
    }

}
