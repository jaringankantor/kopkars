<?php
namespace api\controllers;

use Yii;
use api\models\Produk;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

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

    public function actionIndex($kode_toko=null){
        $kode_toko = empty($kode_toko)? Yii::$app->params['kode_toko']:$kode_toko;
        
        $activeData = new ActiveDataProvider([
            'query' => Produk::findProdukAktifByKodeToko($kode_toko),
        ]);
        return $activeData;
    }

    public function actionView($kode_toko=null, $sku=null)
    {
        return $this->render('view', [
            'model' => $this->findModelProduk($kode_toko,$sku),
        ]);
    }

    protected function findModelProduk($kode_toko=null,$sku=null)
    {
        if (($model = Produk::findOneProdukAktifByKodeToko($kode_toko,$sku)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}