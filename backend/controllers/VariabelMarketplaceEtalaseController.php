<?php

namespace backend\controllers;

use Yii;
use common\models\VariabelMarketplaceEtalase;
use common\models\VariabelMarketplaceEtalaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * VariabelMarketplaceEtalaseController implements the CRUD actions for VariabelMarketplaceEtalase model.
 */
class VariabelMarketplaceEtalaseController extends Controller
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
     * Lists all VariabelMarketplaceEtalase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VariabelMarketplaceEtalaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VariabelMarketplaceEtalase model.
     * @param string $kode_variabel_marketplace
     * @param string $kode
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode_variabel_marketplace, $kode)
    {
        return $this->render('view', [
            'model' => $this->findModelVariabelMarketplaceEtalase($kode_variabel_marketplace, $kode),
        ]);
    }

    /**
     * Creates a new VariabelMarketplaceEtalase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VariabelMarketplaceEtalase();

        $model->kode_toko=Yii::$app->user->identity->kode_toko;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VariabelMarketplaceEtalase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $kode_variabel_marketplace
     * @param string $kode
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kode_variabel_marketplace, $kode)
    {
        $model = $this->findModelVariabelMarketplaceEtalase($kode_variabel_marketplace, $kode);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VariabelMarketplaceEtalase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $kode_variabel_marketplace
     * @param string $kode
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kode_variabel_marketplace, $kode)
    {
        $this->findModelVariabelMarketplaceEtalase($kode_variabel_marketplace, $kode)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VariabelMarketplaceEtalase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $kode_variabel_marketplace
     * @param string $kode
     * @return VariabelMarketplaceEtalase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kode_variabel_marketplace, $kode)
    {
        if (($model = VariabelMarketplaceEtalase::findOne(['kode_variabel_marketplace' => $kode_variabel_marketplace, 'kode' => $kode])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelVariabelMarketplaceEtalase($kode_variabel_marketplace, $kode)
    {
        if (($model = VariabelMarketplaceEtalase::findOneVariabelMarketplaceEtalase($kode_variabel_marketplace, $kode)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
