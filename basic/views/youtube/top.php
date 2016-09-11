<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/* @var $dataProvider yii\data\ArrayDataProvider */


use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'TOP';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'Amount_view',
        ['attribute' => 'LINK',
        'value' => function ($dataProvider) {
            return Html::a(Html::encode($dataProvider['LINK']), $dataProvider['LINK']);
        },
        'format' => 'raw'],
    ],
]);