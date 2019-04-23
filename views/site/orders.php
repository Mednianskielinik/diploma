<?php
use app\assets\MenuAsset;
use \app\models\Sales;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Order;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

MenuAsset::register($this);

/* @var $orders array */
/* @var $model Order */

$form = ActiveForm::begin([
    'method'  => 'post',
    'action'  => ['/site/orders'],
    'options' => [
        'data-pjax' => 1,
    ]
]); ?>
    <?= $form->field($model, 'confirm_filter')->widget(Select2::class, [
        'hideSearch' => true,
        'data' => [Order::ALL_ORDERS => 'Все заказы',Order::CONFIRM_ORDERS => 'Доставленные заказы', Order::NOT_CONFIRM_ORDERS => 'Заказы на обработке'],
        'options' => ['placeholder' => 'Все заказы'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ])->label('Статус заказа') ?>
    <?= Html::submitButton('Показать заказы',
    [
        'class' => 'btn btn-success'
    ]) ?>
<?php
ActiveForm::end();
?>
<table class="order-table">
    <tr>
        <th>Доставлен</th>
        <th>Адрес</th>
        <th>Дата Заказа</th>
        <th>Сумма заказа</th>
        <th>Сумма заказа со скидкой</th>
        <th>Блюдо</th>
        <th>Количество</th>
    </tr>
    <?php foreach ($orders as $order): ?>
         <tr>
             <td rowspan="<?=count($order['orderItem'])?>"><a href="<?= \yii\helpers\Url::to(['site/confirming-order', 'id' => $order['id']])?>">
                     <?=$order['confirm'] == 1
                         ? FAS::icon('times', ['class' => 'fa-fw']).'Отметить как не доставленный'
                         : FAS::icon('check', ['class' => 'fa-fw']).'Отметить как доставленный'?></a></td>
             <td rowspan="<?=count($order['orderItem'])?>"class="employee"><?= $order['user']['address'] ?></td>
             <td rowspan="<?=count($order['orderItem'])?>"><?= (new \DateTime($order['date']))->format('Y-m-d') ?></td>
             <td rowspan="<?=count($order['orderItem'])?>"class="employee"><?= $order['sum_of_order'] ?></td>
             <td rowspan="<?=count($order['orderItem'])?>"class="employee" style="background:<?=Sales::getSale($order['user_id'], $order['date'], true)?> "><?= Sales::getSumWithSale($order['sum_of_order'], $order['user_id'], $order['date']) ?></td>
        <?php foreach ($order['orderItem'] as $items): ?>
                <td><?= $items['menu']['name'] ?></td>
                <td><?= $items['count'] ?></td>
            </tr>
            <tr>
        <?php endforeach;?>
    <?php endforeach;?>
    <tr>

    </tr>
</table>
