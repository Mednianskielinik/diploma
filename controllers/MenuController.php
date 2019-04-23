<?php
namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Menu;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\db\Exception;

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
                            'delete-menu',
                            'update-menu',
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
    public function actionIndex($category = null) {
        $model = new Menu();
        $dataProvider = $model->search(isset($category) ? $category : '');

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

    public function actionUpdateMenu($id) {
        $request = Yii::$app->request;
        $model = $this->findModelMenu($id);
        if ($request->isPjax && $request->isPost && $model->load($request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->image = $model->imageFile->baseName . '.' . $model->imageFile->extension;
            $model->update();
        }

        return $this->renderAjax('partial/modal', [
            'model' => $model,
        ]);
    }

    public function actionDeleteMenu($id) {
        $model = $this->findModelMenu($id);
        $model->is_deleted = true;
        $model->update(false);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function findModelMenu($id) {
        if ($model = Menu::findOne((int)$id)) {
            return $model;
        } else {
            throw new Exception('Wrong period');
        }
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