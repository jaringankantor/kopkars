<?php

namespace frontend\controllers;

use Yii;
use common\models\AnggotaSimpanan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * AnggotaSimpananController implements the CRUD actions for AnggotaSimpanan model.
 */
class AnggotaSimpananController extends Controller
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
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * Lists all AnggotaSimpanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AnggotaSimpanan::findFrontendAnggotaSimpanan(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Finds the AnggotaSimpanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnggotaSimpanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnggotaSimpanan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelAnggotaSimpanan($id)
    {
        if (($model = AnggotaSimpanan::findOneFrontendAnggotaSimpanan($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
