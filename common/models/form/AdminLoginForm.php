<?php 
namespace common\models\form;

use Yii;
use yii\base\Model;
use common\models\Admin;

class AdminLoginForm extends Model
{
	public $name;
	public $password;
	public $rememberMe = true;
	
	private $_admin;
	
	public function attributeLabels()
	{
		return [
			'name' => 'Admin',
			'password' => 'Password',
			'rememberMe' => 'Remember Me',
		];
	}
	
	public function rules()
	{
		return [
			[['name','password'],'required'],
			['rememberMe','boolean'],
			['password', 'validatePassword'],
		];
	}
	
	public function login()
	{
	    if ($this->validate()) {
            return Yii::$app->user->login($this->getAdmin(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
	}
	
	public function getAdmin()
	{
		if ($this->_admin === null) {
            $this->_admin = Admin::findByName($this->name);
        }

        return $this->_admin;
	}
	
	public function validatePassword($attribute, $params)
	{
        if (!$this->hasErrors()) {
            $admin = $this->getAdmin();
            if (!$admin || !$admin->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect name or password.');
            }
        }
	}
}