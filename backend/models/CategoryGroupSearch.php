<?php
namespace backend\models;


use backend\models\CategoryGroup;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class CategoryGroupSearch extends \backend\models\CategoryGroup
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [['category_group', 'category_group_status'], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CategoryGroup::find();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'category_group',
                    'category_group_status',
                ],
                'defaultOrder' => [

                    'category_group' => SORT_ASC,
                    'category_group_status' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'category_group', $this->category_group])
              ->andFilterWhere(['like', 'category_group_status', $this->category_group_status]);
        
        return $dataProvider;   
    }  
}


