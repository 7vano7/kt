<?php

use app\modules\city\models\City;
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\city\formatter\CityFormatter;
use app\modules\users\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel */

$this->title = Yii::t('admin', 'Streets');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Streets'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'List'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="device-index">
            <div class="menu-index">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'street',
                        [
                            'attribute' => 'city_ref',
                            'value' => function ($data) {
                                if($data->parent)
                                    return $data->parent->city;
                                else
                                    return 'not set';
                            },
                            'filter'=>City::listItems(),
                            'format' => 'raw',
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
