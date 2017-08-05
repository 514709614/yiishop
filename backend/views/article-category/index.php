<?=\yii\bootstrap\Html::a('分类添加',['article-category/add',],['class'=>'btn btn-sm btn-info']) ?>
<?=\yii\bootstrap\Html::a('文章',['article/index',],['class'=>'btn btn-sm btn-danger']) ?>


<table class="table table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>文章分类</th>
        <th>简介</th>
        <th>排序</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model): ?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=$model->sort?></td>
        <td><?php
            if($model->status==1){
                echo '正常';
            }else{
                echo '隐藏';
            }
            ?></td>
        <td><?=\yii\bootstrap\Html::a('修改',['article-category/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['article-category/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>
        <?php endforeach;?>
</table>
