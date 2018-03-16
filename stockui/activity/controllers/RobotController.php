<?php

namespace activity\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * 主页设置
 */
class RobotController extends Controller {

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
     
        $list = [];
        return $this->render('index', ['list' => $list, 'limit' => (9 - count($list)), 'robot_id' => 1, 'second' => 3]);
        
    }

    public function actionTest() {

        echo 4444;
    }

}
