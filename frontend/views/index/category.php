
        <h2>全部商品分类</h2>
        <em></em>
    </div>

    <div class="cat_bd">
        <?php foreach ($models as $model):?>
            <div class="cat item1">
                <h3><?php

                    //顶级分类
                    foreach (\frontend\models\GoodsCategory::findAll(['parent_id'=>$model->id]) as $value){
                        echo \yii\bootstrap\Html::a($value->name,['index/list','id'=>$model->id]);
                    }

                    //                            if ($model->parent_id ==0){
                    //                                echo $model->name;
                    //                            }
                    ?> <b></b></h3>

                <div class="cat_detail">
                    <dl class="dl_1st">
                        <dt>

                            <?php
                            //二级分类
                            $goods=\frontend\models\GoodsCategory::getGoodsCategory($model->id,1);
                            if (  $goods){
                            echo  \yii\bootstrap\Html::a($goods->name,['index/list','id'=>$model->id]);
                            ?>

                        </dt>
                        <dd>
                            <?php
                            //三级分类
                            $goods2=  \frontend\models\GoodsCategory::getGoodsCategory($goods->id,2);
                            if ($goods2){
//                                        var_dump($goods2->name);exit;
                                echo \yii\bootstrap\Html::a($goods2->name,['index/list
','id'=>$goods2->id]);
                            }
                            ?>
                        </dd>
                        <?php
                        }
                        ?>
                    </dl>
                </div>
            </div>
        <?php endforeach;?>

