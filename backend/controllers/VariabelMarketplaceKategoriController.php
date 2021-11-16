<?php

namespace backend\controllers;

use Yii;
use common\models\VariabelMarketplaceKategori;
use common\models\VariabelMarketplaceKategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * VariabelMarketplaceKategoriController implements the CRUD actions for VariabelMarketplaceKategori model.
 */
class VariabelMarketplaceKategoriController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all VariabelMarketplaceKategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VariabelMarketplaceKategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VariabelMarketplaceKategori model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode_variabel_marketplace, $kode)
    {
        return $this->render('view', [
            'model' => $this->findModelVariabelMarketplaceKategori($kode_variabel_marketplace, $kode),
        ]);
    }

    /**
     * Creates a new VariabelMarketplaceKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VariabelMarketplaceKategori();
        
        $model->kode_toko=Yii::$app->user->identity->kode_toko;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VariabelMarketplaceKategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kode_variabel_marketplace, $kode)
    {
        $model = $this->findModelVariabelMarketplaceKategori($kode_variabel_marketplace, $kode);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VariabelMarketplaceKategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kode_variabel_marketplace, $kode)
    {
        $this->findModelVariabelMarketplaceKategori($kode_variabel_marketplace, $kode)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VariabelMarketplaceKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VariabelMarketplaceKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VariabelMarketplaceKategori::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelVariabelMarketplaceKategori($kode_variabel_marketplace, $kode)
    {
        if (($model = VariabelMarketplaceKategori::findOneVariabelMarketplaceKategori($kode_variabel_marketplace, $kode)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
