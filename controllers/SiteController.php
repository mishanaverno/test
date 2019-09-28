<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Service;
use app\models\ServiceSearch;
use app\models\User;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $model = Service::findOne(6);
        Yii::debug($model->userName);
        return $this->render('index', ['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);
    }
    public function actionDelete($id)
    {   
        Service::findOne($id)->delete();
        $this->actionIndex();
    }
    public function actionUpdate($id){
        $model = Service::findOne($id);
        if (Yii::$app->request->post('Service'))
        {
            Yii::debug($model->type);
            $model->load(Yii::$app->request->post(),'Service');
            $model->save();
            $this->actionIndex();
        }
        return $this->renderAjax('update', ['model'=>$model]);
    }
    public function actionCreateUser(){
        return $this->render('create-user');
    }
    public function actionCreateService(){
        $model = new Service();
        return $this->render('create-service', ['model'=>$model]);
    }
}
