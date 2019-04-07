<?php
namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Menu;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class MenuController extends Controller
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
                            'index',
                            'create',
                            'update',
                            'delete',
                            'add-to-cart',
                            'delete-from-cart',
                            'minus-from-cart',
                            'plus-from-cart',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex() {
        $model = new Menu();
        $dataProvider = $model->search();

        return $this->render('action_index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Menu();

        if ($request->isPjax && $request->isPost && $model->load($request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->image = $model->imageFile->baseName . '.' . $model->imageFile->extension;
            $model->save();
        }

        return $this->renderAjax('partial/modal', [
            'model' => $model,
        ]);
    }

    public function actionAddToCart($id)
    {
        $cart = Yii::$app->cart;

        $model = Menu::findOne($id);
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(Yii::$app->request->referrer);
        }
        throw new NotFoundHttpException();
    }

    public function actionDeleteFromCart($id)
    {
        $cart = Yii::$app->cart;
        $cart->removeById($id);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMinusFromCart($id)
    {
        $cart = Yii::$app->cart;
        $position = $cart->getPositionById($id);
        $cart->update($position, $position->getQuantity() - 1);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionPlusFromCart($id)
    {
        $cart = Yii::$app->cart;
        $position = $cart->getPositionById($id);
        $cart->update($position, $position->getQuantity() + 1);
        return $this->redirect(Yii::$app->request->referrer);
    }
}