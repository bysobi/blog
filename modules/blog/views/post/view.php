<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\blog\models\CategoryPosts;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div>
        <?= $model->text ?>

        <div class="tags">
            <?php
            $categories = [];
            foreach($model->getCategoryPosts()->all() as $postCat) {
                /**
                 * @var $postCat app\modules\blog\models\CategoryPosts
                 */
                $category = $postCat->getCategory()->one();
                $categories[] = $category->title;
            }

            ?>

           Categories: <?= implode(', ', $categories) ?>
        </div>
    </div>

</div>
