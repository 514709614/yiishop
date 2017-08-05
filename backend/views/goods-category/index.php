<?=\yii\bootstrap\Html::a('分类添加',['goods-category/add',],['class'=>'btn btn-sm btn-info']) ?>



<table class="table table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>分类名称</th>
        <th>所属分类</th>
        <th>简介</th>
        <th>操作</th>
    </tr>
<!--    id	primaryKey
    tree	int()	树id
    lft	int()	左值
    rgt	int()	右值
    depth	int()	层级
    name	varchar(50)	名称
    parent_id	int()	上级分类id
    intro	text()	简介-->
    <?php foreach($models as $model): ?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->parent_id ?></td>
        <td><?=$model->intro?></td>


        <td><?=\yii\bootstrap\Html::a('修改',['goods-category/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['goods-category/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>
        <?php endforeach;?>
</table>
