<?php

$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($model,'password')->passwordInput();
echo \yii\bootstrap\Html::submitButton('登陆',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();