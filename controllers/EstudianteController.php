<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessController;
use yii\web\Controller;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Estudiante;
use app\models\EstudianteForm;
use app\models\EstudianteSearch;

class EstudianteController extends Controller
{
    public function actionIndex()
    {
        $table = new Estudiante;
        //$model = $table->find()->orderBy('nombre_estudiante')->all();
        $model = $table->find()->where(['idestudiante' => 1])->orderBy('nombre_estudiante')->all();

        $form = new EstudianteSearch;
        $search = null;

        $status = 0;

        if($form->load(Yii::$app->request->get()))
        {
            if($form->validate())
            {
                $search = Html::encode($form->q);
                //$query = "SELECT * FROM estudiantes WHERE idestudiante LIKE '%$search%'";
                $query = "SELECT
	                        estudiantes.idestudiante, 
	                        estudiantes.nombre_estudiante, 
	                        cat_carreras.desc_carrera, 
	                        ciclo.desc_ciclo
                          FROM
	                        estudiantes
	                      INNER JOIN cat_carreras ON estudiantes.idcarrera = cat_carreras.idcarrera
	                      INNER JOIN grupos	ON cat_carreras.idcarrera = grupos.idcarrera
	                      INNER JOIN ciclo ON grupos.idciclo = ciclo.idciclo
                          WHERE
                            estudiantes.idestudiante =:idestudiante
                          GROUP BY
                            estudiantes.idestudiante";
                //$model = $table->findBySql($query)->all();
                $model = Yii::$app->db->createCommand($query)
                                   ->bindValue(':idestudiante', $search)
                                   ->queryAll();
                $status = 1;
            }
            else
            {
                $form->getErrors();
            }
        }

        return $this->render('index', ['model' => $model, 'form' => $form, 'status' => $status]);
    }

    public function actionCreate()
    {
        $model = new EstudianteForm;
        $msg = null;

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $table = new Estudiante();
                $table->idestudiante = $model->idestudiante;
                $table->nombre_estudiante = $model->nombre_estudiante;
                $table->email = $model->email;
                $table->sexo = $model->sexo;
                $table->idcarrera = $model->idcarrera;
                $table->num_semestre = $model->num_semestre;
                $table->fecha_registro = $model->fecha_registro;
                $table->fecha_actualizacion = $model->fecha_actualizacion;
                $table->cve_estatus = $model->cve_estatus;

                if($table->insert())
                {
                    $msg = "Registro guardado";
                    $model->idestudiante = "";
                    $model->nombre_estudiante = "";
                    $model->email = "";
                    $model->sexo = "";
                    $model->idcarrera = "";
                    $model->num_semestre = "";
                    $model->fecha_registro = "";
                    $model->fecha_actualizacion = "";
                    $model->cve_estatus = "";
                }
                else
                {
                    $msg = "Error al guardar el registro";
                }
            }
            else
            {
                $model->getErrors();
            }
        }

        return $this->render("create", ['model' => $model, 'msg' => $msg]);
    }
}