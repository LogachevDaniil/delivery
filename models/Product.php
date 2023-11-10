<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $photo
 * @property string $description
 * @property float $price
 * @property int $count
 * @property int $like
 * @property int $dislike
 * @property int $weigth
 * @property float $kilocalories
 * @property int $shelf_life
 * @property int $category_id
 *
 * @property Category $category
 * @property Comments[] $comments
 * @property OrderItem[] $orderItems
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'photo', 'description', 'price', 'weigth', 'kilocalories', 'shelf_life', 'category_id'], 'required'],
            [['description'], 'string'],
            [['price', 'kilocalories'], 'number'],
            [['count', 'like', 'dislike', 'weigth', 'shelf_life', 'category_id'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'photo' => 'Photo',
            'description' => 'Description',
            'price' => 'Price',
            'count' => 'Count',
            'like' => 'Like',
            'dislike' => 'Dislike',
            'weigth' => 'Weigth',
            'kilocalories' => 'Kilocalories',
            'shelf_life' => 'Shelf Life',
            'category_id' => 'Category ID',
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
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['product_id' => 'id']);
    }
}
