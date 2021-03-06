<?php
namespace api\controllers;

use Yii;
use api\models\Produk;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\data\ActiveDataFilter;

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
        
        // $activeData = new ActiveDataProvider([
        //     'query' => Produk::findProdukAktifByKodeToko($kode_toko),
        // ]);

        // return $activeData;

        $filter = new ActiveDataFilter([
            'searchModel' => 'api\models\ProdukSearch'
        ]);
        
        $filterCondition = null;
        
        if ($filter->load(\Yii::$app->request->get())) { 
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                // Serializer would get errors out of it
                return $filter;
            }
        }
        
        $query = Produk::findProdukAktifByKodeToko($kode_toko);
        if ($filterCondition !== null) {
            $query->andWhere($filterCondition);
        }
        
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function actionView($kode_toko=null, $sku=null)
    {
        return Produk::findOneProdukAktifByKodeToko($kode_toko,$sku);
    }
}