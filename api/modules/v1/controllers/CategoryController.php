<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\Category;
use api\modules\v1\controllers\HelpController;
use api\modules\v1\models\Banner;
use api\modules\v1\models\CategoryGroup;
use yii\db\Expression;
use Yii;
use api\modules\v1\models\MainCategory;


/**
 * Country Controller API
 *
 * 
 */
class CategoryController extends HelpController
{
   
    public function actionViewAllCategory()
    {
 
        $result = Category::find()
            ->select([
                'category_id',
                'category_name',
                'category_image_path',
            ])
            ->where([
                'parent_category' => Category::PARENT_CATGORY,
                'category_status' => 1
            ])
            ->asArray()
            ->all();

        return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'Success']);
    }
    public function actionViewAllSubCategory($category_id)
    {
 
    	$result = Category::find()
    		->where([
    			'parent_category' => Category::PARENT_CATGORY,
    			'category_status' => 1,
                'category_id' => $category_id
    		])->all();

    	return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'Success']);
    } 

    public function actionViewAllCategoryGroup($main_category_id)
    {
 
        $result = MainCategory::find()
            ->where([
                'main_category_status' => 1,
                'main_category_id' => $main_category_id
            ])
            ->all();

        return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'Success']);
    } 
}


