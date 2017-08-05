<?php
$form=\yii\bootstrap\ActiveForm::begin();//表单开始
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList(backend\models\ArticleCategory::$status_options);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();//表单结束