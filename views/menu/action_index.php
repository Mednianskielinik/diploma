<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Menu */

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
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= Html::a('Add',
                [
                    'menu/create',
                ],
                [
                    'id' => 'addMenu',
                    'class' => 'btn btn-warning btn_width_95',
                ]
            ); ?>
        </div>
    </div>
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
                                            <h4 class="pull-left"><?=$item->name?></h4>
                                            <span class="item-price pull-right">$<?=$item->cost?></span>
                                            <div class="clearfix"></div>
                                            <div class="item-hover br-red hidden-xs"></div>
                                            <a href="<?= \yii\helpers\Url::to(['menu/add-to-cart', 'id' => $item->id])?>" class="link hidden-xs add-to-cart" data-id="<?=$item->id?>" >Заказать</a>
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
<?php echo '<pre>'; print_r(\Yii::$app->cart); ?>
<?= $this->render('@app/views/menu/partial/modal', [
    'model' => new Menu(),
]); ?>
