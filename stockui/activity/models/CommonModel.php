<?php

namespace activity\models;

use Yii;

/**
 * 模型类公共控制器
 * Class CommonModel
 * @package robotAdmin\models
 */
class CommonModel extends \yii\db\ActiveRecord
{
    /**
     * 获取总条数，分页使用
     * @param $model 模型类
     * @param array $where 查找条件
     * @return array
     */
    public function getCount($model,$where=[]){
        $w_sql = "";
        $w_data = [];
        if(!empty($where)){
            foreach ($where as $key => $value){
                if(!empty($value)){
                    $w_sql .= "and ".$key." = :".$key." ";
                    $w_data[":".$key] = $value;
                }
            }
        }
        return Yii::$app->db->createCommand("select count(*) count from ".$model->tableName()." where 1 = 1 ".$w_sql."",$w_data)->queryAll()[0]['count'];
    }

    /**
     * 获取基础分类
     * @param $model 模型类
     * @param string $field 获取的字段
     * @param $where    条件
     * @param $offset   
     * @param $limit
     * @return array
     */
    public function getBaseList($model,$field='*',$where,$offset,$limit){
        $w_sql = "";
        $w_data = [];
        if(!empty($where)){
            foreach ($where as $key => $value){
                $w_sql .= "and ".$key." = :".$key." ";
                $w_data[":".$key] = $value;
            }
        }
        return Yii::$app->db->createCommand('select '.$field.' from '.$model->tableName().' where status = 1 '.$w_sql.' limit '.$offset.','.$limit.'',$w_data)->queryAll();
    }
}
