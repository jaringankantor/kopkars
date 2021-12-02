<?php

namespace backend\controllers;

use Yii;
use common\models\Produk;
use yii\data\ActiveDataProvider;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;

class ExportController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'tambah-blibli' => ['POST'],
                    'tambah-bukalapak' => ['POST'],
                    'tambah-elevenia' => ['POST'],
                    'tambah-jdid' => ['POST'],
                    'tambah-lazada' => ['POST'],
                    'tambah-shopee' => ['POST'],
                    'tambah-tokopedia' => ['POST'],
                    'tambah-zobaze' => ['POST'],
                ],
            ],
        ];
    }
    public function actionFormTambah()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Produk::findProdukAktif(),
            'pagination' => [
                'pageSize' => 15,
            ],
            'sort'=> ['defaultOrder' => ['sku'=>SORT_DESC]]
        ]);
        return $this->render('form-tambah', ['dataProvider' => $dataProvider,]);
    }
    public function actionTambahBlibli()
    {
        return $this->renderPartial('tambah-blibli');
    }

    public function actionTambahBukalapak()
    {
        return $this->renderPartial('tambah-bukalapak');
    }

    public function actionTambahElevenia()
    {
        return $this->renderPartial('tambah-elevenia');
    }

    public function actionTambahJdid()
    {
        return $this->renderPartial('tambah-jdid');
    }

    public function actionTambahLazada()
    {
        return $this->renderPartial('tambah-lazada');
    }
    
    public function actionTambahShopee()
    {
        return $this->renderPartial('tambah-shopee');
    }
    public function actionTambahTokopedia()
    {
        return $this->renderPartial('tambah-tokopedia');
    }
    public function actionTambahZobaze()
    {
        return $this->renderPartial('tambah-zobaze');
    }
    public function actionUpdateBlibliStokharga()
    {
        return $this->renderPartial('update-blibli-stokharga');
    }

    public function actionUpdateBukalapakStokhargadeskripsivideo()
    {
        return $this->renderPartial('update-bukalapak-stokhargadeskripsivideo');
    }

    public function actionFbmarketplace()
    {
        return $this->renderPartial('fbmarketplace');
    }

    public function actionTambahFacebookCatalog()
    {
        return $this->renderPartial('tambah-facebook-catalog');
    }

    public function actionJd()
    {
        return $this->renderPartial('jd');
    }

    public function actionUpdateLazadaDeskripsiGambar()
    {
        return $this->renderPartial('update-lazada-deskripsi-gambar');
    }
    
    public function actionUpdateLazadaStokharga()
    {
        return $this->renderPartial('update-lazada-stokharga');
    }

    public function actionUpdateShopeeDeskripsi()
    {
        return $this->renderPartial('update-shopee-deskripsi');
    }

    public function actionUpdateShopeeStokharga()
    {
        return $this->renderPartial('update-shopee-stokharga');
    }

    public function actionUpdateTokopediaDeskripsiGambarVideo()
    {
        return $this->renderPartial('update-tokopedia-deskripsi-gambar-video');
    }

    public function actionUpdateTokopediaStokharga()
    {
        return $this->renderPartial('update-tokopedia-stokharga');
    }

    public function actionZobaze()
    {
        return $this->renderPartial('zobaze');
    }

}
