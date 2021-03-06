<?php

namespace backend\controllers;

use Yii;
use common\models\Voucher;
use common\models\VoucherSearch;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;

/**
 * VoucherController implements the CRUD actions for Voucher model.
 */
class VoucherController extends Controller
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
                    'ok-gunakan' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Voucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Voucher model.
     * @param string $kode_voucher
     * @param string $kode_toko
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode_voucher, $kode_toko)
    {
        return $this->render('view', [
            'model' => $this->findModel($kode_voucher, $kode_toko),
        ]);
    }

    /**
     * Creates a new Voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Voucher();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'kode_voucher' => $model->kode_voucher, 'kode_toko' => $model->kode_toko]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing Voucher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $kode_voucher
     * @param string $kode_toko
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($kode_voucher, $kode_toko)
    // {
    //     $model = $this->findModel($kode_voucher, $kode_toko);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'kode_voucher' => $model->kode_voucher, 'kode_toko' => $model->kode_toko]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing Voucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $kode_voucher
     * @param string $kode_toko
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($kode_voucher, $kode_toko)
    // {
    //     $this->findModel($kode_voucher, $kode_toko)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionOkGunakan($kode_voucher,$kode_toko)
    {
        $model = $this->findModelVoucher($kode_voucher,$kode_toko);

        $model->scenario = 'backend-gunakan-voucher';
        $model->rupiah_terpakai = $model->rupiah;
        $model->last_update_by = Yii::$app->user->identity->email;

        if ($model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionUpdateKeteranganEditableJson() {
        $model = Voucher::findOneVoucher(Json::decode(Yii::$app->request->post('editableKey'))['kode_voucher'],Json::decode(Yii::$app->request->post('editableKey'))['kode_koko']); // your model can be loaded here
        $model->last_update_by = Yii::$app->user->identity->email;
        $model->scenario = 'backend-keterangan-voucher';
        if (isset($_POST['hasEditable'])) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $posted = current(Yii::$app->request->post('Voucher'));
            $post = ['Voucher' => $posted];

            if ($model->load($post) && $model->save()) {
                $field_name = Yii::$app->request->post('editableAttribute');
                $output = $model->$field_name;

                $errs = current($model->getErrors());
                $message = $errs[0];
                
                return ['output'=>$output, 'message'=>$message];
            } else {
                return ['output'=>'', 'message'=>current($model->getErrors())[0]];
            }
        }
        
        return $this->render('view', ['model'=>$model]);
    }

    /**
     * Finds the Voucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $kode_voucher
     * @param string $kode_toko
     * @return Voucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kode_voucher, $kode_toko)
    {
        if (($model = Voucher::findOne(['kode_voucher' => $kode_voucher, 'kode_toko' => $kode_toko])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelVoucher($kode_voucher, $kode_toko)
    {
        if (($model = Voucher::findOneVoucher( $kode_voucher, $kode_toko)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
