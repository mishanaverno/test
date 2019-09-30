<?php

use app\models\Service;
use app\models\ServiceUser;
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
$users = ServiceUser::find()->all();
$items = ArrayHelper::map($users,'id','fullName');

echo $form->field($model, 'user')->dropdownList($items,
    ['prompt'=>'Select user']
);
echo $form->field($model, 'ip')->input('text');
echo $form->field($model, 'domain')->input('text');
?>
<div class="form-group">
        <?= Html::submitButton('Create', [
                'class' => 'btn btn-info',
            ]); ?>
</div>
<?php ActiveForm::end();