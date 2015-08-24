<?php

namespace app\modules\blog2\models;

use app\modules\admin\models\Category;
use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimeStampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $description
 * @property integer $category_id
 */
class Post extends \yii\db\ActiveRecord
{
    public $image;   
    public $string;
    public $filename;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
         ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id'], 'required'],
            [['text', 'description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'integer'],
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
            'img' => 'Image',
            'description' => 'Description',
            'category_id' => 'Category',
            'category.title' => 'Category',

        ];
    }

    public function getCategory()
    {
       return $this->hasOne(Category::className(),['id'=>'category_id']);
    }

  /*  public function getActiveCategory() 
    {
       return $this->getCategory()->getActive();
    }*/

    public function beforeSave($insert) {
        if($this->isNewRecord){
            $this->string = substr(uniqid('img'), 0, 12);
            $this->image = UploadedFile::getInstance($this,'img');
            $this->filename = 'uploads/images/' . $this->string . '.' . $this->image->extension;
            if($this->image) {
            $this->image->saveAs($this->filename);
            $this->img = '/' . $this->filename;
            }
        }
        else{
            $this->image = UploadedFile::getInstance($this,'img');
            if($this->image){
                $this->image->saveAs(substr($this->img, 1));
            }

        }

        return parent::beforeSave($insert);

    } 

    
}
