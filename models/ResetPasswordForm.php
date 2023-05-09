<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ResetPasswordForm extends Model
{
    public $newPassword;
    public $confirmPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['newPassword', 'confirmPassword'], 'required'],
            // password is validated by validatePassword()
            ['newPassword', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->newPassword != $this->confirmPassword){
                $this->addError($attribute, 'Password are not matching');
            }
        }
    }

    public function resetPasswords($id){
        if ($this->validate()){
            return true;
        }
        return false;
    }
}
