<?php
namespace app\models;

use yii\db\ActiveRecord;


class BlackListSettings extends ActiveRecord
{
    public $countOfDay, $newFine;

    public static function tableName()
    {
        return 'black_list_settings';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['count_of_day', 'fine'], 'required'],
            [['count_of_day', 'fine'], 'integer'],
            [['count_of_day', 'fine'], 'safe']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'count_of_day' => 'Количество дней в черном списке',
            'fine' => 'Штраф',
        ];
    }

}