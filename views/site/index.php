<?php

use macgyer\yii2materializecss\widgets\media\Carousel;
use app\assets\MenuAsset;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dish string */

MenuAsset::register($this);
$this->title = 'My Yii Application';
?>

<div class="main-container">
    <img src="../img/slider2.png" width="100%">
    <div class="logo">
        <img src="../img/logo.png">
    </div>
    <div class="dishes">
        <div class="dish-type">
            <div class="col-lg-2 col-md-2 col-xs-2 center-block">
                <?= Html::a('Все',
                    [
                        'site/index',
                    ],
                    [
                        'class' => 'dish-type-button btn btn-warning btn_width_95',
                    ]
                ); ?>
            </div>
            <?php foreach ($model->categories as $key => $category) : ?>
                <div class="col-lg-2 col-md-2 col-xs-2 center-block">
                    <?= Html::a($category,
                        [
                            'site/index',
                            'searchMenu' => $key,
                        ],
                        [
                            'class' => $key == $dish
                                ? 'dish dish-type-button btn btn-warning btn_width_95'
                                : 'dish-type-button btn btn-warning btn_width_95',
                        ]
                    ); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="wrapper">
            <?php if (!empty($dataProvider)): ?>
                <?php foreach ($dataProvider->getModels() as $item): ?>
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator main-cart-image" src="../img/<?= $item->image ?>">
                        </div>
                        <div class="card-content">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <p><a class="link-to-autorization"
                                      href="<?= \yii\helpers\Url::to(['/user/login']) ?>">Для заказа блюда необходимо
                                        авторизироваться</a></p>
                            <?php else: ?>
                                <div class="addInShopCart">
                                    <p><a href="<?= \yii\helpers\Url::to(['menu/add-to-cart', 'id' => $item->id]) ?>"
                                          class="btn-floating btn-large halfway-fab waves-effect waves-light red"><i
                                                    class="material-icons">add_shopping_cart</i></a></p>
                                </div>
                            <?php endif; ?>
                            <span class="card-title activator grey-text text-darken-4"><?= $item->name ?><i
                                        class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><?= $item->name ?><i
                                        class="material-icons right">close</i></span>
                            <p><?= $item->cost . ' BYN  ' . $item->weight . ' грамм' ?></p>
                            <p><?= $item->components ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>