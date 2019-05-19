<?php
namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function  attributeLabels()
    {
        return[
            'user_name'=>'Имя',
            'email' => 'e-mail',
            'password'=>'Пароль',
            'user_second_name' => 'Фамилия',
            'login' => 'Логин',
            'address' => 'Адрес',
            'phone_number' => 'Мобильный телефон'
        ];
    }
    public function rules()
    {
        return [
            [['user_name', 'user_second_name', 'login', 'address', 'email', 'password', 'phone_number'], 'safe'],
            [['user_name', 'user_second_name', 'login', 'address', 'email', 'password', 'phone_number'], 'required', 'message' => '{attribute} не может быть пустым'],
            ['login', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое логин уже используется.'],
            ['login', 'string', 'min' => 5, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такая почта уже занята.'],
            ['password', 'string', 'min' => 6],
            [['user_name', 'user_second_name', 'address', 'phone_number'], 'string', 'max' => 50],
        ];
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne(['password_reset_token' => $token]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function search($params)
    {
        $query = self::find()
            ->orderBy('login');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email]);


        return $dataProvider;
    }
}