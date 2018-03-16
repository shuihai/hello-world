<?php

namespace activity\controllers;


use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use common\models\UploadModel;
use yii\web\UploadedFile;
use yii\imagine\Image;

//上传图片类
class UploadimgController extends Controller {

    public $enableCsrfValidation = false;

    public function actionImg() {
         
        $model = new UploadModel;
        //$config = $configModel->getConfig(array('upload_path', 'upload_url', 'upload_size', 'thumb_width', 'thumb_height'));

        $uploadDir = Yii::$app->params['upload_path'];
        //var_dump($uploadDir);exit;
        // Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstanceByName('file');
            if (!$model->file)
                return 403;

            //文件大小
            if ($model->file->size > 1024 * (Yii::$app->params['limit_size'])) {
                return 400;
                // return $model->file->size."@@".Yii::$app->params['limit_size'];
            }
            //图片后缀
            $suffix = $model->file->extension;
            //通过后缀判断图片格式
            switch ($suffix) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'bmp':
                    break;

                default:
                    return 404;
            }

            //图片名唯一性
            $code = $this->generateNum();
            $fileName = $code . '.' . $suffix;
            $fileName2 = $code .'small'. '.' . $suffix;
            $uploadPath = Yii::$app->params['upload_path'] . DIRECTORY_SEPARATOR . $fileName;
            $uploadPath2 = Yii::$app->params['upload_path'] . DIRECTORY_SEPARATOR . $fileName2;
            //$savePath = $user->oid . DIRECTORY_SEPARATOR . $fileName;
            //上传图片
            if ($model->file && $model->validate()) {
                $result = $model->file->saveAs($uploadPath);
              
                if ($result) {
                    $uploadUrl = $fileName;
			        $width = 200;
//			        $height = 50;
                    //图片压缩
			        Image::thumbnail($uploadPath, $width, $height)->save($uploadPath2, ['quality' => 100]);
                    $arrInfo = [
                        'guid' => $code,
                        'type' => 1,
                        'path' => $uploadPath,
                        'size' => $model->file->size,
                        'status' => 0,
                        'create_time' => time(),
                        "suffix" => $suffix,
                        "user_id" => Yii::$app->user->id
                    ];
//                    $this->fileBook($arrInfo);
                    return $uploadUrl;
                } else {
                    return 402;
                }
            } else {
                return 401;
            }
        }
    }

    //文件上传注册
    public function fileBook($arr) {
        $result = Yii::$app->db->createCommand("INSERT INTO `admin_files` (guid,type,path, size, status, create_time,suffix,user_id) VALUES ('" . implode("','", $arr) . "')")
                ->execute();

        return $result;
    }

    //文件上传成功登记
    public function actionFilemark($guid) {
        if (empty($guid)) {
            return ["code" => 0, "info" => "参数不能为空"];
        }

        $result = Yii::$app->db->createCommand("UPDATE  `admin_files` SET status = 1 WHERE `guid` = " . $guid)
                ->execute();
        if ($result) {
            return ["code" => 1, "info" => "success"];
        }

        return $result;
    }

    //文件删除
    public function ActionDelimg($guid) {
        if (empty($guid)) {
            return ["code" => 0, "info" => "参数不能为空"];
        }
        $back = Yii::$app->db->createCommand("select `path` from  `admin_files`  WHERE `guid` = " . $guid)->queryOne();
        $res = unlink($back["path"]);
        if ($res) {
            $result = Yii::$app->db->createCommand("delete from `admin_files` WHERE `guid` = " . $guid)
                    ->execute();
        }

        if ($result) {
            return ["code" => 1, "info" => "success"];
        } else {
            return ["code" => 0, "info" => "删除失败"];
        }
    }

    //获取唯一序列号
    private function generateNum() {
        //strtoupper转换成全大写的
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $uuid = substr($charid, 0, 8) . substr($charid, 8, 4) . substr($charid, 12, 4) . substr($charid, 16, 4) . substr($charid, 20, 12);
        return $uuid;
    }

}
