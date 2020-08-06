<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $category_id
 * @property string|null $category_name
 * @property int|null $category_status
 * @property int|null $parent_category
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_status', 'parent_category'], 'integer'],
            [['category_name'], 'string', 'max' => 256],
            [['category_name', 'parent_category'], 'required'],
            ['category_image_path', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_status' => 'Category Status',
            'parent_category' => 'Parent Category',
        ];
    }
}
