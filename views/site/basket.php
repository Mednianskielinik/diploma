<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Menu */
/* @var $sum string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\MenuAsset;
use app\models\Menu;
use yii\widgets\Pjax;

MenuAsset::register($this);

$this->title = 'Sales Periods';
if (isset($request)) {
    print_r($request);
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= Breadcrumbs::widget(['homeLink' => ['label' => 'Home', 'url' => '/'],
                'links' => [['label' => $this->title],
                ],
            ]) ?>
        </div>
    </div>
</div>
<?php Pjax::begin(['timeout' => 7000,
    'id' => 'menuGridPjax',
]); ?>
<?php if (!empty(\Yii::$app->cart->getPositions())):?>
<div class="container-fluid">
    <div class="row">
        <div class="inner-page padd">
            <div class="shopping">
                <div class="container">
                    <div class="shopping-content">
                        <div class="row">
                            <?php foreach (\Yii::$app->cart->getPositions() as $item):?>
                            <div class="col-md-3 col-sm-6">
                                <div class="shopping-item">
                                    <a href="<?= \yii\helpers\Url::to(['menu/delete-from-cart', 'id' => $item->id])?>"><i class="fas fa-times-circle"></i></a>
                                    <img class="img-responsive" src="../img/<?=$item->image?>" alt="" />
                                    <h4 class="pull-left"><?=$item->name?></h4>
                                    <span class="item-price pull-right"><?=$item->cost?></span>
                                    <a href="<?= \yii\helpers\Url::to(['menu/minus-from-cart', 'id' => $item->id])?>"><div class="clearfix">Минус</div></a>
                                    <a href="<?= \yii\helpers\Url::to(['menu/plus-from-cart', 'id' => $item->id])?>"><div class="clearfix">Плюс</div></a>
                                    <div class="item-hover br-red hidden-xs"><?= $item->getQuantity()?></div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else:?>
    <div> Ваш заказ отправлен на обработку оператору</div>
<?php endif; ?>
<hr>
Итого: <?= $sum ?> <a href="<?= \yii\helpers\Url::to(['site/confirm-order'])?>" class="btn btn-success">Подтвердить заказ</a>
<?php Pjax::end(); ?>

