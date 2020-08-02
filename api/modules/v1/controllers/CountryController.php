<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\City;


/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class CountryController extends Controller
{
  
    public function actionIndex()
    {
    	$model = City::get();
    	return $this->asJson(['status' => 200, 'data' => $model, 'msg' => 'Success']);
    	//return $this->asJson(['status' => 200]);
    } 
}


