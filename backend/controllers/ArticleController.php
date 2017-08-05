<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleDetail;
use yii\web\Request;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models=Article::find()->where(['>','status',-1])->all();

        return $this->render('index',['models'=>$models]);
    }

    public function actionDelete($id){
        $model = Article::findOne(['id' => $id]);
        $model->status= -1;
        $model->save();
        return $this->redirect(['article/index']);
    }


    public function actionAdd()
    {
        //1 展示添加表单
        //1.1 实例化表单模型
        $model = new Article();
        //2 接收表单数据并保存到数据表
        $model2=new ArticleDetail();
        $request = new Request();
        if($request->isPost){
            //加载表单数据
            $model->load($request->post());
            $model2->load($request->post());
            //验证数据
            if($model->validate()){
                //验证通过,保存到数据表
                $model->create_time = time();
                $model->save();
                //跳转到列表页
                $model2->article_id=$model->id;
                $model2->save();
                return $this->redirect(['article/index']);
            }else{
                //验证不通过，打印错误信息
                var_dump($model->getErrors());exit;
            }
        }

        /*$categories = Category::find()->all();
        $items = [];
        foreach ($categories as $category){
            $items[$category->id]=$category->name;
        }*/
        //var_dump($items);exit;
        //$items = [1=>'手机',2=>'家电'];
        //1.2 调用视图
        return $this->render('add',['model'=>$model ,'model2'=>$model2/*,'items'=>$items*/]);

    }
    public function actionEdit($id)
    {
        //1 展示添加表单
        //1.1 实例化表单模型
        $model = Article::findOne(['id' => $id]);
        $model2 = ArticleDetail::findOne(['article_id' => $id]);

        //2 接收表单数据并保存到数据表
        $request = new Request();
        if($request->isPost){
            //加载表单数据
            $model->load($request->post());
            $model2->load($request->post());
            //验证数据
            if($model->validate()){
                //验证通过,保存到数据表
                $model->create_time = time();
                $model->save();
                //跳转到列表页
                $model2->article_id=$model->id;
                $model2->save();
                return $this->redirect(['article/index']);
            }else{
                //验证不通过，打印错误信息
                var_dump($model->getErrors());exit;
            }
        }

        return $this->render('add',['model'=>$model ,'model2'=>$model2/*,'items'=>$items*/]);
    }








}
