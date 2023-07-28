<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<main role="main-page" class="flex-shrink-0 main-page">
    <div class="container d-flex align-items-center justify-content-between">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class="img-sec position-relative">
            <?= Html::img(Yii::getAlias('@web/img/fb.png'), ['alt' => 'img woman', 'width' => '100', 'class' => 'fb-img']) ?>
            <?= Html::img(Yii::getAlias('@web/img/stats.png'), ['alt' => 'img woman', 'width' => '200', 'class' => 'stats-img']) ?>
            <?= Html::img(Yii::getAlias('@web/img/bann.png'), ['alt' => 'img woman', 'width' => '350']) ?>
            <?= Html::img(Yii::getAlias('@web/img/insta.png'), ['alt' => 'img woman', 'width' => '100', 'class' => 'insta-img']) ?>
        </div>

    </div>
</main>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
