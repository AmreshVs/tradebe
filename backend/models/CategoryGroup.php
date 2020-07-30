<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_group".
 *
 * @property int $category_group_id
 * @property string|null $category_group_name
 * @property int|null $category_group_status
 * @property string|null $category_group_image
 */
class CategoryGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_group_status'], 'integer'],
            [['category_group_name', 'category_group_image'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_group_id' => Yii::t('app', 'Category Group ID'),
            'category_group_name' => Yii::t('app', 'Category Group Name'),
            'category_group_status' => Yii::t('app', 'Category Group Status'),
            'category_group_image' => Yii::t('app', 'Category Group Image'),
        ];
    }
}
