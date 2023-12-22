<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisrterForm extends Model
{
    public $full_name;
    public $login;
    public $password;
    public $password_repeat;
    public $email;
    public $phone;
    public $agree;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['full_name', 'login', 'password', 'email', 'phone'], 'required'],
            [['full_name', 'login', 'password', 'email', 'phone'], 'string', 'max' => 255],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            // ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}(\-\d{2}){2}/'],
            // ['login', 'match', 'pattern' => '/^[a-z]+$/i'],
            // ['full_name', 'match', 'pattern' => '/^[А-ЯЁ][а-яё]+\s[А-ЯЁ][а-яё]+\s[А-ЯЁ][а-яё]+$/u'],
            ['agree', 'required', 'requiredValue' => true, 'message' => 'согласитесь'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'login' => 'логин',
            'username' => 'логин',
            'password' => 'пароль',
            'password_repeat' => 'повтор пароля',
            'email' => 'Email',
            'phone' => 'телефон',
            'role_id' => 'Role ID',
            'auth_key' => 'Auth Key',
            'rememberMe' => 'запомнить меня',
            'agree' => 'согласие на обработку персональных данных',
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('user');
            if (!$user->save()) {
                # code...
            }
        }
        return $user ?? false;
    }
}
