<?php
namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public $confirm_filter;
    const CONFIRM_ORDERS = 'is_confirm';
    const NOT_CONFIRM_ORDERS = 'not_confirm';
    const ALL_ORDERS = 'all';

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
            [['confirm_filter'], 'safe']
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

    public function getOrderItem() {
        return $this->hasMany(OrderItem::class, ['order' => 'id'])->with('menu');
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getOrders() {
        if ($this->confirm_filter == 'is_confirm') {
            $condition = ['=', 'confirm', true];
        } elseif ($this->confirm_filter == 'not_confirm') {
            $condition = ['=', 'confirm', false];
        } else {
            $condition = ['OR',
                ['=', 'confirm', true],
                ['=', 'confirm', false]
            ];
        }
        $orders = self::find()
            ->where($condition)
            ->joinWith('user')
            ->joinWith('orderItem')
            ->orderBy('order.date')
            ->asArray()
            ->all();

        return $orders;
    }
}