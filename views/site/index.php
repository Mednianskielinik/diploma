<?php
use yii\bootstrap\Carousel;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="main-container" >
<?= Carousel::widget([
    'items' => [
        [
            'content' => '<img src="../img/slider2.png"/>',
            'caption' =>'',
            'options' => []
        ],
        [
            'content' => '<img src="../img/slider1.png"/>',
            'caption' => '',
            'options' => []
        ],
        [
            'content' => '<img src="../img/slider3.png"/>',
            'caption' => '',
            'options' => []
        ]
    ],
    'options' => ['class' => 'carousel slide', 'data-interval' => '12000'],
    'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
        '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
    ]
]);
?>
<div class="logo">
    <img src="../img/logo.png">
</div>
</div>

