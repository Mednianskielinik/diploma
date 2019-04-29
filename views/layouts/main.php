<?php

/* @var $this \yii\web\View */
/* @var $content string */

/* @var $model \app\models\Menu */

use app\widgets\Alert;
use yii\helpers\Html;
use macgyer\yii2materializecss\widgets\navigation\Nav;
use macgyer\yii2materializecss\widgets\navigation\NavBar;
use macgyer\yii2materializecss\widgets\navigation\SideNav;
use macgyer\yii2materializecss\widgets\form\ActiveForm;
use app\assets\AppAsset;
use app\models\Order;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php NavBar::begin([
    'renderSidenav' => false,
    'brandLabel' => '<img class="simple-logo" src="../img/simpleLogo.png">',
    'brandUrl' => Yii::$app->homeUrl,
    'brandOptions' => ['class' => 'brand-logo center'],
    'options' => [
        'class' => 'navbar-fixed-top',
    ],]);
echo SideNav::widget([
    'encodeLabels' => false,
    'items' => [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Меню', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/menu/index']],
        ['label' => 'Скидочные этапы', 'visible' => Yii::$app->user->id == 1, 'url' => ['/sales/index']],
        ['label' => 'Заказы ' . Order::getCountNotConfirmOrder(), 'visible' => Yii::$app->user->id == 1, 'url' => ['/site/orders']],
        ['label' => 'Пользователи', 'visible' => Yii::$app->user->id == 1, 'url' => ['/user/users']],
        ['label' => 'Черный список', 'visible' => Yii::$app->user->id == 1, 'url' => ['/black-list/index']],
        ['label' => 'Отчет популярность товаров', 'visible' => Yii::$app->user->id == 1, 'url' => ['/reports/order-popularity']],
        ['label' => 'Отчеты статистика заказов', 'visible' => Yii::$app->user->id == 1, 'url' => ['/reports/order-in-month']],
        ['label' => 'Корзина ' . "<span class='badge indicate-vacation text-center'
data-toggle='tooltip' title='You have few new vacation!' style='background-color: #ff5436' data-placement='bottom'>" . $itemsCount = \Yii::$app->cart->getCount() . "</span>",
            'visible' => !Yii::$app->user->isGuest && \Yii::$app->cart->getCount() > 0, 'url' => ['/site/basket']],
        ['label' => 'Авторизация', 'visible' => Yii::$app->user->isGuest, 'url' => ['/user/login']],
        Yii::$app->user->isGuest ? (
        ['label' => 'Регистрация', 'url' => ['/user/sign-in']]
        ) : ('<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->login . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>')
    ],
]);
echo Nav::widget([
    'encodeLabels' => false,
    'items' => [['label' => '          
     <div id="cover">
         <form method="get" action="'.\yii\helpers\Url::to(['/site/search']).'">
             <div class="wrap form-search">
                 <div class="search">
                     <input name = "searchMenu" type="text" class="searchTerm" placeholder="Поиск">
                     <button type="submit" class="searchButton">
                         <i class="fa fa-search"></i>
                     </button>
                 </div>
             </div>
         </form>
     </div>'
    ]],
]);
NavBar::end();
?>
<?= $content ?>
</div>

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Footer Content</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                        content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2014 Copyright Text
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
