<?php
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create user';
?>
<h2>Create user</h2>
<?php
$form = ActiveForm::begin(['options' => ['data-pjax' => false]]); 
echo $form->field($model, 'first_name')->input('text');
echo $form->field($model, 'last_name')->input('text');
?>
<div class="form-group">
        <?= Html::submitButton('Create', [
                'class' => 'btn btn-info',
            ]); ?>
</div>
<?php ActiveForm::end();