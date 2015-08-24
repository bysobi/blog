<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\CheckboxColumn;
//use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = ['label' => 'Admin menu', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '<div class="GridViewSummary">{summary}</div><div class="panel panel-default"><div class="table-responsive">{items}</div><div class="table-footer">{pager}</div></div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['style'=>'text-align:center','width' => '20'],
            ],
            [
            'class' => 'yii\grid\DataColumn',
            'attribute' => 'id',
            'label'=>'ID',
            'contentOptions' => ['style'=>'text-align:center'],
            'headerOptions' => ['width' => '120','style'=>'text-align:center'],
            'value' => 'id',
            ],
            [
            'class' => 'yii\grid\DataColumn',
            'attribute' => 'title',
            'label'=>'Title',
            'format' => 'html',
            'contentOptions' => ['style'=>'text-align:center'],
            'headerOptions' => ['style'=>'text-align:center'],
            'value' => function($model) {
                return Html::a(
                    $model['title'],
                    ['update','id' => $model['id']]
                    );
            },
            ],
            [
            'class' => 'yii\grid\DataColumn',
            'attribute' => 'category_status',
            'label'=>'Status',
            'format' => 'html',
            'filter' => ([$model->category_status.active => 'Active', $model->category_status.inactive => 'Inactive']),
            'contentOptions' => ['style'=>'text-align:center'],
            'headerOptions' => ['width' => '120','style'=>'text-align:center'],
            'value' => function ($model) {
                $class = ($model->category_status === 'active') ? 'label-success' : 'label-danger';
                return '<span class="label ' . $class . '">' .$model->category_status. '</span>';
            },
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Setting',
            'contentOptions' => ['width' => '50','style' => 'background:white;text-align:center'],
            'template' => '{update} {delete}',
            ], 
       
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
