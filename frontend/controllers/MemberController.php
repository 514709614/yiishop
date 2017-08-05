<?php

namespace frontend\controllers;
use frontend\models\Address;
use frontend\models\LoginForm;
use frontend\models\Member;
class MemberController extends \yii\web\Controller
{
    public $layout = 'login';
    //用户注册
    public function actionRegister()
    {
        $model = new Member(['scenario'=>Member::SCENARIO_REGISTER]);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->save(false);
            return $this->redirect(['member/login']);
        }
        return $this->render('register',['model'=>$model]);
    }
    //用户登录

    public function actionLogin(){
/*        if(!\Yii::$app->member->isGuest){
            return $this->redirect(['member/index']);
        }*/
        $model = new LoginForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->login()){
                return $this->redirect(['member/index']);
            }
        }
        return $this->render('login',['model'=>$model]);
    }


    public function actionIndex()
    {
        //打印登录状态
//        var_dump(\Yii::$app->member->identity);exit;
//        return $this->render('index');
        return $this->redirect(['index/index']);
    }

    public function actionLogout()
    {
        \Yii::$app->member->logout();
        return $this->redirect(['member/login']);
    }

    //用户地址管理
    public function actionAddress()
    {
        $this->layout = 'main';
        $model = new Address();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->save(false);
        }
        return $this->render('address',['model'=>$model]);
    }
    public function actionTestSms()
    {

        $code = rand(1000,9999);
        $tel = '18111644898';
        $res = \Yii::$app->sms->setPhoneNumbers($tel)->setTemplateParam(['code'=>$code])->send();
        //将短信验证码保存redis（session，mysql）
        \Yii::$app->session->set('code_'.$tel,$code);
        //验证
        $code2 = \Yii::$app->session->get('code_'.$tel);
        if($code == $code2){
        }

     /*   print_r($response);*/
    }


}
