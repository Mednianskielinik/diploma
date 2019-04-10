<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderItem;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Menu;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'basket', 'confirm-order', 'order'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Menu();
        $dataProvider = $model->search();
        return $this->render('index',['dataProvider' => $dataProvider,]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionBasket()
    {
        $sum = 0;
        foreach (\Yii::$app->cart->getPositions() as $item) {
            $count = $item->cost * $item->getQuantity();
            $sum += $count;
        }
        return $this->render('basket', ['sum' => $sum]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSignUp()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionConfirmOrder()
    {
        $sum = 0;
        foreach (\Yii::$app->cart->getPositions() as $item) {
            $count = $item->cost * $item->getQuantity();
            $sum += $count;
        }
        $order = new Order();
        $order->user_id = Yii::$app->user->id;
        $order->date = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $order->sum_of_order = $sum;
        $order->save();
        foreach (\Yii::$app->cart->getPositions() as $item) {
            $orderItem = new OrderItem();
            $orderItem->order = $order->id;
            $orderItem->item = $item->id;
            $orderItem->count = $item->getQuantity();
            $orderItem->save();
        }
        \Yii::$app->cart->removeAll();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionOrders()
    {
        $orders = Order::getOrders();
        return $this->render('orders', [
            'orders' => $orders,
        ]);
    }
}
