<?php

namespace api\modules\v1\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    const PARENT_CATGORY = 0;
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
            [['category_name', 'category_status'], 'required'],
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

    public function fields()
    {
        return [
            'sub_category_id' => 'category_id', 
            'sub_category_name' => function ($model) {
                return ucfirst($model->category_name);
            },
            'sub_category_image_path' => 'category_image_path',
    
        ];

        
    }


      /**
    * 
    * @param type $index
    * @return array
    */
    public function getCategory()
    {
        $categoryData = Category::find()
            ->alias('C')
            ->select([
                'C.*'
                ])

            ->andWhere(['=', 'C.parent_category' , self::PARENT_CATGORY ])
            ->orderBy([
                    'C.category_name' => SORT_ASC
            ]);
        return $categoryData; 
           

    }

       /**
    * 
    * @param type $index
    * @return array
    */
    public function getSub()
    {
        $categoryData = Category::find()
            ->alias('C')
            ->select([
                'C.category_id',
                'C.category_name'
                ])

            ->andWhere(['<>', 'C.parent_category' , self::PARENT_CATGORY ])
            ->orderBy([
                    'C.category_name' => SORT_ASC
            ]) 
            ->asArray()
            ->all();        

        if (!empty($categoryData)) {
            return ArrayHelper::map($categoryData,'category_id','category_name');
        } else {
            return [];
        }
    }
}
