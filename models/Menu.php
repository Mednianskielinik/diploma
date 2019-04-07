<?php

namespace app\models;

use yii\helpers\Html;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

class Menu extends ActiveRecord implements CartPositionInterface
{

    use CartPositionTrait;

    protected $_product;
    public $price;
    public $color;
    public $imageFile;

    public static function tableName()
    {
        return 'menu';
    }

    public function rules(){
        return[
            [['name', 'components', 'cost', 'weight', 'image'], 'required'],
            [['name', 'components', 'cost', 'weight', 'image'], 'string'],
            [['name', 'components', 'cost', 'weight', 'imageFile'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif']
        ];
    }

    public function search()
    {
        $query = self::find();

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

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->getProduct()->cost;
    }

    /**
     * @return Menu
     */
    public function getProduct()
    {
        if ($this->_product === null) {
            $this->_product = self::findOne($this->id);
        }
        return $this->_product;
    }
}