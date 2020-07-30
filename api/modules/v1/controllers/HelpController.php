<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\Category;


/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class HelpController extends Controller
{
    
     /**
     * @param array $request
     * @param $params
     * @throws \api\components\ApiException
     */
    protected function checkRequiredParam(array $request, $params)
    {
        $params = (array)$params;

        foreach ($params as $param) {
            if (!array_key_exists($param, $request)) {
                return (['status' => 401,'missing-param' => $param]);
              
            }
        }
    }
}


