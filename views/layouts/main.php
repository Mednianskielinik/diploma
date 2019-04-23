<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Order;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="simple-logo" src="../img/simpleLogo.png"',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Меню', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/menu/index']],
            ['label' => 'Скидочные этапы',  'visible' => Yii::$app->user->id == 1 , 'url' => ['/sales/index']],
            ['label' => 'Заказы '. Order::getCountNotConfirmOrder(),  'visible' => Yii::$app->user->id == 1 , 'url' => ['/site/orders']],
            ['label' => 'Пользователи', 'visible' => Yii::$app->user->id == 1,
                'items' => [
                    [
                        'label' => 'Пользователи',
                        'url' => ['/user/users'],
                    ],
                    [
                        'label' => 'Черный список',
                        'url' => ['/black-list/index'],
                    ],
                ],
            ],
            ['label' => 'Отчеты', 'visible' => Yii::$app->user->id == 1,
                'items' => [
                    [
                        'label' => 'Популярность товаров',
                        'url' => ['/reports/order-popularity'],
                    ],
                    [
                        'label' => 'Статистика заказов',
                        'url' => ['/reports/order-in-month'],
                    ],
                ],
            ],
            ['label' => 'Корзина '. "<span class='badge indicate-vacation text-center'
data-toggle='tooltip' title='You have few new vacation!' style='background-color: #ff5436' data-placement='bottom'>" .$itemsCount = \Yii::$app->cart->getCount()."</span>",
                'visible' => !Yii::$app->user->isGuest && \Yii::$app->cart->getCount() > 0 , 'url' => ['/site/basket']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Авторизация', 'url' => ['/user/sign-in']]
            ) : (['label' => 'Выйти (' . Yii::$app->user->identity->login . ')', 'url' => ['/user/logout']])
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
    </div>
    <?= $content ?>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
