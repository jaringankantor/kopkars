<?php
namespace api\controllers;

use Yii;
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

    public function actionIndex($kode_toko=null){
        $kode_toko = empty($kode_toko)? Yii::$app->params['kode_toko']:$kode_toko;
        
        $activeData = new ActiveDataProvider([
            'query' => Produk::findProdukAktifByKodeToko($kode_toko),
        ]);

        //return $activeData;

        $requestParams = Yii::$app->getRequest()->getBodyParams();
        if (empty($requestParams)) {
            $requestParams = Yii::$app->getRequest()->getQueryParams();
        }

        $filter = null;
        if ($this->dataFilter !== null) {
            $this->dataFilter = Yii::createObject($this->dataFilter);
            if ($this->dataFilter->load($requestParams)) {
                $filter = $this->dataFilter->build();
                if ($filter === false) {
                    return $this->dataFilter;
                }
            }
        }

        return $activeData;
        
    }

    public function actionView($kode_toko=null, $sku=null)
    {
        return Produk::findOneProdukAktifByKodeToko($kode_toko,$sku);
    }
}