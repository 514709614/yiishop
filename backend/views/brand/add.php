<?php
$form=\yii\bootstrap\ActiveForm::begin();//表单开始
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'imgFile')->fileInput();
if($model->logo){
 echo  \yii\bootstrap\Html::img($model->logo,['height'=>50]);

}
echo $form->field($model,'sort');
echo $form->field($model,'status')->radioList(backend\models\Brand::$status_options);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();//表单结束