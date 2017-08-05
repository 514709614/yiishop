<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use yii\web\Request;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models=ArticleCategory::find()->where(['>','status',-1])->all();

        return $this->render('index',['models'=>$models]);
    }
    public function actionAdd(){
        $model=new ArticleCategory();
        $request = new Request();
        if($request->isPost){
            //加载表单信息
            $model->load($request->post());

            if($model->validate()){

                $model->save(false);
                \Yii::$app->session->setFlash('warning','添加成功');

                return $this->redirect(['article-category/index']);
            }else{
                \Yii::$app->session->setFlash('warning','添加失败');
                var_dump($model->getErrors());exit;
            }

        }

        return $this->render('add',['model'=>$model]);
    }
//修改
    public function actionEdit($id){


        $model = ArticleCategory::findOne(['id' => $id]);
        $request = new Request();
        if($request->isPost){
            //加载表单信息
            $model->load($request->post());

            if($model->validate()){
//
                //如果没有直接保存
                $model->save(false);
                \Yii::$app->session->setFlash('warning','修改成功');

                return $this->redirect(['article-category/index']);
            }else{
                \Yii::$app->session->setFlash('warning','修改失败');
                var_dump($model->getErrors());exit;
            }

        }

        return $this->render('add',['model'=>$model]);


    }


    public function actionDelete($id){
        $model = ArticleCategory::findOne(['id' => $id]);
        $model->status= -1;
        $model->save();
        return $this->redirect(['article-category/index']);
    }


}
