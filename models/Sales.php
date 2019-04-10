<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

class Sales extends ActiveRecord
{
    public static function tableName()
    {
        return 'sale_range';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'sale', 'count_of_purchase', 'color'], 'required'],
            [['sale', 'count_of_purchase'], 'integer'],
            [['color', 'name'], 'string'],
            [['name', 'sale', 'count_of_purchase', 'color'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'sale' => 'Скидка (%)',
            'count_of_purchase' => 'Колличество покупок',
            'color' => 'Цвет',
        ];
    }

    public function search()
    {
        $query = self::find()
            ->select(['id', 'name', 'sale', 'count_of_purchase', 'color'])
            ->orderBy('sale');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }


    /**
     * @return string
     */
    public function renderNotificationErrors()
    {
        if (empty($this->errorsData)) {
            return null;
        }

        $content = '';

        if ($this->hasErrors('days')) {
            $content .= Html::tag('li', current($this->getErrors('days')));
        }

        return !empty($content)
            ? Html::tag('div', Html::tag('ul', $content), ['class' => 'error-summary'])
            : '';
    }

    public static function getSale($userId, $date)
    {
        $purchases = Order::find()
            ->where(['=', 'user_id', $userId])
            ->andWhere(['<', 'date', $date])
            ->asArray()
            ->all();

        $periods = self::find()
            ->where(['<=', 'count_of_purchase', count($purchases)])
            ->orderBy(['sale' => SORT_ASC])
            ->asArray()
            ->all();
        return end($periods)['sale'];
    }

    public static function getSumWithSale($sum, $userId, $date)
    {
        $sale = self::getSale($userId, $date);
        return $sum/100*(100-$sale);
    }

    public static function getDeleteMessage($periodName)
    {
        return "Are you sure you want to delete <strong>".$periodName." period?";
    }

}