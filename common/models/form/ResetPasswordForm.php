<?php 
namespace common\models\form;

use Yii;
use yii\base\Model;
use common\models\Customer;

class ResetPasswordForm extends Model
{
	public $email;
	
	public $password;
	
	public $repassword;
	
	public $mailVerifyCode;
	
	public function rules()
	{
		return [
			[['email','email'],'required'],
			[['password', 'repassword'], 'validatePassword'],
		];
	}
	
	public function validatePassword($attribute, $params)
	{
        if (!$this->hasErrors()) {
            if ($this->password !== $this->repassword) {
                $this->addError($attribute, 'Incorrect password and retype password not the same value.');
            }
        }
	}
	
	public function resetPassword()
	{
		$model = Customer::find()->where(['email' => $this->email])->One();
		if($model){
			$model->password = $this->password;
			return $model->save();
		}
		return false;
	}
}