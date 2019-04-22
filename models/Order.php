<?php
namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public $reportOrderPopularity;
    public $orderInMonth;
    public $confirm_filter;
    public $dateStartSearch;
    public $dateEndSearch;
    public $year;
    const MONTH = [
        'Январь', 'Февраль', 'Март',
        'Апрель', 'Май', 'Июнь',
        'Июль', 'Август', 'Сентябрь',
        'Октябрь', 'Ноябрь', 'Декабрь'];
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
            [['dateStartSearch', 'dateEndSearch', 'confirm_filter', 'year'], 'safe']
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

    public function getOrderPopularity()
    {
        $dateStart = (new \DateTime($this->dateStartSearch))->format('Y-m-d H:i:s');
        $dateEnd = (new \DateTime($this->dateEndSearch))->format('Y-m-d H:i:s');
        $query = self::find()
            ->where([ 'AND',
                ['>=', 'date', $dateStart],
                ['<=', 'date', $dateEnd]])
            ->andWhere(['=', 'confirm', true])
            ->joinWith('orderItem')
            ->asArray()
            ->all();

        $this->getItemsCount($query);
    }

    public function getOrderInMonth()
    {
        $dateStart = (new \DateTime('01.01.'.$this->year))->format('Y-m-d H:i:s');
        $dateEnd = (new \DateTime('31.12.'.$this->year))->format('Y-m-d H:i:s');
        $query = self::find()
            ->where([ 'AND',
                ['>=', 'date', $dateStart],
                ['<=', 'date', $dateEnd]])
            ->andWhere(['=', 'confirm', true])
            ->asArray()
            ->all();

        $this->getMonthWithOrder($query);
    }

    public function  getMonthWithOrder($orders) {
        $this->orderInMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($orders as $order) {
            $month = (new \DateTime($order['date']))->format('m');
            $this->orderInMonth[(int)$month-1]++;
        }
    }

    public function getItemsCount($orders)
    {
        foreach ($orders as $order) {
            foreach ($order['orderItem'] as $item) {
                $this->reportOrderPopularity[$item['menu']['name']] = isset($this->reportOrderPopularity[$item['menu']['name']])
                    ? $this->reportOrderPopularity[$item['menu']['name']] + $item['count']
                    :  $item['count'];
            }
        }
        if (isset($this->reportOrderPopularity)) {
            arsort($this->reportOrderPopularity);
        }
    }

    public function getYears()
    {
        $orders = self::find()
            ->where(['=', 'confirm', true])
            ->orderBy('order.date')
            ->asArray()
            ->all();
        foreach ($orders as $order) {
            $year = (new \DateTime($order['date']))->format('Y');;
            $years[$year] = $year;
        }
        return array_unique($years);
    }

    public static function getCountNotConfirmOrder()
    {
        $orders = self::find()
            ->where(['=', 'confirm', false])
            ->asArray()
            ->all();

        return count($orders) > 0 ? "<span class='badge indicate-vacation text-center'   style='background-color: #ff503a'  data-toggle='tooltip' title='Новые заказы' data-placement='bottom'>" .count($orders).'</span>' : null;
    }
}