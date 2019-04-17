<?php
namespace app\controllers;

use app\models\BlackList;
use app\models\BlackListSettings;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

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
                            'update-settings',
                            'add',
                            'remove',
                            'new-date'
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

    public function actionAdd($id)
    {
        $blackList = new BlackList();
        $blackList->user_id = $id;
        $blackList->date_of_block = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $blackList->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemove($id)
    {
        $model = BlackList::findOne((int)$id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionNewDate($id)
    {
        $model = BlackList::find()->where(['=', 'user_id', $id])->one();
        $model->date_of_block = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $model->update();
        return $this->redirect(Yii::$app->request->referrer);
    }
}