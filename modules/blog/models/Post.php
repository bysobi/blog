<?php

namespace app\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $description
 * @property string $img
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CategoryPosts[] $categoryPosts
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * List of category ids.
     *
     * @var array
     */
    protected $category = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'description', 'img', 'created_at', 'updated_at'], 'required'],
            [['text', 'description'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'img'], 'string', 'max' => 128],

            [['category'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'description' => 'Description',
            'img' => 'Img',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        // Remove all exists relations.
        CategoryPosts::deleteAll(['post_id' => $this->id]);

        $listIds = [];
        foreach ($this->category as $categoryId) {
            $listIds[] = [$this->id, $categoryId];
        }

        // Batch insert all records in DB.
        self::getDb()->createCommand()
            ->batchInsert(CategoryPosts::tableName(), ['post_id', 'category_id'], $listIds)->execute();

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPosts()
    {
        return $this->hasMany(CategoryPosts::className(), ['post_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return ArrayHelper::getColumn(
            $this->getCategoryPosts()->all(), 'category_id'
        );
    }

    /**
     * @param $categoryIds
     */
    public function setCategory($categoryIds)
    {
        $this->category = (array) $categoryIds;
    }
}
