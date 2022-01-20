<?php

namespace backend\controllers;

use Yii;
use common\models\Cicilan;
use common\models\CicilanSearch;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;
/**
 * CicilanController implements the CRUD actions for Cicilan model.
 */
class CicilanController extends Controller
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
     * Lists all Cicilan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CicilanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cicilan model.
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

    /**
     * Creates a new Cicilan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Cicilan();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing Cicilan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing Cicilan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionUpdateKeteranganEditableJson() {
        $model = Cicilan::findOneCicilan(Json::decode(Yii::$app->request->post('editableKey'))['id']); // your model can be loaded here
        $model->scenario = 'backend-keterangan-cicilan';
        if (isset($_POST['hasEditable'])) {

            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $posted = current(Yii::$app->request->post('Cicilan'));
            $post = ['Cicilan' => $posted];

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
     * Finds the Cicilan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cicilan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cicilan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
