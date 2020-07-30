<?php
namespace backend\models;


use backend\models\City;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class CitySearch extends \backend\models\City
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [['city_name', 'city_status'], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = City::find();;
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'city_name',
                    'city_status',
                ],
                'defaultOrder' => [

                    'city_name' => SORT_ASC,
                    'city_status' => SORT_ASC,

                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'city_name', $this->city_name])
              ->andFilterWhere(['like', 'city_status', $this->city_status]);
        
        return $dataProvider;   
    }  
}


