<?php

namespace backend\controllers;

use Yii;
use common\models\Anggota;
use common\models\AnggotaSearch;
use yii\data\ActiveDataProvider;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use \yii\web\Response;

/**
 * AnggotaController implements the CRUD actions for Anggota model.
 */
class AnggotaController extends Controller
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
                    'ok-beri-nomor' => ['POST'],
                ],
            ],
        ];
    }

    //public function actionUpdateall()
    //{
    //    return $this->render('updateallpassword');
    //}

    /**
     * Lists all Anggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBeriNomor()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Anggota::findAnggota()->where('nomor_anggota IS NULL OR waktu_approve IS NULL'),
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]]
        ]);

        return $this->render('beri_nomor', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOkBeriNomor($id)
    {
        $model = $this->findModelAnggota($id);

        //BELUM BERES, seharusnya ini mengikuti parameter kopkar
        $model->scenario = 'backend-nomor_anggota-anggota';
        $model->status = 'Aktif';
        $model->waktu_approve = date('Y-m-d H:i:s');
        $model->approved_by = Yii::$app->user->identity->email;

        print_r($model);
        exit();
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Displays a single Anggota model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModelAnggota($id),
        ]);
    }

    public function actionViewBiodata($id)
    {
        return $this->render('view-biodata', [
            'model' => $this->findModelAnggota($id),
        ]);
    }

    /**
     * Creates a new Anggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anggota();
        $model->scenario = 'frontend-create-anggota';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('@frontend/views/anggota/registrasi', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Anggota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModelAnggota($id);

        $model->scenario = 'frontend-update-anggota';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateemailEditableJson() {
        if (isset($_POST['hasEditable'])) {
            $model = $this->findModelAnggota(Yii::$app->request->post('editableKey'));
            $model->scenario = 'backend-updateemail-anggota';

            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $posted = current(Yii::$app->request->post('Anggota'));
            $post = ['Anggota' => $posted];

            if ($model->load($post) && $model->save()) {
                $output = $model->email.' (arahkan anggota untuk klik menu Verifikasi Email pada halaman login)';

                $errs = current($model->getErrors());
                $message = $errs[0];

                return ['output'=>$output, 'message'=>$message];
            } else {
                return ['output'=>'', 'message'=>current($model->getErrors())[0]];
            }
        }
    }

    public function actionUpdatehpEditableJson() {
        if (isset($_POST['hasEditable'])) {
            $model = $this->findModelAnggota(Yii::$app->request->post('editableKey'));
            $model->scenario = 'backend-updatehp-anggota';

            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $posted = current(Yii::$app->request->post('Anggota'));
            $post = ['Anggota' => $posted];

            if ($model->load($post) && $model->save()) {
                $output = '+62'.$model->nomor_hp;

                $errs = current($model->getErrors());
                $message = $errs[0];
                
                return ['output'=>$output, 'message'=>$message];
            } else {
                return ['output'=>'', 'message'=>current($model->getErrors())[0]];
            }
        }
        
    }

    /**
     * Deletes an existing Anggota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModelAnggota($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Anggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anggota::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelAnggota($id)
    {
        if (($model = Anggota::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
