<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'sum_of_order'], 'required'],
            [['user_id','sum_of_order'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Пользователь',
            'sum_of_order' => 'Сумма заказа',
            'date' => 'Дата заказа',
        ];
    }
}