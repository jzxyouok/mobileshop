<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Customer extends ActiveRecord implements IdentityInterface
{
	public $username;
	public $repassword;
	public $mailVerifyCode;
	public $agree;
	public $rememberMe = true;
	
	public static function tableName()
	{
		return '{{%customer}}';
	}
	
	public function rules()
	{
		return [
			[['first_name', 'last_name', 'email', 'mobile', 'gender', 'password'], 'required', 'on' => 'signup'],
			[['username', 'password'], 'required', 'on' => ['login']],
			['password', 'validatePassword', 'on' => ['login']],
			['rememberMe','boolean'],
		];
	}
	
	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert)){
			$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
			return true;
		}else{
			return false;
		}
	}
	
	public function validatePassword($attribute, $params)
	{
        if (!$this->hasErrors()) {
            $customer = static::findByUsername($this->username);
            if (!$customer || !Yii::$app->security->validatePassword($this->password, $customer->password_hash)) {
                $this->addError($attribute, 'Incorrect name or password.');
            }
        }
	}
	
    /**
     * 根据给到的ID查询身份。
     *
     * @param string|integer $id 被查询的ID
     * @return IdentityInterface|null 通过ID匹配到的身份对象
     */
    public static function findById($id)
    {
        return static::findOne($id);
    }
	
    /**
     * 根据给到的ID查询身份。
     *
     * @param string|integer $id 被查询的ID
     * @return IdentityInterface|null 通过ID匹配到的身份对象
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 根据 token 查询身份。
     *
     * @param string $token 被查询的 token
     * @return IdentityInterface|null 通过 token 得到的身份对象
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string 当前用户ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string 当前用户的（cookie）认证密钥
     */
    public function getAuthKey()
    {
        
    }
	
	public function login()
	{
		if ($this->validate()) {
            return Yii::$app->user->login(static::findByUsername($this->username), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
	}
	
	public function signup()
	{
		if($this->save()){
			return $this;
		}
	}
	
	public static function findByUsername($username)
	{
		return static::findOne(['email' => $username]);
	}
	
    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}