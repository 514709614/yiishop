<?php

namespace backend\controllers;

use backend\models\Brand;

use yii\web\Request;
use yii\web\UploadedFile;
use flyok666\qiniu\Qiniu;
class BrandController extends \yii\web\Controller
{
//添加
    public function actionAdd(){
        $model=new Brand();
        $request = new Request();
        if($request->isPost){
            //加载表单信息
            $model->load($request->post());
     /*       var_dump($request);exit;*/
            //接收图片UploadedFile


            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            //验证提交数据
       /*     var_dump( $model->imgFile);exit;*/
            if($model->validate()){
//                var_;exit;
                //如果验证成功
                //var_dump($model->imgFile,$model);exit;
                //判断是否上传文件
                if($model->imgFile){
                    //  $fileName=
                    //  echo 111;exit;
                    //如果有图片上传
                    $d = \Yii::getAlias('@webroot').'/upload/'.date('Ymd');
                    if(!is_dir($d)){
                        mkdir($d);
                    }
                    $fileName='/upload/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $config = [
                        'accessKey'=>'-VWQa-86xyStnKRybH4MXy3_wfkM-ojy9jORSH-q',
                        'secretKey'=>'43rbK3TOVmDaE0FT6qkafWFLwxkmbTxH1fJ3P6Ty',
                        'domain'=>'http://otfcjwnae.bkt.clouddn.com/',
                        'bucket'=>'lichonglin',
                        'area'=>Qiniu::AREA_HUADONG
                    ];



                    $qiniu = new Qiniu($config);

                    $qiniu->uploadFile(
                        \Yii::getAlias('@webroot').$fileName,
                        $fileName
                    );
                    $url = $qiniu->getLink($fileName);
                    $model->logo = $url;

                }
                //如果没有直接保存
                $model->save(false);
                \Yii::$app->session->setFlash('warning','添加成功');

                return $this->redirect(['brand/index']);
            }else{
                \Yii::$app->session->setFlash('warning','添加失败');
                var_dump($model->getErrors());exit;
            }

        }

        return $this->render('add',['model'=>$model]);
    }
//修改
    public function actionEdit($id){


        $model = Brand::findOne(['id' => $id]);
        $request = new Request();
        if($request->isPost){
            //加载表单信息
            $model->load($request->post());
            /*       var_dump($request);exit;*/
            //接收图片UploadedFile


            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            //验证提交数据
            /*     var_dump( $model->imgFile);exit;*/
            if($model->validate()){
//                var_;exit;
                //如果验证成功
                //var_dump($model->imgFile,$model);exit;
                //判断是否上传文件
                if($model->imgFile){
                    //  $fileName=
                    //  echo 111;exit;
                    //如果有图片上传
                    $d = \Yii::getAlias('@webroot').'/upload/'.date('Ymd');
                    if(!is_dir($d)){
                        mkdir($d);
                    }
                    $fileName='/upload/'.date('Ymd').'/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    $model->logo = $fileName;

                }
                //如果没有直接保存
                $model->save(false);
                \Yii::$app->session->setFlash('warning','修改成功');

                return $this->redirect(['brand/index']);
            }else{
                \Yii::$app->session->setFlash('warning','修改失败');
                var_dump($model->getErrors());exit;
            }

        }

        return $this->render('add',['model'=>$model]);


    }


public function actionDelete($id){
    $model = Brand::findOne(['id' => $id]);
    $model->status= -1;
    $model->save();
    return $this->redirect(['brand/index']);
}

//显示首页
    public function actionIndex()
    {
        $models=brand::find()->where(['>','status',-1])->all();

        return $this->render('index',['models'=>$models]);

    }
    public function actionQiniu(){

        $config = [
            'accessKey'=>'-VWQa-86xyStnKRybH4MXy3_wfkM-ojy9jORSH-q',
            'secretKey'=>'43rbK3TOVmDaE0FT6qkafWFLwxkmbTxH1fJ3P6Ty',
            'domain'=>'http://otfcjwnae.bkt.clouddn.com/',
            'bucket'=>'lichonglin',
            'area'=>Qiniu::AREA_HUADONG
        ];



        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES['tmp_name'],$key);
        $url = $qiniu->getLink($key);

    }

}
