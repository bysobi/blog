<?php 

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\blog2\models\Post;

class PaginationPrevNext extends Widget
{
    public $timec = 0;
    function run()
    {
		$cacheId = $this->timec . 'post';
		
		$baseQuery = Post::find()
			->select(['id', 'title'])
            ->orderBy('created_at');
			
        if (($modelsPrev = Yii::$app->cache->get($cacheId.'prev')) === false) {
			$modelsPrev = $baseQuery->where(['>', 'created_at', $this->timec])->one();
			Yii::$app->cache->set($cacheId.'prev', $modelsPrev, 3600);
		}    
        
		if (($modelsNext = Yii::$app->cache->get($cacheId.'next')) === false) {
			$modelsNext = $baseQuery->where(['<', 'created_at', $this->timec])
				->orderBy('created_at DESC')
				->one();
			Yii::$app->cache->set($cacheId.'next', $modelsNext, 3600);
		}
		
        return $this->render('PaginationPrevNext', compact('modelsPrev', 'modelsNext'));
    }
}

?>