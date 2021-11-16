<?php

namespace backend\controllers;

use Yii;
use common\models\Form;
use common\models\FormSearch;
use common\models\FormField;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\AccessControl;
use yii2mod\rbac\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FormController implements the CRUD actions for Form model.
 */
class FormController extends Controller
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
     * Lists all Form models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Form model.
     * @param string $id
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
     * Creates a new Form model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Form();

        if ($model->load(Yii::$app->request->post())) {
            $upload = UploadedFile::getInstance($model, 'file_excel');
            $model->file_excel = bin2hex(file_get_contents($upload->tempName));
            $model->file_extension = $upload->extension;
            $model->file_name = $upload->name;
            $model->file_size = $upload->size;
            $model->file_type = $upload->type;
            
            if ($model->validate() && $model->save()) {
                $file_path = Yii::getAlias('@app').'/web/assets/public/upload_templates/'.$model->kode.'.'.$model->file_extension;
                $upload->saveAs($file_path);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($upload->extension));
                $spreadsheet = $reader->load($file_path);
                $worksheet = $spreadsheet->getSheetByName($model->sheet_name);
                $highestColumn = $worksheet->getHighestColumn();
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
                for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                    $model_formfield = new FormField();
                    $model_formfield->scenario = 'backend-create-form';
                    $model_formfield->kode_form =  $model->kode;
                    $model_formfield->nama_field_excel = $worksheet->getCellByColumnAndRow($col,$model->baris_header)->getValue();
                    $model_formfield->save();
                }
                return $this->redirect([
                    'index'
                ]);
            } else {
                $errors = $model->errors;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Form model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $current_file_excel = $model->file_excel;
        $current_file_extension = $model->file_extension;
        $current_file_name = $model->file_name;
        $current_file_size = $model->file_size;
        $current_file_type = $model->file_type;

        if ($model->load(Yii::$app->request->post())) {
            
            $upload = UploadedFile::getInstance($model, 'file_excel');
            if(!empty($upload)){
                $model->file_excel = bin2hex(file_get_contents($upload->tempName));
                $model->file_extension = $upload->extension;
                $model->file_name = $upload->name;
                $model->file_size = $upload->size;
                $model->file_type = $upload->type;
            } else {
				$model->file_excel = $current_file_excel;
                $model->file_extension = $current_file_extension;
                $model->file_name = $current_file_name;
                $model->file_size = $current_file_size;
                $model->file_type = $current_file_type;
			}

            if ($model->validate() && $model->save()) {
                $file_path = Yii::getAlias('@app').'/web/assets/public/upload_templates/'.$model->kode.'.'.$model->file_extension;
                $upload->saveAs($file_path);
                
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

    /**
     * Deletes an existing Form model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Form model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Form the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Form::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
