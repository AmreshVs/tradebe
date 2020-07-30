<?php
namespace backend\models;


use backend\models\Category;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class CategorySearch extends \backend\models\Category
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [['category_name', 'category_status'], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find()->where(['parent_category' => Category::PARENT_CATGORY]);
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'category_name',
                    'category_status',
                ],
                'defaultOrder' => [

                    'category_name' => SORT_ASC,
                    'category_status' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'category_name', $this->category_name])
              ->andFilterWhere(['like', 'category_status', $this->category_status]);
        
        return $dataProvider;   
    }  
}


