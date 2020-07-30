<?php

namespace backend\models;

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
class Category extends \yii\db\ActiveRecord
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
            [['category_name', 'category_status', 'main_category_id'], 'required'],
            ['category_image_path', 'safe'],
            ['category_name', 'unique'],
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


      /**
    * 
    * @param type $index
    * @return array
    */
    public function getShopCategoryData($id = null)
    {
        $categoryData = Category::find()
            ->alias('C')
            ->select([
                'C.category_id',
                'C.category_name'
                ])

            ->andWhere(['=', 'C.parent_category' , self::PARENT_CATGORY ])
            ->orderBy([
                    'C.category_name' => SORT_ASC
            ]);

            if($id != null){
                $categoryData = $categoryData->andWhere(['main_category_id' => $id]);
            } 
            $categoryData = $categoryData->asArray()
            ->all();        

        if (!empty($categoryData)) {
            return ArrayHelper::map($categoryData,'category_id','category_name');
        } else {
            return [];
        }
    }

       /**
    * 
    * @param type $index
    * @return array
    */
    public function getSub($id = null)
    {

        $categoryData = Category::find()
            ->alias('C')
            ->select([
                'C.category_id',
                'C.category_name'
                ]);

            if($id != null){
                $categoryData = $categoryData->andWhere(['parent_category' => $id]);
            }
            $categoryData = $categoryData->orderBy([
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
