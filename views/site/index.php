<?php

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

$this->title = 'Services';
Pjax::begin(['enablePushState' => false]);
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>[
        'id',
        [
            'label' => 'type',
            'attribute' => 'type',
            'filter' => ['hosting' => 'Hosting', 'proxy' => 'Proxy'],
            'filterInputOptions' => ['prompt'=>'all','class' => 'form-control', 'id' => null]
        ],
        'userName.fullName',
        'ip',
        'domain',
        [
            'class' => 'yii\grid\ActionColumn',
            'buttons'=>[
                'update' => function($url, $dataProvider, $key) {
                    return Html::button('<span class="glyphicon glyphicon-pencil"></span>', 
                    [
                        'value'=> Url::to(['site/update','id' => $dataProvider->id]), 
                        'class' => 'btn-update btn btn-info',
                        'data-pjax' => '0',
                    ]);
                },
                'delete'=>function ($url, $model) {
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', 
                    $url,
                    [
                        'title' => Yii::t('yii', 'Delete'),
                        'class'=>'btn btn-danger',
                        'data-pjax' => '1'
                    ]);
                }
            ],
            'template'=>'{update}  {delete}',
        ]
    ]
]);
$this->registerJs("
$(function(){
    $('button.btn-update').click(function(){
        var container = $('#modalContent');
        // Очищаем контейнер
        container.html('Please wait, the data is being loading...');
        // Выводим модальное окно, загружаем данные
        $('#modal').modal('show')
                .find(container)
                .load($(this).attr('value'));
    });
});
");
Pjax::end();
Modal::begin([
    'header'=>'<h4>Update service</h4>',
    'id'=>'modal',
    'size'=>'modal-lg',
    
    
]);
echo '<div id="modalContent"></div>';
Modal::end();

?>

