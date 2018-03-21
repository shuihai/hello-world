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
//        $this->layout = FALSE;
        
         if( Yii::$app->request->get('time')){
             $time = Yii::$app->request->get('time');
         }  else {
             $time = date('Y-m-d', time());
         }
        
        $list = [];
        $list = Yii::$app->db->createCommand('SELECT xiaoming_gzh.*,count(xiaoming_remark.id) as number FROM xiaoming_gzh left join xiaoming_remark on xiaoming_remark.gzh_id=xiaoming_gzh.id and date="'.$time.'" where  xiaoming_gzh.status=1  group by xiaoming_gzh.id order by xiaoming_gzh.id')
                ->queryAll();
        
        foreach ($list as $key => $value) {
            
            
        }


        return $this->render('index', ['list' => $list,'time' => $time]);
    }
    public function actionTest() {
//        $this->layout = True;
        
         if( Yii::$app->request->get('time')){
             $time = Yii::$app->request->get('time');
         }  else {
             $time = date('Y-m-d', time());
         }
        
        $list = [];
        $list = Yii::$app->db->createCommand('SELECT xiaoming_gzh.*,count(xiaoming_remark.id) as number FROM xiaoming_gzh left join xiaoming_remark on xiaoming_remark.gzh_id=xiaoming_gzh.id and date="'.$time.'" where  xiaoming_gzh.status=1  group by xiaoming_gzh.id order by xiaoming_gzh.id')
                ->queryAll();
        
        foreach ($list as $key => $value) {
            
            
        }


        return $this->render('test', ['list' => $list,'time' => $time]);
    }
    public function actionShowgzh() {
        $str = Yii::$app->request->get('gzh_name');
 
        
        $this->redirect('http://weixin.sogou.com/weixin?type=1&s_from=input&query=' . $str . '&ie=utf8&_sug_=n&_sug_type_=');
    }
    
    public function actionShowremark() {
        
         if( Yii::$app->request->get('time')){
             $time = Yii::$app->request->get('time');
         }  else {
             $time = date('Y-m-d', time());
         }
        
        $list = Yii::$app->db->createCommand('SELECT *  FROM  xiaoming_remark  left join xiaoming_gzh on xiaoming_remark.gzh_id=xiaoming_gzh.id  where date=:date  and   xiaoming_gzh.status=1  and gzh_id=:gzh_id')
                ->bindValues([':date' => $time,':gzh_id' => Yii::$app->request->get('gzh_id')])
                ->queryAll();
        return $this->render('showremark', ['list' => $list,'time' => $time]);
        
    }
    
    public function actionStopguangzhu() {
        $id = Yii::$app->request->post('id');

        $res = Yii::$app->db->createCommand('update `xiaoming_gzh` set `status`=0 where `id` = :id  ')
                ->bindValues([':id' => $id])
                ->execute();

        if ($res) {
            return Json::encode(['code' => 1, 'info' => '成功']);
        } else {
            return Json::encode(['code' => 0, 'info' => '操作失败']);
        }
    }

    public function actionUpdate() {
        $this->layout = FALSE;

        if ($post = Yii::$app->request->post()) {
            $gzh_id = Yii::$app->request->post('gzh_id');
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();


            $flag = $connection->createCommand()->insert('xiaoming_remark', [
                        'content' => $post['content'],
                        'gzh_id' => $gzh_id,
                        'date' => $post['date'],
                        'duokong' => $post['duokong'],
                    ])->execute();


            if ($flag) {
                $transaction->commit();
                return Json::encode(['code' => 1, 'info' => ' 操作成功']);
            } else {
                $transaction->rollBack();
                return Json::encode(['code' => 0, 'info' => '操作失败 ']);
            }
        }
    }

}
