<?php

namespace activity\models;

use Yii;

class User extends \common\models\User
{
    public $password;
    /**
     * @inheritdoc
     */
    const STATUS_ACTIVE = 1;
    public static function tableName()
    {
        return 'robot_cloud.user_user';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password_hash', 'email','company_name','contact'], 'required'],
            [['status',], 'integer'],
            ['username','checkusername','message'=>'用户名不能为中文'],
            //[['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'email'], 'string', 'max' => 255],
            [['company_name','contact','phone','address'],'string'],
            //['repassword','compare','compareAttribute'=>'password','message'=>"重复密码跟密码不一致，请重新输入"]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password' => '密码',
            'address' => '地址',
            'company_name' => '公司名称',
            'contact' => '联系人',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * 注册
     */
    public function signup(){
        // 调用validate方法对表单数据进行验证，验证规则参考上面的rules方法
        if (!$this->validate()) {
            return array_values($this->getFirstErrors())[0];
        }
        // 设置密码，密码肯定要加密，暂时我们还没有实现，看下面我们有实现的代码
        $this->setPassword($this->password);
        // 生成 "remember me" 认证key
        $this->generateAuthKey();
        // save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，因为我们上面已经调用Signup的rules校验过了，这里就没必要在用UserBackend的rules校验了
        return $this->save(false);
    }

    /**
     * 为model的password_hash字段生成密码的hash值
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * 生成 "remember me" 认证key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 验证用户名是否为中文
     * @param $attribute
     * @param $params
     */
    public function checkusername($attribute , $params)
    {
        //var_dump(preg_match("/^[\x7f-\xff]+$/",$this->$attribute));exit();
        if(preg_match("/^[\x7f-\xff]+$/",$this->$attribute)){
            $this->addError($attribute , '用户名不能为中文');
        }
    }

    /**
     * 验证密码
     * $password 输入密码
     * $old_password 原密码
     */
    public function validatePwd($password,$old_password){
        return Yii::$app->security->validatePassword($password,$old_password);
    }
}
