<?=\yii\bootstrap\Html::a('商品添加',['brand/add',],['class'=>'btn btn-sm btn-info']) ?>

<table class="table table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>品牌名称</th>
        <th>品牌简介</th>
        <th>品牌图片</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model): ?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=\yii\bootstrap\Html::img($model->logo,['height'=>50])?></td>
        <td><?=$model->sort?></td>
        <td><?php
            if($model->status==1){
                echo '正常';
            }else{
                echo '隐藏';
            }
            ?></td>
        <td><?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['brand/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>
        <?php endforeach;?>
</table>
