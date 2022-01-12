<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;

use app\models\actacalificacion\ActaCalificacion;
use app\models\grupoestudiante\GrupoEstudiante;

class ActacalificacionController extends Controller
{
    public function behaviors()
    {
        return [
                "access" => [
                    "class" => AccessControl::className(),
                    "only" => [""],//Especificar que acciones se van proteger
                    "rules" => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            "actions" => [""],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1);
                            },  
                        ],
                        [
                            //Servicios escolares tiene permisos sobre las siguientes acciones
                            "actions" => [""],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                            },  
                        ],
                        [
                            //El profesor tiene permisos sobre las siguientes acciones
                            "actions" => [""],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
                            },  
                        ],
                        [
                            //División de estudios tiene permisos sobre las siguientes acciones
                            "actions" => [""],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            "allow" => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            "roles" => ["@"],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            "matchCallback" => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4);
                            },  
                        ]
                    ],
                ],
                //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
                //sólo se puede acceder a través del método post
                "verbs" => [
                    "class" => VerbFilter::className(),
                    "actions" => [
                        "logout" => ["post"],
                    ],
                ],
        ];
    }

    public function actionGeneraracta($idgrupo, $idprofesor)
    {
        $sql = GrupoEstudiante::find()->select("idestudiante,idopcion_curso,cve_estatus,idciclo,p1,p2,p3,p4,p5,p6,p7,p8,p9,s1,s2,s3,s4,s5,s6,s7,s8,s9")->where(["idgrupo" => $idgrupo])->all();

        foreach($sql as $row)
        {
            $idestudiante = $row["idestudiante"];
            $idopcion_curso = $row["idopcion_curso"];
            $cve_estatus = $row["cve_estatus"];
            $idciclo = $row["idciclo"];

            $p1 = $row["p1"];
            $p2 = $row["p2"];
            $p3 = $row["p3"];
            $p4 = $row["p4"];
            $p5 = $row["p5"];
            $p6 = $row["p6"];
            $p7 = $row["p7"];
            $p8 = $row["p8"];
            $p9 = $row["p9"];

            $s1 = $row["s1"];
            $s2 = $row["s2"];
            $s3 = $row["s3"];
            $s4 = $row["s4"];
            $s5 = $row["s5"];
            $s6 = $row["s6"];
            $s7 = $row["s7"];
            $s8 = $row["s8"];
            $s9 = $row["s9"];

            $calificacion1 = ($s1 == "") ? $p1 : $s1;
            $calificacion2 = ($s2 == "") ? $p2 : $s2;
            $calificacion3 = ($s3 == "") ? $p3 : $s3;
            $calificacion4 = ($s4 == "") ? $p4 : $s4;
            $calificacion5 = ($s5 == "") ? $p5 : $s5;
            $calificacion6 = ($s6 == "") ? $p6 : $s6;
            $calificacion7 = ($s7 == "") ? $p7 : $s7;
            $calificacion8 = ($s8 == "") ? $p8 : $s8;
            $calificacion9 = ($s9 == "") ? $p9 : $s9;

            //Array con las calificaciones de los 9  parciales
            $calificaciones_parciales = [$calificacion1, $calificacion2, $calificacion3, $calificacion4, $calificacion5, $calificacion6, $calificacion7, $calificacion8, $calificacion9];
            $calificaciones_parciales_verificacion_NA = [$p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9];

            //Devuelve el promedio final por estudiante y materia
            $promedio_final = $this->promedioTotal($calificaciones_parciales);

            //Identifica los parciales reprobados con NA, con este valor se discretiza si el promedio final es para primera o segunda oportunidad
            $promedio_primera_segunda_oportunidad = $this->vertificarOpcionCalificacion($calificaciones_parciales_verificacion_NA);

            $existe = ActaCalificacion::find()->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->count();

            if($existe == 0)
            {
                $table = new ActaCalificacion();
                $table->idgrupo = $idgrupo;
                $table->idestudiante = $idestudiante;
                $table->idopcion_curso = $idopcion_curso;
                $table->pri_opt = ($promedio_final != "") ? (($promedio_primera_segunda_oportunidad > 0) ? "" : (($promedio_final < 70) ? "NA" : $promedio_final)) : "";
                $table->seg_opt = ($promedio_final != "") ? (($promedio_primera_segunda_oportunidad > 0) ? (($promedio_final < 70) ? "NA" : $promedio_final) : "") : "";
                $table->fecha_registro = date("Y-m-d h:i:s");
                $table->fecha_actualizacion = "";
                $table->cve_estatus = $cve_estatus;
                $table->insert();

                $status_acta = 1;
            }
            else
            {
                $sql = ActaCalificacion::find()->select("idacta_cal")->where(["idgrupo" => $idgrupo, "idestudiante" => $idestudiante])->one();
                $idacta_cal = $sql->idacta_cal;

                $table = ActaCalificacion::findOne($idacta_cal);
                $table->pri_opt = ($promedio_primera_segunda_oportunidad > 0) ? "" : (($promedio_final < 70) ? "NA" : $promedio_final);
                $table->seg_opt = ($promedio_primera_segunda_oportunidad > 0) ? (($promedio_final < 70) ? "NA" : $promedio_final) : "";
                $table->fecha_actualizacion = date("Y-m-d h:i:s");
                $table->cve_estatus = $cve_estatus;
                $table->update();

                $status_acta = 2;
            }
        }
        header("Location: ".Url::toRoute("/profesor/horarioconsulta?idciclo=$idciclo&idprofesor=$idprofesor&status_acta=$status_acta"));
        exit;
    }

    private function promedioTotal(array $parciales)
    {
        $total_parciales = 0;
        $suma_calificaciones = 0;

        for($i = 0; $i < count($parciales); $i++)
        {
            $parcial = $parciales[$i];

            if (is_numeric($parcial) || $parcial == "NA")
            {
                if($parcial == "NA"){
                    $parcial = 0;
                }

                $suma_calificaciones = $suma_calificaciones + $parcial;
                $total_parciales = $total_parciales + 1;
            }
        }

        $promedio_p = ($total_parciales > 0) ? round($suma_calificaciones / $total_parciales, 0) : "";

        return $promedio_p;
    }

    private function vertificarOpcionCalificacion(array $parciales)
    {
        $total_reprobados = 0;

        for($i = 0; $i < count($parciales); $i++)
        {
            $parcial = $parciales[$i];

            if($parcial == "NA")
            {
                $total_reprobados = $total_reprobados + 1;
            }
        }

        return $total_reprobados;
    }
}