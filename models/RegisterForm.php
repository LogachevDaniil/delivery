<?php

namespace app\models;

use Yii;

class RegisterForm extends \yii\base\Model
{
    public $name;
    public $surname;
    public $patronimic;
    public $email;
    public $phone;
    public $login;
    public $password;
    public $password_repeat;
    public $rules;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'phone', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronimic', 'login', 'email', 'phone', 'password'], 'string', 'max' => 255],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['rules', 'required', 'requiredValue' => 1, 'message' => 'messssssssssage'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronimic' => 'Patronimic',
            'login' => 'Login',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'created_at' => 'Created At',
            'auth_key' => 'Auth Key',
        ];
    }
    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            //1 способ 
            $user->attributes = $this->attributes;
            //2
            // $user->load($this->attributes, '');
            $user->password = YII::$app->security->generatePasswordHash($this->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('user');
            if (!$user->save()) {
            }
        }
        return $user ?? false;
    }
}
