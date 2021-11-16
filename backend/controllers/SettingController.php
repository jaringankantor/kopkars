<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\SettingMarketplaceEtalase;
use common\models\SettingMarketplaceKategori;

class SettingController extends \yii\web\Controller
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
                    'asign' => ['POST'],
                    'unasign' => ['POST'],
                ],
            ],
        ];
    }

    public function actionBlibli()
    {
        $model = SettingMarketplace::parameter('bli');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'blibli'
                ]);
            }
        }
        return $this->render('blibli', [
            'model' => $model,
        ]);
    }

    public function actionBukalapak()
    {
        $model = SettingMarketplace::parameter('bkl');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'bukalapak'
                ]);
            }
        }
        return $this->render('bukalapak', [
            'model' => $model,
        ]);
    }

    public function actionElevenia()
    {
        $model = SettingMarketplace::parameter('elv');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'elevenia'
                ]);
            }
        }
        return $this->render('elevenia', [
            'model' => $model,
        ]);
    }

    public function actionFacebookCatalog()
    {
        $model = SettingMarketplace::parameter('fbc');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'facebook-catalog'
                ]);
            }
        }
        return $this->render('facebook-catalog', [
            'model' => $model,
        ]);
    }

    public function actionJdid()
    {
        $model = SettingMarketplace::parameter('jdi');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'jdid'
                ]);
            }
        }
        return $this->render('jdid', [
            'model' => $model,
        ]);
    }

    public function actionLazada()
    {
        $model = SettingMarketplace::parameter('lzd');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'lazada'
                ]);
            }
        }
        return $this->render('lazada', [
            'model' => $model,
        ]);
    }

    public function actionShopee()
    {
        $model = SettingMarketplace::parameter('shp');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'shopee'
                ]);
            }
        }
        return $this->render('shopee', [
            'model' => $model,
        ]);
    }

    public function actionTokopedia()
    {
        $model = SettingMarketplace::parameter('tkp');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'tokopedia'
                ]);
            }
        }
        return $this->render('tokopedia', [
            'model' => $model,
        ]);
    }


    public function actionMarketplaceEtalase()
    {
        $list_exist = ArrayHelper::getColumn(
            SettingMarketplaceEtalase::findMarketplaceEtalase(Yii::$app->request->get('marketplace'))
            ->asArray()->all(),'sku_produk');

        $produk_model = new ActiveDataProvider([
            'query' => Produk::findProdukBelumTerpilih($list_exist)
        ]);

        $etalase_model = new ActiveDataProvider([
            'query' => SettingMarketplaceEtalase::findProdukDalamEtalase(Yii::$app->request->get('marketplace'),Yii::$app->request->get('kode'))
        ]);

        return $this->render('marketplace-etalase', [
            'produk_model' => $produk_model,
            'etalase_model' => $etalase_model,
        ]);
    }

    public function actionMarketplaceKategori()
    {
        $list_exist = ArrayHelper::getColumn(
            SettingMarketplaceKategori::findMarketplaceKategori(Yii::$app->request->get('marketplace'))
            ->asArray()->all(),'sku_produk');

        $produk_model = new ActiveDataProvider([
            'query' => Produk::findProdukBelumTerpilih($list_exist)
        ]);

        $kategori_model = new ActiveDataProvider([
            'query' => SettingMarketplaceKategori::findProdukDalamKategori(Yii::$app->request->get('marketplace'),Yii::$app->request->get('kode'))
        ]);

        return $this->render('marketplace-kategori', [
            'produk_model' => $produk_model,
            'kategori_model' => $kategori_model,
        ]);
    }

    public function actionMarketplaceEtalaseAsign()
    {
        $model = new SettingMarketplaceEtalase();

        $model->kode_toko=Yii::$app->user->identity->kode_toko;
        $model->kode_variabel_marketplace = Yii::$app->request->get('marketplace');
        $model->kode_variabel_marketplace_etalase = Yii::$app->request->get('kode');
        $model->sku_produk = Yii::$app->request->get('sku');

        if ($model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionMarketplaceKategoriAsign()
    {
        $model = new SettingMarketplaceKategori();

        $model->kode_toko=Yii::$app->user->identity->kode_toko;
        $model->kode_variabel_marketplace = Yii::$app->request->get('marketplace');
        $model->kode_variabel_marketplace_kategori = Yii::$app->request->get('kode');
        $model->sku_produk = Yii::$app->request->get('sku');

        if ($model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionMarketplaceEtalaseUnasign()
    {
        $this->findModelMarketplaceEtalase(Yii::$app->request->get('marketplace'),Yii::$app->request->get('kode'),Yii::$app->request->get('sku'))->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionMarketplaceKategoriUnasign()
    {
        $this->findModelMarketplaceKategori(Yii::$app->request->get('marketplace'),Yii::$app->request->get('kode'),Yii::$app->request->get('sku'))->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModelMarketplaceEtalase($marketplace,$kode,$sku)
    {
        if (($model = SettingMarketplaceEtalase::findOneProdukDalamEtalase($marketplace,$kode,$sku)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelMarketplaceKategori($marketplace,$kode,$sku)
    {
        if (($model = SettingMarketplaceKategori::findOneProdukDalamKategori($marketplace,$kode,$sku)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
