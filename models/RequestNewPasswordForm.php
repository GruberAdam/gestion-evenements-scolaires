<?php

namespace app\models;

use Yii;
use yii\base\Model;


class RequestNewPasswordForm extends Model
{
    public $email;
    public $code;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email'], 'required'],
            [['email'], 'email']
        ];
    }
}
