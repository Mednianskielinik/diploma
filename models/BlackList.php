<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class BlackList extends ActiveRecord
{
    public static function tableName()
    {
        return 'black_list';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'date_of_block'], 'required'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Пользователь',
            'date_of_block' => 'Дата блокировки',
        ];
    }
    public function search()
    {
        $query = self::find()
            ->orderBy('date_of_block');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}