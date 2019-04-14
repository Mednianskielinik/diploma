<?php
namespace app\controllers;

use app\models\BlackList;
use app\models\BlackListSettings;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Menu;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\db\Exception;

class BlackListController extends Controller
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
                            'update-settings'
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
    public function actionIndex()
    {
        $modelSettings = new BlackListSettings();
        $model = new BlackList();
        $settings = BlackListSettings::find()->where(['=', 'id', '1'])->one();
        $modelSettings->countOfDay = $settings->count_of_day;
        $modelSettings->newFine = $settings->fine;
        $dataProvider = $model->search($modelSettings->countOfDay);
        return $this->render('action_index', [
            'model' => $model,
            'modelSettings' => $modelSettings,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateSettings()
    {
        $request = Yii::$app->request;
        $model = BlackListSettings::find()->where(['=', 'id', '1'])->one();

        if ($request->isPost && $model->load($request->post()) && $model->validate()) {
            $model->update();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}