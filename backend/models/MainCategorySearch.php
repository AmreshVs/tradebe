<?php
namespace backend\models;


use backend\models\MainCategorySearch;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class MainCategorySearch extends \backend\models\MainCategory
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [['main_category_name', 'main_category_status'], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MainCategorySearch::find();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'main_category_name',
                    'main_category_status',
                ],
                'defaultOrder' => [

                    'main_category_name' => SORT_ASC,
                    'main_category_status' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'main_category_name', $this->main_category_name])
              ->andFilterWhere(['like', 'main_category_status', $this->main_category_status]);
        
        return $dataProvider;   
    }  
}


