<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Site',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top wet-asphalt',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    [
                        'label' => 'Blog', 'url' => ['/blog'],
                        'items' => [
                            ['label' => 'Blog', 'url' => ['/blog2']],
                           //['label' => 'Posts', 'url' => ['/blog2/post']],
                        ],
                    ],

                    ['label' => 'Articles', 'url' => ['/site/articles']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    [
                        'label' => 'Admin', 'url' => ['/admin'],
                        'items' => [
                            ['label' => 'Mysql', 'url' => ['/openserver/phpmyadmin']],
                            '<li class="divider"></li>',
                            ['label' => 'Gii', 'url' => ['/gii']],
                            '<li class="divider"></li>',
                            ['label' => 'Admin menu', 'url' => ['/admin']],
                            '<li class="divider"></li>',
                            ['label' => 'Categories', 'url' => ['/admin/category']],
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Site <?= date('Y') ?></p>
            
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
