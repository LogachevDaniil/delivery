<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Request[] $requests
 */
class RequestStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_status';
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
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['status_id' => 'id']);
    }
    public static function getStatusTitle($id)
    {
        return self::findOne(['id' => $id])->title;
    }
}
