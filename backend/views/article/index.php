<?=\yii\bootstrap\Html::a('文章添加',['article/add',],['class'=>'btn btn-sm btn-info']) ?>



<table class="table table-bordered table-condensed">
    <tr>
        <th>ID</th>
        <th>文章名称</th>
        <th>简介</th>
        <th>分章分类</th>
        <th>排序</th>
        <th>状态</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <!--    id	primaryKey
        name	varchar(50)	名称
        intro	text	简介
        article_category_id	int()	文章分类id
        sort	int(11)	排序
        status	int(2)	状态(-1删除 0隐藏 1正常)
        create_time	int(11)	创建时间-->
    <?php foreach($models as $model): ?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->intro?></td>
        <td><?=$model->articleCategory->name ?></td>
        <td><?=$model->sort?></td>

        <td><?php
            if($model->status==1){
                echo '正常';
            }else{
                echo '隐藏';
            }
            ?></td>

        <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
        <td><?=\yii\bootstrap\Html::a('修改',['article/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['article/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>
        <?php endforeach;?>
</table>
