<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_test".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string|null $auth_key
 */
class UserTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password', 'auth_key'], 'string', 'max' => 255],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }
}
