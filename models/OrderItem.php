<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

class OrderItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['order', 'item', 'count'], 'required'],
            [['order', 'item', 'count'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'order' => 'Заказ',
            'item' => 'Блюдо',
            'count' => 'Колличество',
        ];
    }
}