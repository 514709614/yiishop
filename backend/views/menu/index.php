<?php

/* @var $this yii\web\View */
?>
<?=\yii\bootstrap\Html::a('菜单添加',['menu/add',],['class'=>'btn btn-sm btn-info']) ?>


<table class="table">


    <tr>

        <th>名称</th>
        <th>路由</th>
        <th>排序</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->label?></td>
            <td><?=$model->url?></td>
            <td><?=$model->sort?></td>
        </tr>
        <?php foreach($model->children as $child):?>
            <tr>
                <td>~~<?=$child->label?></td>
                <td><?=$child->url?></td>
                <td><?=$child->sort?></td>
                <td><?=\yii\bootstrap\Html::a('修改',['menu/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
                    <?=\yii\bootstrap\Html::a('删除',['goods-category/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>
            </tr>

        <?php endforeach;?>
    <?php endforeach;?>
</table>
