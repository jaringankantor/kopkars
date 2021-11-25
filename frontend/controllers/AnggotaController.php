<?php

namespace frontend\controllers;

use Yii;
use common\models\Anggota;
use common\models\DbpegawaiPubPegawai;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['site/index']);
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['verify-email','resend-verification-email','select-karyawan-pnj'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['biodata','update','update-email','update-foto','update-hp','select-karyawan-pnj'],
                        'roles' => ['@'],
                    ],
                ],
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
     * Lists all Anggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Anggota::findAnggota(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
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
            'model' => $this->findModel($id),
        ]);
    }

    public function actionBiodata()
    {
        return $this->render('biodata', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }

    public function actionSelectKaryawanPnj($q = null, $nomor_pegawai = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = '
            select pegKodeResmi id, CONCAT(pegNama,\' (\',pegKodeResmi,\')\') text
            from pub_pegawai
            where lower(pegNama) like \'%'.$q.'%\' or lower(pegKodeResmi) like \''.$q.'%\'
            limit 20
            ';
            
            $command = Yii::$app->db_pegawai->createCommand($query);

            $data = $command->queryAll();


            $out['results'] = array_values($data);
        }
        elseif ($nomor_pegawai > 0) {
            $out['results'] = ['nomor_pegawai' => $nomor_pegawai, 'text' => DbpegawaiPubPegawai::find([['nomor_pegawai'=>$nomor_pegawai]])->pegNama];
        }
        return $out;
    }


    /**
     * Updates an existing Anggota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'frontend-update-anggota';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['biodata']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateEmail()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'frontend-update-anggota-email';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['biodata']);
        }

        return $this->render('update_email', [
            'model' => $model,
        ]);
    }

    public function actionUpdateFoto()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);

        $model->scenario = 'frontend-update-anggota-foto';

		$current_foto = $model->foto;

        
        if ($model->load(Yii::$app->request->post())) {
            
            $upload = UploadedFile::getInstance($model, 'foto');
            if(!empty($upload)){
                $model->foto = bin2hex(file_get_contents($upload->tempName));
            } else {
				$model->foto = $current_foto;
			}

            if ($model->validate() && $model->save()) {
                return $this->redirect([
                    'biodata'
                ]);
            } else {
                $errors = $model->errors;
            }
        }
        
        return $this->render('update_foto', [
            'model' => $model,
        ]);
    }

    public function actionUpdateHp()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario = 'frontend-update-anggota-hp';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['biodata']);
        }

        return $this->render('update_hp', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

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
}
