<?php
namespace backend\models;

use yii\base\Model;

class LoginForm extends Model{
    public $username;
    public $password;
    public function rules(){
        return[
            [['username','password'],'required']
        ];

    }
    public function attributeLabels(){

        return[
            'username'=>'用户名',
            'password'=>'密码',
        ];
    }
    public function login(){
        $admin=User::findOne(['username'=>$this->username]);
        if($admin){
            //用户存在、last_login_time

            if(\Yii::$app->security->validatePassword($this->password,$admin->password_hash)){
                $admin->last_login_time = time();

                $admin->last_login_ip=$_SERVER["REMOTE_ADDR"];

                $admin->save();

                //登陆
                \Yii::$app->user->login($admin);
                return true;
            }else{
                $this->addError('password_hash','密码错误');
            }

        }else{
            //用户不存在
            $this->addError('username','用户名不存在');
        }
        return false;
    }



}