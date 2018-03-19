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

        $list = [];
        $list = Yii::$app->db->createCommand('SELECT * FROM xiaoming_gzh  where  status=1 order by id')
//                ->bindValues([ ])
                ->queryAll();
 

        return $this->render('index', ['list' => $list ]);
    }

    public function actionShowgzh() {
        $str=Yii::$app->request->get('gzh_name');
//        echo 'http://weixin.sogou.com/weixin?type=1&s_from=input&query='.$str. '&ie=utf8&_sug_=n&_sug_type_=';die;
        $this->redirect('http://weixin.sogou.com/weixin?type=1&s_from=input&query='.$str. '&ie=utf8&_sug_=n&_sug_type_=');
    }


    public function actionStopguangzhu() {
        $id = Yii::$app->request->post('id');

            $res =  Yii::$app->db->createCommand('update `xiaoming_gzh` set `status`=0 where `id` = :id  ')
                ->bindValues([':id' => $id])
                ->execute();

        if ($res   ) {
            return Json::encode(['code' => 1, 'info' => '成功']);
        }else{
            return Json::encode(['code' => 0, 'info' => '操作失败']);
        }


    }


}
