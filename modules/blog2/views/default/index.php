<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="post-index">
<?php Pjax::begin(); ?>
<div class="col-sm-8 post-index">
  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <p>
    <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-warning']) ?>
  </p>
<?php foreach ($posts as $item): ?>
  <h2><a href="<?=Url::to(['view', 'id' => $item->id])?>" title="<?= $item->title ?>"><?= $item->title ?></a></h2>
  <div class="meta">
    <p>
      Author: <span class="label label-primary">Pavel</span> 
      Date public: <?= Yii::$app->formatter->asDate($item->created_at,'long') ?> 
      Category: <span class="label label-primary"><?= $item->category->title ?></span>
      Comments: <span class="label label-primary"><a href="<?=Url::to(['view', 'id' => $item->id])?>#disqus_thread">0</a></span>
    </p>
  </div>
      <?= ($item->img) ? Html::img($item->img, ['class'=>'img-thumbnail', 'alt'=> $item->title]) : '' ?>
  <div class="content">
      <?= $item->description ?>
  </div>
  <a class="btn btn-info" href="<?=Url::to(['view', 'id' => $item->id])?>">Read more..</a>
  <hr>
<?php endforeach ?>
<?= \yii\widgets\LinkPager::widget([
  'pagination' => $pages,
]); ?>
</div>
<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
 <div class="panel panel-default">
        <div class="panel-heading">Categories</div>
        <div class="panel-body">
          <?php foreach ($modelCategory as $item): ?>
            <?= $item->title ?> <?= $item->id ?></br>
          <?php endforeach ?>
        </div>
  </div>
</div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'bysobiblog';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
<?php Pjax::end(); ?>
</div>
