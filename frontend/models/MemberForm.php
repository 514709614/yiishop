<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $tel
 * @property integer $last_login_time
 * @property string $last_login_ip
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MemberForm extends \yii\db\ActiveRecord
{
    public  $password;//确认密码
    public $code;//验证码

    /**
     * @inheritdoc
     */
    //验证两次密码
    public function regist(){
        if ($this->password != $this->password_hash){
            $this->addError('password','两次密码不一致');
            return false;
        }else{
            $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            $this->auth_key=1;
            $this->created_at=time();
            $this->save(false);
            return true;
        }

    }
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'string', 'max' => 50],
            [['password_hash', 'email'], 'string', 'max' => 100],
            [['tel'],'match','pattern'=>'/^1[3|4|5|8][0-9]\d{8}$/','message'=>'不是手机号'],
//            [['字段名'],match,'pattern'=>'正则表达式','message'=>'提示信息'];
        [['tel','username','email'], 'unique'],//唯一用户,和手机,email
            [['username','password_hash','password','email','tel','code'],'required'],
            ['email','email'],
            ['code','captcha','captchaAction'=>'member/captcha'],
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
            'password_hash' => '密码',
            'email' => '邮箱',
            'tel' => '电话',
            'password'=>'确认密码',
            'code'=>'验证码'
        ];
    }
}
