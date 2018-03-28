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
        $where = ' where  xiaoming_gzh.status=1  ';


        if (Yii::$app->request->get('ciyao') === 0 || Yii::$app->request->get('ciyao') == 1) {

            $where .= ' and  ciyao=' . Yii::$app->request->get('ciyao');
        } else {

            $where .= '';
        }



        if (Yii::$app->request->get('time')) {
            $time = Yii::$app->request->get('time');
        } else {
            $time = date('Y-m-d', time());
        }

        $list = [];
        $list = Yii::$app->db->createCommand('SELECT xiaoming_gzh.*,count(xiaoming_remark.id) as number FROM xiaoming_gzh left join xiaoming_remark on xiaoming_remark.gzh_id=xiaoming_gzh.id and date="' . $time . '"' . $where . ' group by xiaoming_gzh.id   order by ciyao  ,xiaoming_gzh.sort desc')
                ->queryAll();

        foreach ($list as $key => $value) {
            
        }


        return $this->render('index', ['list' => $list, 'time' => $time]);
    }

    public function actionCreatemind() {


        return $this->render('createmind', []);
    }

    public function actionTest() {
//        $this->layout = True;

        if (Yii::$app->request->get('time')) {
            $time = Yii::$app->request->get('time');
        } else {
            $time = date('Y-m-d', time());
        }

        $list = [];
        $list = Yii::$app->db->createCommand('SELECT xiaoming_gzh.*,count(xiaoming_remark.id) as number FROM xiaoming_gzh left join xiaoming_remark on xiaoming_remark.gzh_id=xiaoming_gzh.id and date="' . $time . '" where  xiaoming_gzh.status=1  group by xiaoming_gzh.id order by xiaoming_gzh.id')
                ->queryAll();

        foreach ($list as $key => $value) {
            
        }


        return $this->render('test', ['list' => $list, 'time' => $time]);
    }

    public function actionShowgzh() {
        $str = Yii::$app->request->get('gzh_name');


        $this->redirect('http://weixin.sogou.com/weixin?type=1&s_from=input&query=' . $str . '&ie=utf8&_sug_=n&_sug_type_=');
    }

    public function actionShowremark() {


        $where = ' where xiaoming_gzh.status=1  ';

        if (Yii::$app->request->get('gzh_id')) {
            $where .= ' and  gzh_id=' . Yii::$app->request->get('gzh_id');
        } else {
            $shaixuan = '';
            $where .= '';
        }
        if (Yii::$app->request->get('type')) {
            $where .= ' and  type=' . Yii::$app->request->get('type');
        } else {
            
        }
        if (trim(Yii::$app->request->get('time'))) {
            $where .= ' and  date="' . Yii::$app->request->get('time') . '"';
        } else {
            
        }

        if (trim(Yii::$app->request->get('time'))) {
            $time = Yii::$app->request->get('time');
        } else {
            $time = date('Y-m-d', time());
        }

        $list = Yii::$app->db->createCommand('SELECT xiaoming_remark.*,xiaoming_gzh.gzh_name   FROM  xiaoming_remark  left join xiaoming_gzh on xiaoming_remark.gzh_id=xiaoming_gzh.id  ' . $where . ' order by xiaoming_remark.sort desc')
                ->queryAll();
        return $this->render('showremark', ['list' => $list, 'time' => $time, 'type' => Yii::$app->request->get('type'), 'time' => Yii::$app->request->get('time'),]);
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

    public function actionCiyao() {
        $id = Yii::$app->request->post('id');

        $res = Yii::$app->db->createCommand('update `xiaoming_gzh` set `ciyao`=1 where `id` = :id  ')
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
            if (Yii::$app->request->post('duokong')) {
                $duokong = $post['duokong'];
            } else {
                $duokong = 0;
            }

            if (Yii::$app->request->post('power')) {
                $power = $post['power'];
            } else {
                $power = 0;
            }




            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();




            $flag = $connection->createCommand()->insert('xiaoming_remark', [
                        'content' => $post['content'],
                        'gzh_id' => $gzh_id,
                        'date' => $post['date'],
                        'duokong' => $duokong,
                        'type' => $post['type'],
                        'power' => $power
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

    public function actionDel() {
        $id = Yii::$app->request->post('id');

        $flag = Yii::$app->db->createCommand('delete FROM xiaoming_remark   WHERE id=:id')
                ->bindValues([':id' => $id])
                ->execute();
        if ($flag) {
            return Json::encode(['code' => 1]);
        } else {
            return Json::encode(['code' => 0, 'info' => '删除失败']);
        }
    }

    public function actionEditcontent() {
        $id = Yii::$app->request->post('id');

        $flag = Yii::$app->db->createCommand('update xiaoming_remark set content=:content where id = :id ')
                ->bindValues([':id' => $id, ':content' => Yii::$app->request->post('content')])
                ->execute();

        if ($flag) {
            return Json::encode(['code' => 1]);
        } else {
            return Json::encode(['code' => 0, 'info' => '修改失败']);
        }
    }

    public function actionEditsort() {
        $id = Yii::$app->request->post('id');

        $flag = Yii::$app->db->createCommand('update xiaoming_remark set sort=:sort where id = :id ')
                ->bindValues([':id' => $id, ':sort' => Yii::$app->request->post('sort')])
                ->execute();

        if ($flag) {
            return Json::encode(['code' => 1]);
        } else {
            return Json::encode(['code' => 0, 'info' => '修改失败']);
        }
    }

    public function actionEditpower() {
        $id = Yii::$app->request->post('id');

        $flag = Yii::$app->db->createCommand('update xiaoming_remark set power=:power where id = :id ')
                ->bindValues([':id' => $id, ':power' => Yii::$app->request->post('power')])
                ->execute();

        if ($flag) {
            return Json::encode(['code' => 1]);
        } else {
            return Json::encode(['code' => 0, 'info' => '修改失败']);
        }
    }

    public function actionDuokongrank() {

        $where = ' where xiaoming_gzh.status=1  ';

        if (Yii::$app->request->get('gzh_id')) {
            $where .= ' and  gzh_id=' . Yii::$app->request->get('gzh_id');
        } else {
            $shaixuan = '';
            $where .= '';
        }
        if (Yii::$app->request->get('type')) {
            $where .= ' and  type=' . Yii::$app->request->get('type');
        } else {
            
        }
        if (trim(Yii::$app->request->get('time'))) {
            $where .= ' and  date="' . Yii::$app->request->get('time') . '"';
        } else {
            
        }

        if (trim(Yii::$app->request->get('time'))) {
            $time = Yii::$app->request->get('time');
        } else {
            $time = date('Y-m-d', time());
        }

        $list = Yii::$app->db->createCommand('SELECT xiaoming_remark.*,xiaoming_gzh.gzh_name   FROM  xiaoming_remark  left join xiaoming_gzh on xiaoming_remark.gzh_id=xiaoming_gzh.id  ' . $where . ' order by abs(xiaoming_remark.power) desc limit 10')
                ->queryAll();
        
        $list2=[];
        foreach ($list as $key => $value) {
            $real=[];
            $value['duokong']==1?$real['value']=$value['power']:$real['value']=-$value['power'];
            $real['content'] = $value['content'];
            
            $list2[] = $real;
        } 
        
        return $this->render('duokongrank', ['list' => array_reverse($list2)]);
    }

    public function actionEditgzhsort() {
        $id = Yii::$app->request->post('id');

        $flag = Yii::$app->db->createCommand('update xiaoming_gzh set sort=:sort where id = :id ')
                ->bindValues([':id' => $id, ':sort' => Yii::$app->request->post('sort')])
                ->execute();

        if ($flag) {
            return Json::encode(['code' => 1]);
        } else {
            return Json::encode(['code' => 0, 'info' => '修改失败']);
        }
    }

}
