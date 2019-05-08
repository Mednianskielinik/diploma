<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Menu */

/* @var $sum string */

use app\models\Sales;
use app\assets\MenuAsset;
use app\models\BlackList;
use app\models\BlackListSettings;
use app\models\Menu;
use yii\widgets\Pjax;

MenuAsset::register($this);

$this->title = 'Sales Periods';
if (isset($request)) {
    print_r($request);
}
$totalSum = Sales::getSumWithSale($sum, Yii::$app->user->id, (new \DateTime('now'))->format('Y-m-d H:i:s'));
$fine = BlackListSettings::getFine();
?>
<?php if (!empty(\Yii::$app->cart->getPositions())): ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                Сумма заказа: <?= $sum ?> BYN <br>
                Ваша скидка: <?= Sales::getSale(Yii::$app->user->id, (new \DateTime('now'))->format('Y-m-d H:i:s')) ?>
                %<br>
                <?php if (BlackList::isUserInBlackList(Yii::$app->user->id) && BlackList::userCountDayInBlackList(Yii::$app->user->id) > 0): ?>
                    Штраф : <?= $fine ?> <br>
                <?php endif; ?>
                Итого: <?= $totalSum + $fine ?>
                <br><a href="<?= \yii\helpers\Url::to(['site/confirm-order']) ?>" class="btn btn-success">Подтвердить
                    заказ</a>
                <hr>
            </div>
        </div>
    </div>
<div class="container">
    <?php Pjax::begin(['timeout' => 7000,
        'id' => 'menuGridPjax',
    ]); ?>
    <div class="wrapper">
        <?php foreach (\Yii::$app->cart->getPositions() as $item): ?>
            <div class="card">
                <div class="card-image">
                    <div class="image-block">
                        <span class="basket-quantity">Количество: <?= $item->getQuantity() ?> </span>
                        <span class="menu-weight"><?= $item->weight ?> грамм</span>
                        <span class="menu-cost"><?= $item->cost ?> BYN</span>
                        <img class="menu-image" src="../img/<?= $item->image ?>">
                    </div>
                    <span class="card-title"><?= $item->name ?></span>
                        <a href="<?= \yii\helpers\Url::to(['menu/delete-from-cart', 'id' => $item->id]) ?>"
                           class="btn-floating btn-large halfway-fab waves-effect waves-light red"><i
                                    class="material-icons">remove_shopping_cart</i></a>
                        <a href="<?= \yii\helpers\Url::to(['menu/minus-from-cart', 'id' => $item->id]) ?>"
                           class="btn-floating halfway-fab waves-effect waves-light red basket-minus"><i
                                    class="material-icons update">remove</i></a>
                        <a href="<?= \yii\helpers\Url::to(['menu/plus-from-cart', 'id' => $item->id]) ?>"
                           class="btn-floating halfway-fab waves-effect waves-light red basket-plus"><i
                                    class="material-icons">add</i></a>
                </div>
                <div class="card-content">
                    <p><?= $item->components ?></p>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
    <?php Pjax::end(); ?>
<?php else: ?>
    <div class="login-form-html"> Ваш заказ отправлен на обработку оператору</div>
<?php endif; ?>
</div>

