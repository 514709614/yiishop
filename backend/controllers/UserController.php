<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\User;
use yii\web\Request;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models=User::find()->all();


        return $this->render('index',['models'=>$models]);
    }


   public function actionAdd(){
       $model=new User(['scenario'=>User::SCENARIO_ADD]);
       $request = new Request();
       if($request->isPost){
           //加载表单信息
           $model->load($request->post());
           if($model->validate()){
               $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password);
               $model->created_at=time();
               $model->auth_key=\Yii::$app->security->generateRandomString();
               $model->save(false);
               //绑定角色
               $authManager = \Yii::$app->authManager;
               foreach($model->roles as $roleName){
                   $role =  $authManager->getRole($roleName);
                   $authManager->assign($role,$model->id);
               }

               \Yii::$app->session->setFlash('warning','添加成功');
               return $this->redirect(['user/index']);
           }else{
               \Yii::$app->session->setFlash('warning','添加失败');
               var_dump($model->getErrors());exit;
           }

       }

       return $this->render('add',['model'=>$model]);


   }

    public function actionEdit($id){
        $model=User::findOne(['id'=>$id]);
        $request = new Request();
        if($request->isPost){
            //加载表单信息
            $model->load($request->post());

            if($model->validate()){
                if($model->password){
                    $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password);
                }
                $model->updated_at=time();

                $model->save(false);
                \Yii::$app->session->setFlash('warning','添加成功');

                return $this->redirect(['user/index']);
            }else{
                \Yii::$app->session->setFlash('warning','添加失败');
                var_dump($model->getErrors());exit;
            }

        }

        return $this->render('add',['model'=>$model]);

    }
    public function actionLogin(){

        $model = new LoginForm();

        $request=new Request();

        if($request->isPost){
         /*   var_dump($model);exit;*/
//            var_dump($request->post());exit;
            $model->load($request->post());


                if ($model->login()) {
                    //登陆成功
                    \Yii::$app->session->setFlash('success', '登陆成功');
                    return $this->redirect(['user/index']);
                }
            }


        return $this->render('login',['model'=>$model]);


    }


}
