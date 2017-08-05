<?php
namespace frontend\controllers;
use backend\models\GoodsCategory;
use backend\models\GoodsGallery;
use frontend\models\Goods;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Cookie;

class IndexController extends Controller{
    public $layout=false;
    public function actionIndex(){
        $model=GoodsCategory::find()->where(['=','parent_id','0'])->all();
        return $this->render('index',['models'=>$model]);
    }

    public function actionList($id){
        $pid=[];
        $pid1=GoodsCategory::find()->select('id')->where(['=','parent_id',$id])->all();
        if(empty($pid_0)){
            $pid[]=$id;
        }else{
            foreach ($pid_0 as $id_0){
                $pid[]=$id_0->id;
                $pid_1=GoodsCategory::find()->select('id')->where(['=','parent_id',$id_0->id])->all();
                foreach ($pid_1 as $id_1){
                    $pid[]=$id_1->id;
                }
            }
        }

        $model=\backend\models\Goods::find()->where(['in','goods_category_id',$pid])->all();

        return $this->render('list',['models'=>$model]);
    }
    //商品详情
    public function actionGoods($id){
        $model=\backend\models\Goods::findOne(['id'=>$id]);
       ;

            return $this->render('goods',['model'=>$model]);

    }

    public function actionAdd()
    {
       $goods_id=\Yii::$app->request->post('goods_id');
     /*   $goods_id = Yii::$app->request->post('goods_id');*/

        $amount = \Yii::$app->request->post('amount');
        $goods = \backend\models\Goods::findOne(['id'=>$goods_id]);
        if($goods==null){//NotFoundHttpException
            throw new NotFoundHttpException('商品不存在');
        }
        if(\Yii::$app->user->isGuest){
            //未登录
            //先获取cookie中的购物车数据
            $cookies = \Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');
            if($cookie == null){
                //cookie中没有购物车数据
                $cart = [];
            }else{
                $cart = unserialize($cookie->value);
                //$cart = [2=>10];
            }

            $cookies =\Yii::$app->response->cookies;

            if(key_exists($goods->id,$cart)){
                $cart[$goods_id] += $amount;
            }else{
                $cart[$goods_id] = $amount;
            }
//            $cart = [$goods_id=>$amount];
            $cookie = new Cookie([
                'name'=>'cart','value'=>serialize($cart)
            ]);
            $cookies->add($cookie);



        }else{
            //已登录 操作数据库
        }
        return $this->redirect(['index/cart']);
    }
    public function actionCart()
    {

        if(\Yii::$app->user->isGuest) {
            //取出cookie中的商品id和数量
            $cookies =\Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');

            if ($cookie == null) {
                //cookie中没有购物车数据
                $cart = [];
            } else {//unserialize
                $cart = unserialize($cookie->value);
            }
            $models = [];
            foreach ($cart as $good_id => $amount) {
                $goods = \backend\models\Goods::findOne(['id' => $good_id])->attributes;
                $goods['amount'] = $amount;
                $models[] = $goods;
            }
            //var_dump($models);exit;

        }else{
            //从数据库获取购物车数据
        }
        return $this->render('cart', ['models' =>$models]);
    }
    public function actionUpdateCart()
    {
        $goods_id = Yii::$app->request->post('goods_id');
      /*  var_dump($goods_id);exit;*/
        $amount = Yii::$app->request->post('amount');
        $goods = Goods::findOne(['id'=>$goods_id]);
        if($goods==null){
            throw new NotFoundHttpException('商品不存在');
        }
        if(Yii::$app->user->isGuest){
            //未登录
            //先获取cookie中的购物车数据
            $cookies = Yii::$app->request->cookies;
            $cookie = $cookies->get('cart');
            if($cookie == null){
                //cookie中没有购物车数据
                $cart = [];
            }else{
                $cart = unserialize($cookie->value);
                //$cart = [2=>10];
            }

            $cookies = Yii::$app->response->cookies;

            if($amount){

                $cart[$goods_id] = $amount;
                var_dump($cart[$goods_id] );exit;
            }else{
                if(key_exists($goods['id'],$cart)) unset($cart[$goods_id]);
            }

//            $cart = [$goods_id=>$amount];
            $cookie = new Cookie([
                'name'=>'cart','value'=>serialize($cart)
            ]);
            $cookies->add($cookie);

        }else{
            //已登录  修改数据库里面的购物车数据
        }

    }


}