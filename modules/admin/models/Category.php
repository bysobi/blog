<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','category_status'], 'required'],
            [['title','category_status'], 'string', 'max' => 255],
           // [['status'],'boolean'],
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
           // 'status' => 'Status category',
            'category_status' => 'Category status',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class()); 
    }

}

class CategoryQuery extends ActiveQuery
{
    public function getActive()
    {
        return $this->andWhere(['category_status' => Category::STATUS_ACTIVE]);
    }

    public function getInactive()
    {
        return $this->andWhere(['category_status' => Category::STATUS_INACTIVE]);
    }

}
