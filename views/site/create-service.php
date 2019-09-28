<?php

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create service';
?>
<h2>Create service</h2>
<?php
$form = ActiveForm::begin(['options' => ['data-pjax' => false]]); 
    

echo $form->field($model, 'type')->dropdownList(
    [
        'hosting' => 'Hosting',
        'proxy' => 'Proxy'
    ],
    ['prompt'=>'Select type']
);
$users = User::find()->all();
$items = ArrayHelper::map($users,'id','fullName');

echo $form->field($model, 'user')->dropdownList($items,
    ['prompt'=>'Select user']
);
echo $form->field($model, 'ip')->input('text');
echo $form->field($model, 'domain')->input('text');
?>
<div class="form-group">
        <?= Html::submitButton('Update', [
                'class' => 'btn btn-info',
                'data-pjax' => '1',
                'onClick' => "$('#modal').modal('hide')",
                
            ]); ?>
</div>
<?php ActiveForm::end();