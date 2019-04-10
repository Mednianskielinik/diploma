<?php
use app\assets\MenuAsset;
use \app\models\Sales;

MenuAsset::register($this);
/* @var $orders array */
?>
<table class="order-table">
    <tr>
        <th>Доставлен</th>
        <th>Адрес</th>
        <th>Дата Заказа</th>
        <th>Сумма заказа</th>
        <th>Сумма заказа со скидкой</th>
        <th>Блюдо</th>
        <th>Колличество</th>
    </tr>
    <?php foreach ($orders as $order): ?>
         <tr>
             <td rowspan="<?=count($order['orderItem'])?>"><?=$order['confirm']?></td>
             <td rowspan="<?=count($order['orderItem'])?>"class="employee"><?= $order['user']['address'] ?></td>
             <td rowspan="<?=count($order['orderItem'])?>"><?= (new \DateTime($order['date']))->format('Y-m-d') ?></td>
             <td rowspan="<?=count($order['orderItem'])?>"class="employee"><?= $order['sum_of_order'] ?></td>
             <td rowspan="<?=count($order['orderItem'])?>"class="employee"><?= Sales::getSumWithSale($order['sum_of_order'], $order['user_id'], $order['date']) ?></td>
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
