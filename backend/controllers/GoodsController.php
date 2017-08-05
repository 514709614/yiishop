<?php

namespace backend\controllers;

use backend\models\Goods;

use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsIntro;
use backend\models\GoodsSearchForm;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use flyok666\uploadifive\UploadAction;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {     $model = new GoodsSearchForm();
        $hahaha=Goods::find();
        $model->search($hahaha);
        $pager = new Pagination([
            'totalCount'=>$hahaha->count(),
            'pageSize'=>5
        ]);
        $models = $hahaha->limit($pager->limit)->offset($pager->offset)->all();

        return $this->render('index',['models'=>$models,'pager'=>$pager,'model'=>$model]);
    }
    public function actionAdd(){
        $model = new Goods();
        $model2 = new GoodsIntro();


        $request = new Request();

        if($request->isPost){
            $model->load($request->post());
            $model2->load($request->post());


            if($model->validate()){
            //添加商品货号
            var_dump($model->logo);exit;
                $day = date('Y-m-d');
                $goodsCount = GoodsDayCount::findOne(['day'=>$day]);
                if($goodsCount==null){
                    $goodsCount = new GoodsDayCount();
                    $goodsCount->day = $day;
                    $goodsCount->count = 0;
                    $goodsCount->save();
                }

                $model->sn = date('Ymd').substr('000'.($goodsCount->count++),-4,4);;
//                var_dump($model->sn);exit;


                $model->create_time = time();
                $model->save();
                $model2->goods_id=$model->id;
                $model2->save();
                \Yii::$app->session->setFlash('warning','添加成功');

                return $this->redirect(['goods/index']);
            }else{
                //验证不通过，打印错误信息
                var_dump($model->getErrors());exit;
            }
        }
            return $this->render('add',['model'=>$model,'model2'=>$model2]);

}

    public function actionEdit($id)
    {
        $model = Goods::findOne(['id' => $id]);
        $model2=GoodsIntro::findOne(['goods_id'=> $id]);

;

        $request = new Request();

        if($request->isPost){
            $model->load($request->post());
            $model2->load($request->post());


            if($model->validate()){
                //添加商品货号

                $day = date('Y-m-d');
                $goodsCount = GoodsDayCount::findOne(['day'=>$day]);
                if($goodsCount==null){
                    $goodsCount = new GoodsDayCount();
                    $goodsCount->day = $day;
                    $goodsCount->count = 0;
                    $goodsCount->save();
                }
                //$goodsCount;
                //字符串长度补全
                //substr('000'.($goodsCount->count+1),-4,4);
                $model->sn = date('Ymd').sprintf("%04d",$goodsCount->count+1);

                $model->create_time = time();
                $model->save();
                $model2->goods_id=$model->id;
                $model2->save();
                \Yii::$app->session->setFlash('warning','修改成功');

                return $this->redirect(['goods/index']);
            }else{
                //验证不通过，打印错误信息
                var_dump($model->getErrors());exit;
            }
        }
        return $this->render('add',['model'=>$model,'model2'=>$model2]);



    }
    public function actionGallery($id)
    {

        $goods = Goods::findOne(['id'=>$id]);

        if($goods == null){//NotFoundHttpException
            throw new NotFoundHttpException('商品不存在');
        }



        return $this->render('gallery',['goods'=>$goods]);

    }
    public function actionDelGallery(){
        $id = \Yii::$app->request->post('id');
        $model = GoodsCategory::findOne(['id'=>$id]);
        if($model && $model->delete()){
            return 'success';
        }else{
            return 'fail';
        }

    }
    public function actionDelete($id){
        $model = Goods::findOne(['id' => $id]);
        $model->status= 0;
        $model->save();
        return $this->redirect(['goods/index']);
    }


    public function actions() {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://admin.yiishop.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/{yyyy}{mm}{dd}/{time}{rand:6}" ,//上传保存路径
                    "imageRoot" => \Yii::getAlias("@webroot"),
                ],
            ],
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                //'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,//如果文件已存在，是否覆盖
                /* 'format' => function (UploadAction $action) {
                     $fileext = $action->uploadfile->getExtension();
                     $filename = sha1_file($action->uploadfile->tempName);
                     return "{$filename}.{$fileext}";
                 },*/
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },//文件的保存方式
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $goods_id = \Yii::$app->request->post('goods_id');
                    if($goods_id){
                        $model = new GoodsCategory();
                        $model->goods_id = $goods_id;
                        $model->path = $action->getWebUrl();
                        $model->save();
                        $action->output['fileUrl'] = $model->path;
                        $action->output['id'] = $model->id;
                    }else{
                        $action->output['fileUrl'] = $action->getWebUrl();//输出文件的相对路径
                    }



//                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
//                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
//                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"

                },
            ],
        ];
    }

}
