<?php

namespace backend\controllers;

use Yii;
use common\models\Produk;
use common\models\ProdukSearch;
use common\models\UploadForm;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * ProdukController implements the CRUD actions for Produk model.
 */
class ProdukController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'allowActions' => [
                    'view-foto'
                ]
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
     * Lists all Produk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produk model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sku)
    {
        return $this->render('view', [
            'model' => $this->findModelProduk($sku),
        ]);
    }

    public function actionViewFoto($kode_toko,$sku,$ke)
    {
        return $this->renderPartial('view-foto', [
            'model' => $this->findModelProdukFoto($kode_toko,$sku),
            'ke'=>$ke
        ]);
    }

    /**
     * Creates a new Produk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Produk();

        $model->kode_toko=Yii::$app->user->identity->kode_toko;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sku' => $model->sku]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sku)
    {
        $model = $this->findModelProduk($sku);

        if ($model->load(Yii::$app->request->post())) {
            $current_foto_1 = $model->foto_1;
            $current_foto_2 = $model->foto_2;
            $current_foto_3 = $model->foto_3;
            $current_foto_4 = $model->foto_4;
            $current_foto_5 = $model->foto_5;
            $current_foto_6 = $model->foto_6;
            $current_foto_7 = $model->foto_7;
            
            $upload = UploadedFile::getInstance($model, 'foto_1');
            if(!empty($upload)){
                $model->foto_1 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_1 = $current_foto_1;
			}
            
            $upload = UploadedFile::getInstance($model, 'foto_2');
            if(!empty($upload)){
                $model->foto_2 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_2 = $current_foto_2;
            }
            
            $upload = UploadedFile::getInstance($model, 'foto_3');
            if(!empty($upload)){
                $model->foto_3 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_3 = $current_foto_3;
            }
            
            $upload = UploadedFile::getInstance($model, 'foto_4');
            if(!empty($upload)){
                $model->foto_4 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_4 = $current_foto_4;
            }
            
            $upload = UploadedFile::getInstance($model, 'foto_5');
            if(!empty($upload)){
                $model->foto_5 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_5 = $current_foto_5;
            }
            
            $upload = UploadedFile::getInstance($model, 'foto_6');
            if(!empty($upload)){
                $model->foto_6 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_6 = $current_foto_6;
            }
            
            $upload = UploadedFile::getInstance($model, 'foto_7');
            if(!empty($upload)){
                $model->foto_7 = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto_7 = $current_foto_7;
			}

            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'index'
                ]);
            } else {
                $errors = $model->errors;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateEditableJson() {
        $model = Produk::findOneProduk(Json::decode(Yii::$app->request->post('editableKey'))['sku']); // your model can be loaded here
        if (isset($_POST['hasEditable'])) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $posted = current(Yii::$app->request->post('Produk'));
            $post = ['Produk' => $posted];

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

    public function actionImportDeskripsi()
    {
        $upload = new UploadForm();

        return $this->render('import-deskripsi', ['upload' => $upload]);
    }

    public function actionImportFoto()
    {
        $upload = new UploadForm();

        return $this->render('import-foto', ['upload' => $upload]);
    }

    public function actionImportHargastok()
    {
        $upload = new UploadForm();

        return $this->render('import-hargastok', ['upload' => $upload]);
    }

    public function actionImportTambahProduk()
    {
        $upload = new UploadForm();

        return $this->render('import-tambah-produk', ['upload' => $upload]);
    }

    public function actionImportUrlidBlibli()
    {
        $upload = new UploadForm();

        return $this->render('import-urlid-blibli', ['upload' => $upload]);
    }

    public function actionImportUrlidBukalapak()
    {
        $upload = new UploadForm();

        return $this->render('import-urlid-bukalapak', ['upload' => $upload]);
    }

    public function actionImportUrlidLazada()
    {
        $upload = new UploadForm();

        return $this->render('import-urlid-lazada', ['upload' => $upload]);
    }

    public function actionImportUrlidShopee()
    {
        $upload = new UploadForm();

        return $this->render('import-urlid-shopee', ['upload' => $upload]);
    }

    public function actionImportUrlidTokopedia()
    {
        $upload = new UploadForm();

        return $this->render('import-urlid-tokopedia', ['upload' => $upload]);
    }

    /**
     * Deletes an existing Produk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModelProduk($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelProduk($sku)
    {
        if (($model = Produk::findOneProduk($sku)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelProdukFoto($kode_toko,$sku)
    {
        if (($model = Produk::findOne(['kode_toko'=>$kode_toko,'sku'=>$sku])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSelectProduk($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select(['sku AS id',"CONCAT(nama_produk, ' (',sku, ')') AS text"])
                ->from('produk')
                ->where(['like', 'lower(nama_produk)', strtolower($q)])
                ->andWhere(['kode_toko' => Yii::$app->user->identity->kode_toko])
                ->orWhere(['like', 'lower(sku)', strtolower($q)])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Produk::findOneProduk($id)->nama_produk];
        }
        return $out;
    }
}
