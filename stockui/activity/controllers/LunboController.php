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


    public function actionCreateduanxian()
    {


        $list = [];
        $list = Yii::$app->db->createCommand('SELECT * FROM jktest.`zmt_next_close_for_before_limit_stock` order by datetime')
            ->queryAll();


        $axis = [];
        foreach ($list as $key => $value) {

            $axis[] = $value['datetime'];
        }

        $startdate = $axis[0];
        $enddate = $axis[sizeof($axis) - 1];

        $average_rate = [];
        foreach ($list as $key => $value) {

            $average_rate[] = $value['average_rate'];
        }

        $list2 = [];
        $sql = 'SELECT * FROM jktest.`zmt_everyday_index` 
              where stock_code="000001.XSHG" and datetime>= "' . $startdate . '"   and 
              
              datetime<="' . $enddate . '"    order by datetime';

//        var_dump($axis);
//        echo $sql;die;
        $list2 = Yii::$app->db->createCommand('SELECT * FROM jktest.`zmt_everyday_index` 
              where stock_code="000001.XSHG" and datetime>= "' . $startdate . '"   and 
              
              datetime<="' . $enddate . '"    order by datetime')
            ->queryAll();

//        var_dump($list2);die;
        $index_rate = [];
        foreach ($list2 as $key => $value) {

            $index_rate[] = ($value['close'] - $value['pre_close']) / $value['pre_close'] * 100;
        }

        return $this->render('createduanxian', ['average_rate' => $average_rate, 'index_rate' => $index_rate, 'axis' => $axis]);

    }

    public function actionCreatebi()
    {
        $list = $this->read_csv("C:\my_soft\wamp\www\gittest\hello-world\stockui\bi_dataset.csv");
//        var_dump($list);
        $data = [];
        foreach ($list as $key => $value) {
            $temp = [];
            $temp[] = $value[1];
            $temp[] = $value[2];
            $temp[] = $value[3];
            $temp[] = $value[4];
            $temp[] = $value[5];

            $data[] = $temp;
        }


        $index_list = [0, 4, 8, 12];

        foreach ($list as $key => $value) {
            $temp = [];
            $temp[] = $value[4];
            $temp[] = $value[5];
            $low_top_data[] = $temp;
        }


        $index_list = $this->analysisFenxing($low_top_data);
//        var_dump($index_list);
//        die;
        return $this->render('createbi', ['index_list' => $index_list, 'data' => $data]);

    }

    public function actionCreateweekstatic()
    {


        if (Yii::$app->request->get('time')) {
            $time_arr = Yii::$app->request->get('time');
            $time_arr = explode(",", $time_arr);

//            $time="";
//            foreach ($time_arr as $k=>$v){
//                $time=$time."'".$v."',";
//
//            }
//            $time=trim($time,",");
            $type = Yii::$app->request->get('modeltype');
//
//            $list = Yii::$app->db2->createCommand("SELECT * FROM `zmt_show_result` WHERE datetime in (".$time.") and type='".$type."' order by datetime asc")
////                ->bindValues([':time' => $time, ':type' => $type])
//
//                ->queryAll();

            $list = Yii::$app->db2->createCommand("SELECT * FROM `zmt_show_result` WHERE datetime >='" . $time_arr[0] .
                "' and datetime<='" . $time_arr[1] . "' and type='" . $type . "' order by datetime asc")
                ->queryAll();

            $data = [];
            $data[] = ["begin", 0, 0, 0, 0];
            $realvalue_arr = [];
            $realvalue_arr[] = null;
            foreach ($list as $key => $value) {

                $temp = [];
                $temp[] = $value["datetime"];

                $probability = explode(",", $value["value"]);

                $index = array_search(max($probability), $probability);


                $price_array = $this->trans_index_to_region($index, 11);

                $data[] = array_merge($temp, $price_array);;


                $realvalue_arr[] = $value["real_value"];
            }
            $data[] = ["end", 0, 0, 0, 0];
            $realvalue_arr[] = null;


            return $this->render('createweekstatic', ['data' => $data, 'realvalue_arr' => $realvalue_arr]);

        } else {

        }

//        SELECT * FROM `zmt_show_result` WHERE datetime in (:time) and type=:type order by datetime desc


        $list = $this->read_csv("C:\my_soft\wamp\www\gittest\hello-world\stockui\bi_dataset.csv");

        $data = [];
        foreach ($list as $key => $value) {
            $temp = [];
            $temp[] = $value[1];
            $temp[] = $value[2];
            $temp[] = $value[3];
            $temp[] = $value[4];
            $temp[] = $value[5];

            $data[] = $temp;
        }


        $index_list = [0, 4, 8, 12];

        foreach ($list as $key => $value) {
            $temp = [];
            $temp[] = $value[4];
            $temp[] = $value[5];
            $low_top_data[] = $temp;
        }


        $index_list = $this->analysisFenxing($low_top_data);
//        var_dump($index_list);
//        die;
        return $this->render('createweekstatic', ['index_list' => $index_list, 'data' => $data]);

    }


    public function trans_index_to_region($index, $class_num)
    {
        if ($class_num == 7) {
            $result = [$index - 3.5, $index - 2.5, $index - 3.5, $index - 2.5];
        }

        if ($class_num == 11) {
            if ($index < 5) {
                $low = ($index - 6) * 0.5;
                $high = ($index - 6 + 1) * 0.5;

                $mean = rand(-1,1);
            }
            if ($index >= 5 && $index <= 7) {
                $low = -0.5;
                $high = 0.5;

            }
            if ($index > 7) {
                $low = ($index - 6 - 1) * 0.5;
                $high = ($index - 6) * 0.5;

            }
            //正态化混淆
            //

            $result = [$low,$high, $low, $high];
        }

        return $result;
    }

    public function analysisFenxing($dataset)
    {

        $dingdiList = [];
        $dingList = [];
        $diList = [];
        for ($i = 0; $i < count($dataset); $i++) {
            # 对于开头，看是否第5个及以后是否先形成了顶分或者底分型
            # 条件：一:3个k线构成标准形状：中间突出，两边下沉，注意包含则顺延 二：中间那根k线需要是从上一个顶底分型开始，直到他后一个k线，这些k线的最高或者最低点


            if (count($dingdiList) > 0)
                $beforeIndex = $dingdiList[count($dingdiList) - 1];
            else
                $beforeIndex = 0;

            if (count($dingList) > 0)
                $beforedingIndex = $dingList[count($dingList) - 1];
            else
                $beforedingIndex = 0;

            if (count($diList) > 0)
                $beforediIndex = $diList[count($diList) - 1];
            else
                $beforediIndex = 0;

            if ($beforeIndex == 0) {
                if ($i > 0) {
                    # 假如将确定第一个底分型，
                    if (min($dataset[$i - 1][0], $dataset[$i][0], $dataset[$i + 1][0]) == $dataset[$i][0]) {
                        $dingdiList[] = $i;
                        $diList[] = $i;
                    } elseif (max($dataset[$i - 1][1], $dataset[$i][1], $dataset[$i + 1][1]) == $dataset[$i][1]) {
                        $dingdiList[] = $i;
                        $dingList[] = $i;
                    }
                    # print("max(dataset[i - 1:i + 2][1]) == dataset[i][1]")
                    # print(max(dataset[i - 1:i + 2, 1]) == dataset[i][1])
                    # print(max(dataset[i - 1:i + 2, 1]))
                    # print((dataset[i - 1:i + 2, 1]))
                    # print((dataset[i - 1:i + 3, 1]))
                    # print(dataset[i][1])
                }
            } else {
                # 前面是底分型
                $bidataset = array_slice($dataset, $beforediIndex, $i + 1 - $beforediIndex);
                $bidataset0 = [];
                foreach ($bidataset as $key => $value) {
                    $bidataset0[] = $value[0];
                }

                if ($beforediIndex == $beforeIndex) {
                    if (($i < count($dataset) - 1) && (max($dataset[$i - 1][1], $dataset[$i][1], $dataset[$i + 1][1]) == $dataset[$i][1]) && (($i - $beforediIndex) >= 4) && (min(
                                $bidataset0) == $dataset[$beforediIndex][0])) {
                        $dingdiList[] = $i;
                        $dingList[] = $i;

                    }


                    if ($dataset[$i][0] < $dataset[$beforediIndex][0]) {
                        $dingdiList[count($dingdiList) - 1] = $i;
                        if (count($diList) > 0) {
                            $diList[count($diList) - 1] = $i;
                        }
                    }


                }

                # else:
                #     diList.append(i)
                # 前面是顶分型
                $bidataset = array_slice($dataset, $beforedingIndex, $i + 1 - $beforedingIndex);
                if ($beforedingIndex == $beforeIndex) {
                    $bidataset1 = [];
                    foreach ($bidataset as $key => $value) {
                        $bidataset1[] = $value[1];
                    }


                    if (($i < count($dataset) - 1) && (min($dataset[$i - 1][0], $dataset[$i][0], $dataset[$i + 1][0]) == $dataset[$i][0]) && (($i - $beforedingIndex) >= 4) && (max(
                                $bidataset1) == $dataset[$beforedingIndex][1])) {

                        $dingdiList[] = $i;
                        $diList[] = $i;
                    }


                    if ($dataset[$i][1] > $dataset[$beforedingIndex][1]) {
                        $dingdiList[count($dingdiList) - 1] = $i;
                        if (count($dingList) > 0) {
                            $dingList[count($dingList) - 1] = $i;
                        }

                    }
                }

            }
//            echo $i. "dingList";
//            var_dump($dingList);
//            echo $i. "diList";
//            var_dump($diList);
        }

        return $dingdiList;
    }

    function read_csv($file)
    {
        setlocale(LC_ALL, 'zh_CN');//linux系统下生效
        $data = null;//返回的文件数据行
        if (!is_file($file) && !file_exists($file)) {
            die('文件错误');
        }
        $cvs_file = fopen($file, 'r'); //开始读取csv文件数据
        $i = 0;//记录cvs的行
        while ($file_data = fgetcsv($cvs_file)) {
            $i++;
            if ($i == 1) {
                continue;//过滤表头
            }
            if ($file_data[0] != '') {
                $data[$i] = $file_data;
            }

        }
        fclose($cvs_file);
        return $data;
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
