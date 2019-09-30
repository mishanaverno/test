<?php

use app\models\ServiceUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

Pjax::begin(['enablePushState' => false]);
$form = ActiveForm::begin(['options' => ['data-pjax' => true]]); 
    

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
        <?= Html::submitButton('Update', [
                'class' => 'btn btn-info',
                'data-pjax' => '1',
                'onClick' => "$('#modal').modal('hide')",
                
            ]); ?>
</div>
<?php ActiveForm::end();
Pjax::end();
