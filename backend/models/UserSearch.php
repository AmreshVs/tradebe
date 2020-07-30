<?php
namespace backend\models;


use common\models\User;
use common\helpers\Com;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class  UserSearch
 * @package backend/models
 */
class UserSearch extends \common\models\User
{
    /**
    * 
    * @return array
    */
    public function rules()
    {    
        return [
            [['first_name', 'last_name', 'email', 'username', 'mobile_number', 'status'], 'safe'],            
        ];
    }
    
    /**
     * 
     * @param type $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()
            ->select('*')
            ->where(['status' => [USER::STATUS_ACTIVE,  USER::STATUS_INACTIVE]])
            ->andWhere(['user_type' => User::USER_TYPE_NORMAL]);
        $_SESSION['User']=$params;        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'PageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'mobile_number',
                    'first_name',
                    'last_name',
                    'email',
                    'status'
                ],
                'defaultOrder' => [

                    'mobile_number' => SORT_ASC,
                    'first_name' => SORT_ASC,
                    'last_name' => SORT_ASC,
                    'email' => SORT_DESC,
                    'status' => SORT_DESC
                ]
            ]
        ]);
      
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }  
        
        $query->andFilterWhere(['like', 'last_name', $this->last_name])
              ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
                ->andFilterWhere(['like', 'status', $this->status]);
        
        return $dataProvider;   
    }  
}


