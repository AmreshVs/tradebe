<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\components\CController;
use Yii;

/**
 * Class SiteController
 * @package backend\controllers
 */
class SiteController extends CController
{
      /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        return $this->render('login');
    }
}