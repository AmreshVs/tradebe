<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\Category;
use api\modules\v1\models\MainCategory;
use api\modules\v1\controllers\HelpController;
use api\modules\v1\models\Banner;
use api\modules\v1\models\CategoryGroup;
use api\modules\v1\models\ItemHome;
use api\modules\v1\models\VendorCity;
use api\modules\v1\models\MainCategoryGroup;
use yii\db\Expression;
use Yii;
use api\modules\v1\models\ItemList;


/**
 * Country Controller API
 *
 * 
 
 */
class HomeController extends HelpController
{
    public function actionIndex()
    {
        $request = Yii::$app->request->get();

 
        

    	$result['header_category'] = MainCategory::find()
    		->where([
    			'main_category_status' => 1
    		])
    		->limit(8)
    		->all();

    	$result['banner'] = Banner::find()->where(['banner_status' => 1])->all();

        $category_with_subcategory = Category::find()
            ->alias('C')
            ->select([
                'C.*',
                'sub_category_limit' => new Expression('1'),
                'limit' => new Expression('4'),
            ])
            ->leftJoin(['I' => ItemList::tableName()], 'I.category_id = C.category_id')
            ->leftJoin(['VC' => VendorCity::tableName()], 'VC.vendor_id = I.vendor_id')
            ->where([
                'parent_category' => Category::PARENT_CATGORY,
                'category_status' => 1,
            ]);

            if(isset($request['city'])){
                $category_with_subcategory = $category_with_subcategory->andwhere(['in','VC.city_id', $request['city']]);
            }

            $result['category_with_subcategory'] = $category_with_subcategory->limit(8)
                ->all();
      
    	$category_group = MainCategoryGroup::find()
            ->alias('C')
            ->leftJoin(['I' => ItemList::tableName()], 'I.main_category_id = C.main_category_id')
            ->leftJoin(['VC' => VendorCity::tableName()], 'VC.vendor_id = I.vendor_id')
            ->where([
                'main_category_status' => 1
            ]);
            if(isset($request['city'])){
                $category_group = $category_group->andwhere(['in','VC.city_id', $request['city']]);
            }
            $result['category_group'] = $category_group->limit(8)
            ->all();

    	$products = ItemHome::find()
            ->alias('I')
            ->where([
                'item_status' => 1
            ])
            ->leftJoin(['VC' => VendorCity::tableName()], 'VC.vendor_id = I.vendor_id');
             if(isset($request['city'])){
                $products = $products->andwhere(['in','VC.city_id', $request['city']]);
            }
            $result['products'] = $products->limit(10)
            ->all();


    	$all_category = Category::find()
            ->alias('C')
            ->leftJoin(['I' => ItemList::tableName()], 'I.category_id = C.category_id')
            ->leftJoin(['VC' => VendorCity::tableName()], 'VC.vendor_id = I.vendor_id')
            ->select([
                'C.category_id',
                'C.category_name',
                'C.category_image_path',
            ])
    		->where([
    			'C.parent_category' => Category::PARENT_CATGORY,
    			'C.category_status' => 1
    		]);
            if(isset($request['city'])){
                $all_category = $all_category->andwhere(['in','VC.city_id', $request['city']]);
            }
            $result['all_category'] = $all_category->limit(11)
            ->asArray()
    		->all();
    

    	return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'success']);
    } 

    public function actionTest()
    {
        die('wrk');
    }

    public function actionSearch($key)
    {
        
        $result = ItemHome::find()
            ->alias('I')
            ->select(['item_name', 'item_id'])
            ->where([
                'item_status' => 1
            ])
            ->andwhere(['like', 'item_name', $key])
            ->limit(10)
            ->asArray()
            ->all();

        return $this->asJson(['status' => 200, 'data' => $result, 'msg' => 'success']);

    }
}


