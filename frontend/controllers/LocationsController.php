<?php
namespace frontend\controllers;
use frontend\models\Locations;
use frontend\models\OrderForm;
use yii\helpers\Html;
use yii\web\Controller;

class LocationsController extends Controller{
    public function actionIndex(){
        $new =new OrderForm();
        return $this->render('index',['model'=>$new]);
    }
    public function actionSite($pid, $typeid = 0)
    {
        $model = new Locations();
        $model = $model->getCityList($pid);

        if($typeid == 1){$aa="--请选择市--";}else if($typeid == 2 && $model){$aa="--请选择区--";}

        echo Html::tag('option',$aa, ['value'=>'empty']) ;

        foreach($model as $value=>$name)
        {
            echo Html::tag('option',Html::encode($name),array('value'=>$value));
        }
    }
}