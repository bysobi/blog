<?php
use \yii\helpers\Url;
?>
  <ul class="pager">

	<?php if ($modelsPrev): ?>
		<li class="previous"><a href="<?=Url::to(['view', 'id' => $modelsPrev->id])?>" title="<?= $modelsPrev->title ?>"><span aria-hidden="true">&larr;</span> <?= $modelsPrev->title ?></a></li>
	<?php endif ?>

	<?php if ($modelsNext): ?>
		<li class="next"><a href="<?=Url::to(['view', 'id' => $modelsNext->id])?>" title="<?= $modelsNext->title ?>"><?= $modelsNext->title ?> <span aria-hidden="true">&rarr;</span></a></li>
	<?php endif ?>     
 
  </ul>
</nav>