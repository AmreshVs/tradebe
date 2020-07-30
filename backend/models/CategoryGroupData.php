<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_group_data".
 *
 * @property int $category_group_data_id
 * @property int|null $category_group_id
 * @property int|null $category_id
 */
class CategoryGroupData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_group_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_group_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_group_data_id' => Yii::t('app', 'Category Group Data ID'),
            'category_group_id' => Yii::t('app', 'Category Group ID'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }
}
