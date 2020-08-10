<?php

namespace api\modules\v1\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;


/**
 * This is the model class for table "main_category".
 *
 * @property int $main_category_id
 * @property string|null $main_category_name
 * @property int|null $main_category_status
 * @property string|null $main_category_image_path
 */
class MainCategoryGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_category_status'], 'integer'],
            [['main_category_name', 'main_category_image_path'], 'string', 'max' => 256],
            [['main_category_name', 'main_category_status'], 'required'],
            ['main_category_image_path', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'main_category_id' => Yii::t('app', 'Main Category ID'),
            'main_category_name' => Yii::t('app', 'Main Category Name'),
            'main_category_status' => Yii::t('app', 'Main Category Status'),
            'main_category_image_path' => Yii::t('app', 'Main Category Image Path'),
        ];
    }

    public function fields()
    {
        $subCategory = [];
        $category = [
            'main_category_id', 
            'main_category_name' => function ($model) {
                return ucfirst($model->main_category_name);
            },
            'main_category_image_path'
        ];

        $subCategory = [
            'category' => function (self $model) {
                return Category::find()
                ->select([
                    '*',
                    'sub_category_limit' => new Expression('1'),
                    'limit' => new Expression('3'),
                ])
                ->where([
                    'main_category_id' => $this->main_category_id,
                    'parent_category' => Category::PARENT_CATGORY,
                    'category_status' => 1
                ])
                ->orderBy(['category_id' => SORT_ASC])
                ->limit(6)
                ->all();
            },
        ]; 
        
        
        return array_merge($category, $subCategory);
    }

       /**
    * 
    * @param type $index
    * @return array
    */
    public function get()
    {
        $categoryData = self::find()
            ->alias('C')
            ->select([
                'C.main_category_id',
                'C.main_category_name'
                ])
            ->orderBy([
                    'C.main_category_name' => SORT_ASC
            ]) 
            ->asArray()
            ->all();        

        if (!empty($categoryData)) {
            return ArrayHelper::map($categoryData,'main_category_id','main_category_name');
        } else {
            return [];
        }
    }
}
