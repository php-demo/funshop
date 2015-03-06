<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BonusTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bonus Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonus-type-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create ') . Yii::t('app', 'Bonus Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'money',
            'min_amount',
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function ($model) {
                    return \common\models\BonusType::labels($model->type);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'type',
                    \common\models\BonusType::labels(),
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'PROMPT_STATUS')]
                )
            ],
            'started_at:date',
            'ended_at:date',
            // 'min_goods_amount',
            'created_at:date',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {car-type}',
                'buttons' => [
                    'car-type' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-subtitles"></span>', $url, [
                            'title' => Yii::t('app', 'Send Bonus'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return ['view', 'id' => $model->id];
                    } else if ($action === 'update') {
                        return ['update', 'id' => $model->id];
                    } else if ($action === 'delete') {
                        return ['delete', 'id' => $model->id];
                    } else if ($action === 'car-type') {
                        return ['send', 'id' => $model->id];
                    }
                }
            ],
        ],
    ]); ?>

</div>
