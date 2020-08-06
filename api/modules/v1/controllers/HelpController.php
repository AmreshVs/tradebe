<?php

namespace api\modules\v1\controllers;

use yii\web\Controller;
use api\modules\v1\models\Category;
use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;


/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class HelpController extends Controller
{
     /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
         unset($behaviors['authenticator']);
        // unset($behaviors['verbFilter']);

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => [
                    'Authorization',
                    'Cache-Control',
                    'Accept',
                    'Content-Type'
                ],
                'Access-Control-Expose-Headers' => [
                    'X-Pagination-Current-Page',
                    'X-Pagination-Total-Count',
                    'X-Pagination-Page-Count',
                    'X-Pagination-Per-Page'
                ],

            ]
        ];
        // $behaviors['authenticator'] = [
        //     'class' => HttpBearerAuth::class,
        //     'optional' => [
        //         'home/*',
        //     ]
        // ];
      
        return $behaviors;

    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'options' => OptionsAction::class,
            // 'collectionOptions' => ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS']
        ];
    }


    
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


