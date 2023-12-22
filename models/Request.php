<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int $user_id
 * @property string $created_at
 * @property int $status_id
 * @property string $image
 * @property string|null $image_admin
 * @property string|null $reason
 *
 * @property Category $category
 * @property RequestStatus $status
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    public $imageFile;
    const SCENARIO_ADD_IMAGE = 'add_image';
    const SCENARIO_ADD_REASON = 'add_reason';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id', 'user_id'], 'required'],
            [['category_id', 'user_id', 'status_id'], 'integer'],
            [['created_at'], 'safe'],
            [['reason'], 'string'],
            [['title', 'description', 'image', 'image_admin'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => self::SCENARIO_ADD_IMAGE],
            ['reason', 'required', 'on' => self::SCENARIO_ADD_REASON],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'название',
            'description' => 'описание',
            'category_id' => 'категория',
            'user_id' => 'отправитель',
            'created_at' => 'время создания',
            'status_id' => 'статус заявки',
            'image' => 'фото',
            'image_admin' => 'фото администратора',
            'reason' => 'причина отказа',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(RequestStatus::class, ['id' => 'status_id']);
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
    public function upload($attribute = 'image')
    {
        if ($this->validate()) {
            $filePath =
                Yii::$app->user->id
                . '_'
                . Yii::$app->security->generateRandomString()
                . '.'
                . $this->imageFile->extension;
            $this->imageFile->saveAs('img/' . $filePath);
            $this->$attribute = $filePath;
            return true;
        } else {
            return false;
        }
    }
    public static function getRequest($id)
    {
        return self::findOne(['id' => $id]);
    }
}
