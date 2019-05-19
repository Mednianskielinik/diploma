<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $model app\models\Menu */
/* @var $dish string */

use yii\helpers\Html;
use app\assets\MenuAsset;
use app\models\Menu;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FAS;

MenuAsset::register($this);
\macgyer\yii2materializecss\assets\MaterializeAsset::register($this);

$this->title = 'Меню';
$icon = FAS::icon('edit', ['class' => 'fa-fw',]);
?>

<div class="container">
    <div class="add-menu">
        <?= $this->render('@app/views/menu/partial/modal', [
                'model' => new Menu(),
        ]); ?>
    </div>
</div>

<div class="container">
    <div class="wrap-dish-type">
        <div class="col-lg-2 col-md-2 col-xs-2 center-block">
            <?= Html::a('Все',
                [
                    'menu/index',
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
                        'menu/index',
                        'category' => $key,
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
</div>

<div class="container">
    <?php Pjax::begin(['timeout' => 7000,
        'id' => 'menuGridPjax',
    ]); ?>
    <div class="wrapper">
        <?php if (!empty($dataProvider)): ?>
            <?php foreach ($dataProvider->getModels() as $item): ?>
                <div class="card">
                    <div class="card-image">
                        <div class="image-block">
                            <span class="menu-weight"><?= $item->weight ?> грамм</span>
                            <span class="menu-cost"><?= $item->cost ?> BYN</span>
                            <img class="menu-image" src="../img/<?= $item->image ?>">
                        </div>
                        <span class="card-title"><?= $item->name ?></span>
                        <?php if (Yii::$app->user->id !== 1 && !Yii::$app->user->isGuest) : ?>
                            <a href="<?= \yii\helpers\Url::to(['menu/add-to-cart', 'id' => $item->id]) ?>"
                               class="btn-floating btn-large halfway-fab waves-effect waves-light red"><i
                                        class="material-icons">add_shopping_cart</i></a>
                        <?php elseif(Yii::$app->user->id == 1): ?>
                            <a href="<?= \yii\helpers\Url::to(['menu/update-menu', 'id' => $item->id]) ?>"
                               class="btn-floating halfway-fab waves-effect waves-light red menu-update"><i
                                        class="material-icons update">create</i></a>
                            <a href="<?= \yii\helpers\Url::to(['menu/delete-menu', 'id' => $item->id]) ?>"
                               class="btn-floating btn-large halfway-fab waves-effect waves-light red menu-delete"><i
                                        class="material-icons">delete</i></a>
                        <?php endif; ?>
                    </div>
                    <div class="card-content">
                        <p><?= $item->components ?></p>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php Pjax::end(); ?>
</div>

