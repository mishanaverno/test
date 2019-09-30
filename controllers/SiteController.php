<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use app\models\Service;
use app\models\ServiceSearch;
use app\models\ServiceUser;

class SiteController extends Controller
{
    public function beforeAction($action) {
        if(Yii::$app->user->isGuest && $action->id != 'login')
            $this->redirect(['site/login']);
        return true;
    }
    
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
        $model = new ServiceUser();
        if(Yii::$app->request->post('User')){
            $model->load(Yii::$app->request->post(),'User');
            $model->save();
            return $this->goHome();
        }
        return $this->render('create-user', ['model'=>$model]);
    }
    public function actionCreateService(){
        $model = new Service();
        if(Yii::$app->request->post('Service')){
            $model->load(Yii::$app->request->post(),'Service');
            $model->save();
            return $this->goHome();
        }
        return $this->render('create-service', ['model'=>$model]);
    }
    public function actionLogin(){
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new User();
        if(Yii::$app->request->post('User')){
            $userdata = Yii::$app->request->post('User');
            $identity = User::findOne(['login' => $userdata['login'], 'password'=> $userdata['password']]);
            Yii::$app->user->login($identity);
            $this->goHome();
            
        }
        return $this->render('login',['model' => $model]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        $this->redirect(['site/login']);
    }
}
