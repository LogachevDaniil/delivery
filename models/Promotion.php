<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promotion".
 *
 * @property int $id
 * @property string $photo
 * @property string $data_start
 * @property string $data_end
 */
class Promotion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promotion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo', 'data_start', 'data_end'], 'required'],
            [['data_start', 'data_end'], 'safe'],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Photo',
            'data_start' => 'Data Start',
            'data_end' => 'Data End',
        ];
    }
}
