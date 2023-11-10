<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "statuse".
 *
 * @property int $id
 * @property string $title
 *
 * @property Order[] $orders
 */
class Statuse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statuse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['status_id' => 'id']);
    }
    public static function getStatus()
    {
        // альтернатива
        // $query = 'SELECT  `statuse` . `id`, `statuse` . `title` FROM `statuse`';
        // Yii::$app->db->createCommand($query)->queryAll();


        return (new Query)
            // ->select(['`statuse` . `id`', '`statuse` . `title`'])
            ->select('statuse.title')
            ->from('statuse')
            ->indexBy('id')
            // ->all();
            ->column();
    }
}
