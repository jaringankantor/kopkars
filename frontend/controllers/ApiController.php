<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ApiProduk;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class ApiController extends ActiveController {
    public $modelClass = 'frontend\models\ApiProduk';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['options']);
        return $actions;
    }

    public function actionProduk() {
        $activeData = new ActiveDataProvider([
            'query' => ApiProduk::findFrontendProdukAktif(),
            'pagination' => false
        ]);
        return $activeData;
    }
}