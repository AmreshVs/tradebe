<?php

namespace common\components;

use common\helpers\AccessRules;
use common\helpers\Com;
use common\models\Configuration;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use common\models\LoginForm;

class CController extends Controller
{
    private $searchModel;

    public $vendor = ['item', 'category', 'sub-category', 'home'];
    /**
     * CController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param array $config
     */
    public function __construct($id, $module, array $config = array())
    {
        parent::__construct($id, $module, $config);

       
        if (Yii::$app->user->getIsGuest()) {
         
        }




    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     *
     * @throws \yii\base\InvalidParamException
     * @throws \ReflectionException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
       // die();
        if(APP_USER_SCOPE == 'vendor'){
            if(!in_array(Yii::$app->controller->id, $this->vendor)){
                return $this->redirect(['/']);
            }
        }
        $actionId = $this->action->getUniqueId();
        $actionId = explode('/', $actionId);

        $actionT = end($actionId);
        $controllerT = $actionId[0];


        $actionT = implode(' ', explode('-', $actionT));
        $controllerT = implode(' ', explode('-', $controllerT));

        $this->view->title = ucfirst($actionT);

        if ($actionT === 'index') {
            $this->view->title = ucfirst($controllerT);
        }

        /**
         * Grid View Filter
         */
        if ($this->hasSearchModel()) {
            $params = Yii::$app->request->queryParams;

            if ($params === []) {
                $params = Com::getFilter($this->getSearchModel());
            }
            Yii::$app->request->queryParams = $params;
        }

        return parent::beforeAction($action);
    }

    /**
     * Controllers that are extended this Class will check the login, based on the following
     * behavior scenario
     *
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'controllers' => ['site'], # Site Controller for Error handling
                        'allow' => true,
                    ],
                    [
                        'controllers' => ['login'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'controllers' => ['admin-user'],
                        'actions' => ['forgot-password', 'password-reset'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return LoginForm::check();
                        },
                        'denyCallback' => function () {
                            throw new ForbiddenHttpException('Access denied');
                        }
                    ]
                ],
            ]
        ];
    }

    /**
     * @return null
     */
    private function getSearchModel()
    {
        return $this->searchModel;
    }

    /**
     * @return bool
     */
    private function hasSearchModel()
    {
        return $this->getSearchModel() !== null;
    }

    /**
     * @param null $searchModel
     */
    public function setSearchModel($searchModel)
    {
        $this->searchModel = $searchModel;
    }

    public function checkFolder($folder)
    {
           if (!file_exists(\Yii::getAlias('@upload').'/'.$folder.'/')) {
                mkdir(\Yii::getAlias('@upload').'/'.$folder.'/', 0777, true);
            }
    }

  

}