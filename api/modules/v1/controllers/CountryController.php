<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class CountryController extends Controller
{
  
    public function actionIndex()
    {
    	
    	return $this->asJson(['status' => 200]);
    } 
}


