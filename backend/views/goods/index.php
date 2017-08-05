<?=\yii\bootstrap\Html::a('商品添加',['goods/add',],['class'=>'btn btn-sm btn-info']) ?>


<?php
$form = \yii\bootstrap\ActiveForm::begin([
    'method' => 'get',
    //get方式提交,需要显式指定action
    'action'=>\yii\helpers\Url::to(['goods/index']),
    'layout'=>'inline'
]);
echo $form->field($model,'name')->textInput(['placeholder'=>'商品名'])->label(false);
echo $form->field($model,'sn')->textInput(['placeholder'=>'货号'])->label(false);
echo $form->field($model,'minPrice')->textInput(['placeholder'=>'低价'])->label(false);
echo $form->field($model,'maxPrice')->textInput(['placeholder'=>'高价'])->label('-');
echo \yii\bootstrap\Html::submitButton('<span class="glyphicon glyphicon-search"></span>搜索',['class'=>'btn btn-sm btn-info']);
\yii\bootstrap\ActiveForm::end();
?>

<table class="table table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>商品名称</th>
        <th>货号</th>
        <th>LOGO图片</th>
        <th>商品分类</th>
        <th>品牌分类</th>
        <th>市场价格</th>
        <th>商品价格</th>
        <th>库存</th>
        <th>是否在售</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加时间</th>
        <th>浏览次数</th>
        <th>商品详情</th>
        <th>商品图片</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model): ?>
    <!--id	primaryKey
name	varchar(20)	商品名称
sn	varchar(20)	货号
logo	varchar(255)	LOGO图片
goods_category_id	int	商品分类id
brand_id	int	品牌分类
market_price	decimal(10,2)	市场价格
shop_price	decimal(10, 2)	商品价格
stock	int	库存
is_on_sale	int(1)	是否在售(1在售 0下架)
status	inter(1)	状态(1正常 0回收站)
sort	int()	排序
create_time	int()	添加时间
view_times	int()	浏览次数-->
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->sn?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50])?></td>
        <td><?=$model->goodsCategory->name?></td>
        <td><?=$model->brand->name?></td>
        <td><?=$model->market_price?></td>
        <td><?=$model->shop_price?></td>
        <td><?=$model->stock?></td>
        <td><?=$model->is_on_sale==1?'上架':'下架'?></td>
        <td><?php
            if($model->status==1){
                echo '正常';
            }else{
                echo '隐藏';
            }
            ?></td>
        <td><?=$model->sort?></td>
        <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
        <td></td>
        <td><?=\yii\bootstrap\Html::a('详情',['goods/add',]) ?></td>
        <td><?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-picture"></span>相册',['gallery','id'=>$model->id]) ?></td>
        <td><?=\yii\bootstrap\Html::a('修改',['goods/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['goods/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>


        <?php endforeach;?>
</table>
<?=\yii\widgets\LinkPager::widget([
    'pagination'=>$pager
])?>
