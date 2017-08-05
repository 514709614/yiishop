<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\base\Exception;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;


class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models=GoodsCategory::find()->all();

        return $this->render('index',['models'=>$models]);
    }
    public function actionDelete(){

    }

    public function actionAdd()
    {
        $model = new GoodsCategory(['parent_id' => 0]);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            //$model->save();
            //判断是否是添加一级分类
            if ($model->parent_id) {
                //非一级分类

                $category = GoodsCategory::findOne(['id' => $model->parent_id]);
                if ($category) {
                    $model->appendTo($category);
                } else {
                    throw new HttpException(404, '上级分类不存在');
                }

            } else {
                //一级分类
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success', '分类添加成功');
            return $this->redirect(['index']);

        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id)
    {
        $model = GoodsCategory::findOne(['id'=>$id]);
        if($model==null){
            throw new NotFoundHttpException('分类不存在');//NotFoundHttpException
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate()){

            try{
                if($model->parent_id){


                    $category = GoodsCategory::findOne(['id'=>$model->parent_id]);
                    if($category){
                        $model->appendTo($category);
                    }else{
                        throw new HttpException(404,'上级分类不存在');
                    }

                }else{

                    if($model->oldAttributes['parent_id']==0){
                        $model->save();
                    }else{
                        $model->makeRoot();
                    }

                }
                \Yii::$app->session->setFlash('success','分类添加成功');
                return $this->redirect(['index']);
            }catch (Exception $e){//Exception
                $model->addError('parent_id',GoodsCategory::exceptionInfo($e->getMessage()));
            }


        }

        return $this->render('add',['model'=>$model]);
    }


}
