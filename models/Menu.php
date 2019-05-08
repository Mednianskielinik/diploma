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
    public $searchProduct;
    public $color;
    public $imageFile;
    public $categories = [ 1 => 'Десерты', 2 => 'Горячие блюда', 3 => 'Супы', 4 => 'Закуски'];

    public static function tableName()
    {
        return 'menu';
    }

    public function  attributeLabels()
    {
        return[
            'name'=>'название',
            'components'=>'компоненты',
            'cost'=>'стоимость',
            'weight'=>'вес',
            'image'=>'фото',
            'imageFile' => 'изображение'
        ];
    }

    public function rules(){
        return[
            [['name', 'components', 'cost', 'weight', 'image', 'imageFile'], 'required'],
            [['name', 'components', 'cost', 'weight', 'image'], 'string'],
            [['name', 'category', 'components', 'cost', 'weight', 'imageFile', 'is_deleted', 'searchProduct'], 'safe'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif']

        ];
    }

    public function search($category = null)
    {
        $query = self::find()->where(['=', 'is_deleted', false]);
        if (isset($category) && !empty($category)) {
            $query->andWhere(['=', 'category', $category]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    public function searchDish($dish = null)
    {
        $query = self::find()->where(['=', 'is_deleted', false]);
        if (isset($dish) && !empty($dish)) {
            $query->andWhere(['like', 'name', $dish]);
        }
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