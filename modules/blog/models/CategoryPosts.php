<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "category_posts".
 *
 * @property integer $post_id
 * @property integer $category_id
 *
 * @property Post $post
 * @property Category $category
 */
class CategoryPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
