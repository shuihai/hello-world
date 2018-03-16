<?php
namespace activity\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;


/**
 * Site controller
 */
class CommonController extends Controller
{


//    public function beforeAction($action) {
//
//
//        if (\Yii::$app->user->isGuest) {
//
//            $this->redirect(Yii::$app->params['mother_url'].'/site/login');
//            return false;
//        }  else {
//            return true;
//        }
//    }

    /**
    获取远程文件内容
    @param $url 文件http地址
     */
    function fopen_url($url)
    {
        if (function_exists('file_get_contents')) {
            $file_content = @file_get_contents($url);
        } elseif (ini_get('allow_url_fopen') && ($file = @fopen($url, 'rb'))){
            $i = 0;
            while (!feof($file) && $i++ < 1000) {
                $file_content .= strtolower(fread($file, 4096));
            }
            fclose($file);
        } elseif (function_exists('curl_init')) {
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl_handle, CURLOPT_FAILONERROR,1);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Trackback Spam Check');
            $file_content = curl_exec($curl_handle);
            curl_close($curl_handle);
        } else {
            $file_content = '';
        }
        return $file_content;
    }


	public function actionError(){
		echo "ERROR";
	}

    //离线语音所需aiml
    protected function create_xml($arr=array()){
        $data_array = $arr;

        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<aiml>\n";
        foreach ($data_array as $data) {
            $xml .= $this->create_item( $data['question'], $data['answer']);
        }
        $xml .= "</aiml>\n";
        return $xml;

    }

    //  创建XML单项
    private function create_item( $question_data, $answer_data)
    {
        $item = "<category>\n";
        $arrSrai = [];
        if(count($question_data)>0){
            $i = 0;

            $firstQuestion = "";
            foreach($question_data as $v){
                if($i == 0){
                    $firstQuestion = "*".str_replace("？","",$question_data[0])."*";
                    $item .= "<pattern>";
                    $item .= "*".str_replace("？","",$question_data[0])."*";
                }else{
                    $strSrai  = "<category>\n";
                    $strSrai .= "<pattern>";
                    $strSrai .= "*".str_replace("？","",$v)."*";
                    $strSrai .= "</pattern>\n";
                    $strSrai .= "<template>\n";
                    $strSrai .= "<srai>".$firstQuestion."</srai>\n";
                    $strSrai .= "</template>\n";
                    $strSrai .= "</category>\n";
                    $arrSrai[] = $strSrai;
                }
                $i++;
            }
        }

        $item .= "</pattern>\n";


        if(count($answer_data)>1){
            $item .= "<template>\n";
            $item .= "<random>\n";
            foreach($answer_data as $v){
                $item .= " <li>" . $v . "</li>\n";
            }
            $item .= "</random>\n";
        }else{
            $item .= " <template>";
            $item .= $answer_data[0];
        }

        $item .= "</template>\n";
        $item .= "</category>\n";

        if(count($arrSrai) > 0){
            $sraiItem = "";
            foreach($arrSrai as $v){
                $sraiItem .= $v."\n";
            }
            $item .= $sraiItem;
        }
        return $item;
    }

    //离线语音所需bsg
    public function actionBsg($arr=array()){

        $attData = [];
        if($arr){
            $attData["version"] = "0.1";
            $attData["rules"] = "";
            $i = 0;
            $slots = [];
            $rules = [];
            $grammar = "";
            $origin_slots  ="";
            $origin_rules = "";
            $wakeup = "";
            foreach($arr as $v){
                $i++;
                $k = "word".$i;
                $slots[$k] = [$v];
                $rules_data = ["origin"=>"<".$k.">","pattern"=>"^(".$v.")$","groups"=>[$k]];
                $rules[$k] = [$rules_data];
                $grammar .= "<".$k.">=".$v.";\n";
                $origin_slots .= $k."=".$v."\n";
                $origin_rules .= $k."=<".$k.">\n";
                $wakeup .= "( <".$k."> )\n( <_wakeup><".$k."> )\n";
            }
            $attData["slots"] = $slots;
            $attData["rules"] = $rules;
            $attData["grammar"] = $grammar."<auto_create_node> = 词条默认值;\n<_wakeup> = 唤醒词占位符;\n\n\n_SCENE_ID_ 0\n\n( <auto_create_node> )\n\n( <_wakeup><auto_create_node> )\n\n".$wakeup;
            $attData["origin_slots"] = $origin_slots;
            $attData["origin_rules"] = $origin_rules;
        }

        $json =  Json::encode($attData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

        return rawurlencode($json);
    }
}
