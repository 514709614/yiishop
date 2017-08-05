
<?=\yii\bootstrap\Html::a('用户添加',['user/add',],['class'=>'btn btn-sm btn-info']) ?>
<?=\yii\bootstrap\Html::a('用户登录',['user/add',],['class'=>'btn btn-sm btn-info']) ?>





<table class="table table-bordered table-condensed">

    <tr>
        <th>ID</th>
        <th>用户名</th>

        <th>邮箱</th>
       <!-- <th>用户身份</th>-->
        <th>状态</th>
        <th>注册时间</th>
        <th>最后修改时间</th>
        <th>最后登录时间</th>
        <th>最后登录IP</th>
        <th>操作</th>

    </tr>
    <?php foreach($models as $model):?>
    <tr>

        <td><?=$model->id?></td>
        <td><?=$model->username?></td>

        <td><?=$model->email ?></td>
      <!--  <td><?/*=$model->auth_key*/?></td>-->
        <td><?=$model->status?></td>

        <td><?=date('Y-m-d H:i:s',$model->created_at)?></td>
        <td><?=date('Y-m-d H:i:s',$model->updated_at)?></td>
        <td><?=date('Y-m-d H:i:s',$model->last_login_time)?></td>
        <td><?=$model->last_login_ip?></td>



        <td><?=\yii\bootstrap\Html::a('修改',['user/edit','id'=>$model->id],['class'=>'btn btn-sm btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['goods-category/delete','id'=>$model->id],['class'=>'btn btn-sm btn-danger'])?></td>
        <?php endforeach;?>
</table>
