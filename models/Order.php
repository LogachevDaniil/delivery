<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $ordered_at
 * @property string $address
 * @property int $count
 * @property float $cost
 * @property string $time_delivery
 * @property int $user_id
 * @property int $courier_id
 * @property int $status_id
 *
 * @property User $courier
 * @property Report[] $reports
 * @property Statuse $status
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ordered_at', 'address', 'count', 'cost', 'time_delivery', 'user_id', 'courier_id', 'status_id'], 'required'],
            [['ordered_at', 'time_delivery'], 'safe'],
            [['count', 'user_id', 'courier_id', 'status_id'], 'integer'],
            [['cost'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['courier_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['courier_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuse::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ordered_at' => 'Ordered At',
            'address' => 'Address',
            'count' => 'Count',
            'cost' => 'Cost',
            'time_delivery' => 'Time Delivery',
            'user_id' => 'User ID',
            'courier_id' => 'Courier ID',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * Gets query for [[Courier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourier()
    {
        return $this->hasOne(User::class, ['id' => 'courier_id']);
    }

    /**
     * Gets query for [[Reports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuse::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
