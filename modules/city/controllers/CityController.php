<?php

namespace app\modules\city\controllers;

use app\modules\city\models\Street;
use app\modules\city\models\StreetSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use Yii;

/**
 * Class CityController
 * @package app\modules\city\controllers
 */
Class CityController extends Controller
{
    /**
     * Lists all Street models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $searchModel = new StreetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Street;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }
}