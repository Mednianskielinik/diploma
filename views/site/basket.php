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
<?php if (!empty(\Yii::$app->cart->getPositions())):?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            Итого: <?= $sum ?> BYN <a href="<?= \yii\helpers\Url::to(['site/confirm-order'])?>" class="btn btn-success">Подтвердить заказ</a>
            <hr>
        </div>
    </div>
</div>
<?php Pjax::begin(['timeout' => 7000,
    'id' => 'menuGridPjax',
]); ?>
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
                                    <div class="add-to-cart"><a href="<?= \yii\helpers\Url::to(['menu/delete-from-cart', 'id' => $item->id])?>"><i class="fas fa-times-circle"></i> Убрать из корзины</a></div>
                                    <div class="image"><img class="img-responsive" src="../img/<?=$item->image?>" alt="" /></div>
                                    <div class="product"><h4><?=$item->name?></h4></div>
                                    <div class="item-price"><?=$item->cost?> BYN</div>
                                    <div class="item-weight"><?=$item->weight?> грамм</div>
                                    <a href="<?= \yii\helpers\Url::to(['menu/plus-from-cart', 'id' => $item->id])?>"><div class="clearfix"><i class="fas fa-plus-circle"></i></div></a>
                                    <div class="item-hover br-red hidden-xs"><?= $item->getQuantity()?></div>
                                    <a href="<?= \yii\helpers\Url::to(['menu/minus-from-cart', 'id' => $item->id])?>"><div class="clearfix"><i class="fas fa-minus-circle"></i></div></a>
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
    <?php Pjax::end(); ?>
<?php else:?>
    <div> Ваш заказ отправлен на обработку оператору</div>
<?php endif; ?>


