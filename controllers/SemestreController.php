<?php

namespace app\controllers;

use Yii;
use app\models\Semestre;
use app\models\SemestreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SemestreController implements the CRUD actions for Semestre model.
 */
class SemestreController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Semestre models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SemestreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Semestre model.
     * @param integer $idcarrera
     * @param integer $idmateria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idcarrera, $idmateria)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcarrera, $idmateria),
        ]);
    }

    /**
     * Creates a new Semestre model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Semestre();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idcarrera' => $model->idcarrera, 'idmateria' => $model->idmateria]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Semestre model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcarrera
     * @param integer $idmateria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idcarrera, $idmateria)
    {
        $model = $this->findModel($idcarrera, $idmateria);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idcarrera' => $model->idcarrera, 'idmateria' => $model->idmateria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Semestre model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcarrera
     * @param integer $idmateria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idcarrera, $idmateria)
    {
        $this->findModel($idcarrera, $idmateria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Semestre model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcarrera
     * @param integer $idmateria
     * @return Semestre the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcarrera, $idmateria)
    {
        if (($model = Semestre::findOne(['idcarrera' => $idcarrera, 'idmateria' => $idmateria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
