<?php
namespace app\controllers;
use app\models\BlackList;
use app\models\BlackListSettings;
use app\models\Order;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class ReportsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => [],
                'rules' => [
                    [
                        'actions' => [
                            'order-popularity',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionOrderPopularity()
    {
        $request = Yii::$app->request;
        $model = new Order();
        $model->load($request->post());
        $model->dateEndSearch = !empty($model->dateEndSearch)
            ? $model->dateEndSearch
            : (new \DateTime('last day of this month'))->format('Y-m-d');
        $model->dateStartSearch = !empty($model->dateStartSearch)
            ? $model->dateStartSearch
            : (new \DateTime('first day of this month'))->format('Y-m-d');
        $model->getOrderPopularity();
        return $this->render('action_order_popularity', [
            'model' => $model,
        ]);
    }
}