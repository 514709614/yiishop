<?php
$form=\yii\bootstrap\ActiveForm::begin();//表单开始
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'article_category_id')->dropDownList(backend\models\Article::getArticleCategoryOptions());
echo $form->field($model,'sort');
echo $form->field($model2,'content')->textarea();
echo $form->field($model,'status')->radioList(backend\models\ArticleCategory::$status_options);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();//表单结束




/*id	primaryKey
name	varchar(50)	名称
intro	text	简介
article_category_id	int()	文章分类id
sort	int(11)	排序
status	int(2)	状态(-1删除 0隐藏 1正常)
create_time	int(11)	创建时间
article_detail 文章详情*/
