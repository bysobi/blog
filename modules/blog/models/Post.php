<?php

namespace app\modules\blog\models;

use Yii;
use app\modules\admin\models\Category;
use yii\helpers\ArrayHelper;
use creocoder\taggable\TaggableBehavior;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $description
 * @property integer $category_id
 * @property string $img
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TaggableBehavior::className(),
        ];
    }
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'id_category'])
            ->viaTable('category_post', ['id_post' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }
    public $tagstest = [];
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
    public function getCategoryList()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title');
    }
    public function beforeSave($insert) {
        var_dump($this->tagstest);
        die;
        $post = new Post();

        $post->tagNames = $this->tagstest
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'description',  'img', 'created_at', 'updated_at'], 'required'],
            [['title', 'text', 'description', 'img'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            ['tagstest', 'safe'],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
use creocoder\taggable\TaggableQueryBehavior;
class PostQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }
}
