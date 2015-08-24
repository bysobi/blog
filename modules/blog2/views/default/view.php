<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\PaginationPrevNext;
/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['/blog2']];
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
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
<div class="col-md-12">
  <div style="border-bottom: 1px solid #ddd">
      <div class="product_header">
        <h1 class="product"><?= $this->title ?></h1>Category: <span class="label label-info"><?= $model->category->title ?></span>

      </div>
      
    </div>
</div>
<div class="col-md-9 col-sm-8 post-view">
    <div class="panel-body">
        <?= ($model->img) ? Html::img($model->img, ['class'=>'img-thumbnail', 'alt'=> $model->title]) : ''  ?>
        <?= $model->text ?>
        <div class="alert alert-warning" role="alert">Created: <?= Yii::$app->formatter->asDate($model->created_at ,'long') ?> <?= Yii::$app->formatter->asTime($model->created_at,'short') ?><br>Updated: <?= Yii::$app->formatter->asDate($model->updated_at ,'long') ?> <?= Yii::$app->formatter->asTime($model->updated_at,'short') ?></div>
    <p>
        <?= PaginationPrevNext::widget(['timec' => $model->created_at]);?>
    </p>
   <div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'bysobiblog';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

    </div>
</div>
<div class="col-md-3 col-sm-4 pull-right sidebar post-view">
    <?php foreach ($modelCategory as $item): ?>
        <?= $item->title ?></br>
    <?php endforeach ?>
</div>


</div>
