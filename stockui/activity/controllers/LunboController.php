<?php

namespace activity\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;

class LunboController extends CommonController
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->enableCsrfValidation = false;
    }

    /**
     * 设置主页
     */
    public function actionIndex()
    {
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

    public function actionCreatemind()
    {

        return $this->render('createmind', []);
    }

    public function actionLonghuban()
    {
        set_time_limit(0);

        $where = 'where 1 ';
        if (Yii::$app->request->get('time')) {
            $time = Yii::$app->request->get('time');
            $where .= ' and date="' . $time . '"';
        } else {
            $time = date('Y-m-d', time());
            $where .= ' and date="' . $time . '"';
        }

        $list = [];
        $list = Yii::$app->db->createCommand('SELECT xiaoming_limitup.*  FROM xiaoming_limitup ' . $where)
            ->queryAll();

        foreach ($list as $key => $value) {
            if ($value['up_decimal'] == 0.00) {
                $stock_list = Yii::$app->db->createCommand('SELECT xiaoming_longhuban.*  FROM xiaoming_longhuban where  longhu_stock_code=:longhu_stock_code and longhu_date=:longhu_date')
                    ->bindValues([':longhu_stock_code' => $value['code'], 'longhu_date' => $value['date']])
                    ->queryAll();
//                var_dump($value['code']);die;

                $up_decimals = [];
                $up_count = 0;
                $up_decimals = 0;
                foreach ($stock_list as $k => $v) {
                    $v['up1'] ? $v['up1'] = $v['up1'] : $v['up1'] = 1;
                    $v['up2'] ? $v['up2'] = $v['up2'] : $v['up2'] = 1;
                    $v['up3'] ? $v['up3'] = $v['up3'] : $v['up3'] = 1;

                    $up1 = 1 * (1 + $v['up1'] / 100);
                    $up2 = 1 * (1 + $v['up1'] / 100) * (1 + $v['up2'] / 100);
                    $up3 = 1 * (1 + $v['up1'] / 100) * (1 + $v['up2'] / 100) * (1 + $v['up3'] / 100);
                    $up_decimal = max($up1, $up2, $up3);

                    if ($up_decimal > 1.1) {
                        $up_count++;
                    }
                    $up_decimals += $up_decimal;
                }

                $stock_list ? $up_decimal = $up_decimals / count($stock_list) - 1 : $up_decimal = 0;
                $stock_list ? $up_probability = $up_count / count($stock_list) : $up_probability = 0;


                $flag = Yii::$app->db->createCommand('update xiaoming_limitup set up_probability=:up_probability, up_decimal=:up_decimal where code = :code and  date = :date  ')
                    ->bindValues([':up_decimal' => $up_decimal, ':up_probability' => $up_probability, ':code' => $value['code'], ':date' => $value['date']])
                    ->execute();
            }
        }
        $list = Yii::$app->db->createCommand('SELECT xiaoming_limitup.*  FROM xiaoming_limitup ' . $where)
            ->queryAll();


        return $this->render('longhuban', ['list' => $list, 'time' => $time]);
    }

    public function actionLonghuban_solo()
    {
        set_time_limit(0);

        $where = 'where 1 ';
        if (Yii::$app->request->get('time')) {
            $time = Yii::$app->request->get('time');
            $where .= ' and date="' . $time . '"';
        } else {
            $time = date('Y-m-d', time());
            $where .= ' and date="' . $time . '"';
        }

        $list = [];

        $stock_list = Yii::$app->db->createCommand('SELECT xiaoming_longhuban.*  FROM xiaoming_longhuban where  longhu_stock_code=:longhu_stock_code and longhu_date=:longhu_date')
            ->bindValues([':longhu_stock_code' => Yii::$app->request->get('code'), 'longhu_date' => Yii::$app->request->get('date')])
            ->queryAll();


        $up_decimals = [];
        $up_count = 0;
        $up_decimals = 0;
        $stock_list2 = [];
        foreach ($stock_list as $k => $v) {
            $v['up1'] ? $v['up1'] = $v['up1'] : $v['up1'] = 1;
            $v['up2'] ? $v['up2'] = $v['up2'] : $v['up2'] = 1;
            $v['up3'] ? $v['up3'] = $v['up3'] : $v['up3'] = 1;

            $up1 = 1 * (1 + $v['up1'] / 100);
            $up2 = 1 * (1 + $v['up1'] / 100) * (1 + $v['up2'] / 100);
            $up3 = 1 * (1 + $v['up1'] / 100) * (1 + $v['up2'] / 100) * (1 + $v['up3'] / 100);
            $up_decimal = max($up1, $up2, $up3);
            $v['max'] = $up_decimal;
            $v['bigerthan10'] = FALSE;
            if ($up_decimal > 1.1) {
                $up_count++;
                $v['bigerthan10'] = TRUE;
            }

            $stock_list2[] = $v;
            $up_decimals += $up_decimal;
        }

        $count = 0;
        foreach ($stock_list2 as $key => $value) {
            if ($value['bigerthan10']) {
                $count++;
            }
        }


        $up_decimal = $up_decimals / count($stock_list) - 1;
        $up_probability = $up_count / count($stock_list);

        return $this->render('longhuban_solo', ['list' => $stock_list2, 'time' => $time, 'up_decimal' => $up_decimal, 'up_probability' => $up_probability]);
    }

    public function actionTest()
    {
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

    public function actionShowgzh()
    {
        $str = Yii::$app->request->get('gzh_name');


        $this->redirect('http://weixin.sogou.com/weixin?type=1&s_from=input&query=' . $str . '&ie=utf8&_sug_=n&_sug_type_=');
    }

    public function actionShowremark()
    {


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

    public function actionStopguangzhu()
    {
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

    public function actionCiyao()
    {
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

    public function actionUpdate()
    {
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

    public function actionDel()
    {
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

    public function actionEditcontent()
    {
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

    public function actionEditsort()
    {
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

    public function actionEditpower()
    {
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

    public function actionDuokongrank()
    {

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

        $list2 = [];
        foreach ($list as $key => $value) {
            $real = [];
            $value['duokong'] == 1 ? $real['value'] = $value['power'] : $real['value'] = -$value['power'];
            $real['content'] = $value['content'];

            $list2[] = $real;
        }

        return $this->render('duokongrank', ['list' => array_reverse($list2)]);
    }

    public function actionEditgzhsort()
    {
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
