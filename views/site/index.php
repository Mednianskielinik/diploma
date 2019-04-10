<?php
use yii\bootstrap\Carousel;
use app\assets\MenuAsset;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

MenuAsset::register($this);
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
<div class="dishes">
    <div class="row">
        <div class="inner-page padd">
            <div class="shopping">
                <div class="container">
                    <div class="shopping-content">
                        <div class="row">
                            <?php Pjax::begin(['timeout' => 7000,
                                'id' => 'menuGridPjax',
                            ]); ?>
                            <?php if (!empty($dataProvider)):?>
                                <?php foreach ($dataProvider->getModels() as $item):?>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="shopping-item">
                                            <img class="img-responsive" src="../img/<?=$item->image?>" alt="" />
                                            <div class="product"><h4><?=$item->name?></h4></div>
                                            <div class="item-price"><?=$item->cost?> BYN</div>
                                            <div class="item-weight"><?=$item->weight?> грамм</div>
                                            <div class="components"><?=$item->components?></div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif; ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

