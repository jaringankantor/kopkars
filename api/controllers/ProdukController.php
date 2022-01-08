<?php

namespace api\controllers;

use api\models\Produk;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class ProdukController extends ActiveController {
    public $modelClass = 'api\models\Produk';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

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

    public function actionIndex() {
        $activeData = new ActiveDataProvider([
            'query' => Produk::findFrontendProdukAktif(),
        ]);
        return $activeData;
    }
}