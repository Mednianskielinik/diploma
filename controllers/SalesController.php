<?php

namespace app\controllers;

use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use app\models\Sales;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class SalesController extends Controller
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
                            'create-sales',
                            'update-sales',
                            'delete-sales',
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
        $model = new Sales();
        $dataProvider = $model->search();

       return $this->render('action_index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionCreateSales() {
        $request = Yii::$app->request;
        $model = new Sales();

        if ($request->isPjax && $request->isPost && $model->load($request->post()) && $model->validate()) {
            $model->save();
        }

        return $this->renderAjax('partial/modal', [
            'model' => $model,
            'request' => $request
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionUpdateSales($id) {
        $request = Yii::$app->request;
        $model = $this->findModelSickDayFc($id);

        if ($request->isPjax && $request->isPost && $model->load($request->post()) && $model->validate()) {
            $model->save();
        }

        return $this->renderAjax('partial/modal_fc', [
            'model' => $model,
        ]);
    }


    /**
     * @param integer $id
     * @return bool|\yii\web\Response
     */
    public function actionDeleteSales($id) {
        if ($id && $id != 1 && SickDaysFc::deleteAll(['id' => $id])) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        return false;
    }

    public function findModelSales($id) {
        if ($model = SickDaysFc::findOne((int)$id)) {
            return $model;
        } else {
            throw new Exception('Wrong period');
        }
    }
}