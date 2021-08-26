<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Html;
use Fpdf\Fpdf;

use app\models\User;

class PDF extends FPDF
{
    public $reporte;

    public function setReporte( $reporte ) {
        $this->reporte = $reporte;
    }

    public function getReporte() {
        return $this->reporte;
    }

    public function Header()
    {
        if($this->getReporte() == 'Boleta')
        {
            $url_header = Yii::$app->basePath.'/web/img/header.png';
            $this->Image( $url_header, 10, 5, 150 );
            $this->AddFont( 'Montserrat-Bold', '', 'Montserrat-Bold.php' );
            $this->SetFont( 'Montserrat-Bold', '', 9 );
            $this->SetTextColor( 125, 125, 125 );
            $this->Text( 130, 35, utf8_decode( 'Instituto Tecnológico de Huimanguillo' ) );
            $this->SetFontSize( 8 );
            $this->Text( 80, 42, utf8_decode( '"2021: Año de la Independencia"' ) );

            $this->AddFont( 'Montserrat-SemiBold', '', 'Montserrat-SemiBold.php' );
            $this->SetFont( 'Montserrat-SemiBold', '', 8 );
            $this->SettextColor( 76, 76, 76 );
            $this->Text( 12, 50, utf8_decode( 'SEP' ) );
            $this->Text( 50, 50, utf8_decode( 'INSTITUTO TECNOLÓGICO DE HUIMANGUILLO' ) );
            $this->Text( 140, 50, utf8_decode( 'SES' ) );
            $this->Text( 155, 50, utf8_decode( 'TNM' ) );
        }
        else if($this->getReporte() == 'Horario')
        {
            $url_header = Yii::$app->basePath.'/web/img/header_horario.png';
            $this->Image( $url_header, 10, 5, 197 );

            $this->AddFont( 'Montserrat-SemiBold', '', 'Montserrat-SemiBold.php' );
            $this->SetFont( 'Montserrat-SemiBold', '', 8 );
            $this->SettextColor( 76, 76, 76 );
            $this->Text( 12, 50, utf8_decode( 'SEP' ) );
            $this->Text( 50, 50, utf8_decode( 'INSTITUTO TECNOLÓGICO DE HUIMANGUILLO' ) );
            $this->Text( 140, 50, utf8_decode( 'SES' ) );
            $this->Text( 155, 50, utf8_decode( 'TNM' ) );
        }
        else
        {

        }

        
    }

    public function Footer()
    {
        //$this->SetXY( 100, 100 );
        //$this->SetFont( 'Arial', 'I', 8 );
        //$this->Cell( 0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C' );
        if($this->getReporte() == 'Boleta')
        {
            $url_footer = Yii::$app->basePath.'/web/img/footer.png';
            $this->Image($url_footer, 12, 245, 185);
        }
        else if($this->getReporte() == 'Horario')
        {

            $url_firma = Yii::$app->basePath.'/web/img/firma_horario.png';
            $this->Image($url_firma, 30, 185, 45);
            $url_sello = Yii::$app->basePath.'/web/img/sello_horario.png';
            $this->Image($url_sello, 80, 185, 60);

            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 8);
            $this->Line(30, 235, 80, 235);
            $this->Text(37, 240, utf8_decode( 'DIVISIÓN DE ESTUDIOS'));
            $this->Text(41, 245, 'PROFESIONALES');
            $this->Line(130, 235, 180, 235);
            $this->Text(147, 240, 'ESTUDIANTE');
            $this->SetTextColor(125, 125, 125);
            $this->Text(12, 265, '181240065');
            $this->Text(190, 265, 'Rev. O');
        }

    }
}

class ReporteController extends Controller
{
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['listaalumnos'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['listaalumnos'],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 3);
                            },  
                        ]
                    ],
                ],
                //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
                //sólo se puede acceder a través del método post
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ],
        ];
    }

    public function actionBoleta()
    {
        $idestudiante = Html::encode( $_REQUEST['id'] );
        $idciclo = Html::encode( $_REQUEST['idciclo'] );

        $sql_encabezado = "SELECT
                               *
                           FROM
                                boleta_estudiante_encabezado
                           WHERE
                                idestudiante = :idestudiante
                           AND
                                idciclo = :idciclo";
        $encabezado = Yii::$app->db->createCommand($sql_encabezado)
                                   ->bindValue(':idestudiante', $idestudiante)
                                   ->bindValue(':idciclo', $idciclo)
                                   ->queryOne();

        $sql_materias = "SELECT
                            *
                         FROM
                            boleta_detalle_v
                         WHERE
                            idestudiante = :idestudiante
                         AND
                            idciclo = :idciclo";
        $cuerpo = Yii::$app->db->createCommand($sql_materias)
                               ->bindValue(':idestudiante', $idestudiante)
                               ->bindValue(':idciclo', $idciclo)
                               ->queryAll();

        $periodo = utf8_decode($encabezado['desc_ciclo']);
        $fecha = date('Y-m-d');
        $no_control = $encabezado['idestudiante'];
        $estudiante = $encabezado['nombre_estudiante'];
        $semestre = $encabezado['num_semestre'];
        $carrera = $encabezado['desc_carrera'];
        $especialidad = '';
        $plan = $encabezado['plan_estudios'];

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setReporte('Boleta');
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $pdf->SetFont('Montserrat-SemiBold', '', 8);
        $pdf->SettextColor(0, 0, 0);
        $pdf->Text(12, 60, utf8_decode( 'BOLETA DE CALIFICACIONES AL PERIODO:'));
        $pdf->Text(78, 60, $periodo);
        $pdf->Text(125, 60, 'FECHA:');
        $pdf->Text(138, 60, $fecha);
        $pdf->Text(12, 70, utf8_decode('NÚMERO DE CONTROL:'));
        $pdf->Text(49, 70, utf8_decode($no_control));
        $pdf->Text(12, 75, utf8_decode('ESTUDIANTE:'));
        $pdf->Text(49, 75, utf8_decode($estudiante));
        //$pdf->Text( 12, 80, utf8_decode( 'SEMESTRE:' ) );
        //$pdf->Text( 32, 80, utf8_decode( $semestre ) );
        //$pdf->Text( 12, 85, utf8_decode( 'CARRERA:' ) );
        //$pdf->Text( 30, 85, utf8_decode( $carrera ) );
        $pdf->Text(12, 80, utf8_decode('CARRERA:'));
        $pdf->Text(49, 80, utf8_decode($carrera));
        //$pdf->Text( 12, 90, utf8_decode( 'ESPECIALIDAD:' ) );
        //$pdf->Text( 38, 90, utf8_decode( $especialidad ) );
        //$pdf->Text( 12, 95, utf8_decode( 'PLAN:' ) );
        //$pdf->Text( 24, 95, utf8_decode( $plan ) );
        $pdf->Text(12, 85, utf8_decode('PLAN:'));
        $pdf->Text(49, 85, utf8_decode($plan));

        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->SetXY(12, 90);
        $pdf->Cell(95, 5, 'MATERIA', 1, 0, 'C');
        $pdf->Cell(20, 5, 'CLAVE', 1, 0, 'C');
        $pdf->Cell(15, 5, 'GRUPO', 1, 0, 'C');
        $pdf->Cell(15, 5, utf8_decode('OPCIÓN'), 1, 0, 'C');
        $pdf->Cell(10, 5, utf8_decode('CR'), 1, 0, 'C');
        $pdf->Cell(40, 5, utf8_decode('CALIFICACIÓN'), 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Montserrat-Regular', '', 6.5);

        $total_materias = count($cuerpo);
        $calificacion_acumulada = 0;
        $creditos_acumulados = 0;

        if($total_materias > 0)
        {
            foreach($cuerpo as $row)
            {
                $calificacion = ($row['calificacion'] == 'N/A' || $row['calificacion'] === 'NA') ? 0 : $row['calificacion'];
                //Convierte a 0 cuando el valor de la calificación es NA
                $calificacion_acumulada = $calificacion_acumulada + $calificacion;
                $creditos_acumulados = $creditos_acumulados + $row['creditos'];

                $pdf->SetX(12);
                $pdf->Cell(95, 5, utf8_decode( $row['desc_materia'] ), 1, 0, 'L');
                $pdf->Cell(20, 5, utf8_decode( $row['cve_materia'] ), 1, 0, 'C');
                $pdf->Cell(15, 5, utf8_decode( $row['desc_grupo'] ), 1, 0, 'C');
                $pdf->Cell(15, 5, utf8_decode( $row['opc_curso'] ), 1, 0, 'C');
                $pdf->Cell(10, 5, utf8_decode( $row['creditos'] ), 1, 0, 'C');
                $pdf->Cell(40, 5, utf8_decode( $row['calificacion'] ), 1, 0, 'C');
                $pdf->Ln();
            }

            $promedio = round($calificacion_acumulada / $total_materias, 0);

            $pdf->SetFont('Montserrat-Regular', '', 8);
            $pdf->SetX(12);
            $pdf->Cell(145, 10, utf8_decode('CRÉDITOS APROBADOS'), 1, 0, 'R');
            $pdf->Cell(10, 10, $creditos_acumulados, 1, 0, 'C');
            $pdf->SetFont('Montserrat-Regular', '', 6.5);
            $pdf->MultiCell(20, 5, 'PROMEDIO PARCIAL', 1, 'C', false);
            $pdf->SetFont('Montserrat-Bold', '', 8);
            $y = $pdf->GetY() - 10;
            $pdf->SetXY(187, $y);
            $pdf->Cell(20, 10, $promedio, 1, 0, 'C');
        }

        $pdf->SetFont('Montserrat-Bold', '', 10);
        $pdf->Text(12, 185, 'A T E N T A M E N T E');
        $pdf->SetFont('Montserrat-MediumItalic', '', 8);
        $pdf->Text(12, 189, utf8_decode('Excelencia en Educación Tecnológica®')) ;
        $pdf->SetFont('Montserrat-LightItalic', '', 8);
        $pdf->Text(12, 193, utf8_decode('"DONDE MORA EL SABER MORA LA PATRIA"®'));
        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->Text(12, 230, utf8_decode('MANUEL ERNESTO VILLALOBOS LÓPEZ'));
        $pdf->Text(12, 234, utf8_decode('JEFE DEL DEPARTAMENTO DE SERVICIOS ESCOLARES'));
        $pdf->SetFont('Montserrat-Regular', '', 7);
        $pdf->Text(12, 238, utf8_decode('C.c.p. SE'));
        $pdf->Text(12, 242, utf8_decode('L.I. MEVL/'));

        $url_firma = Yii::$app->basePath.'/web/img/firma_boleta.png';
        $pdf->Image($url_firma, 40, 190, 45);

        $url_firma = Yii::$app->basePath.'/web/img/sello_boleta.png';
        $pdf->Image($url_firma, 130, 190, 45);

        $pdf->Output('D', $idestudiante.'_'.$periodo.'.pdf');
    }

    public function actionHorario()
    {
        $idestudiante = Html::encode($_REQUEST['id']);
        $idciclo = Html::encode($_REQUEST['idciclo']);

        $sql_encabezado = "SELECT
                                *
                           FROM
                                boleta_estudiante_encabezado
                           WHERE
                                idestudiante=:idestudiante
                           AND
                                idciclo = :idciclo";
        $encabezado = Yii::$app->db->createCommand($sql_encabezado)
                                   ->bindValue(':idestudiante', $idestudiante)
                                   ->bindValue(':idciclo', $idciclo)
                                   ->queryOne();

        $sql_materias = "SELECT
                            *
                         FROM
                            horario_estudiante_v
                         WHERE
                            idestudiante =:idestudiante
                         AND
                            idciclo = :idciclo";
        $cuerpo = Yii::$app->db->createCommand($sql_materias)
                               ->bindValue(':idestudiante', $idestudiante)
                               ->bindValue(':idciclo', $idciclo)
                               ->queryAll();

        $periodo = utf8_decode($encabezado['desc_ciclo']);
        $fecha = date('Y-m-d');
        $no_control = $encabezado['idestudiante'];
        $estudiante = $encabezado['nombre_estudiante'];
        $semestre = $encabezado['num_semestre'];
        $carrera = $encabezado['desc_carrera'];
        $especialidad = '';
        $plan = $encabezado['plan_estudios'];

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setReporte('Horario');
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $pdf->SetFont('Montserrat-SemiBold', '', 8);
        $pdf->SettextColor(0, 0, 0);
        $pdf->Text(60, 58, utf8_decode('CARGA ACADÉMICA AL PERIODO:'));
        $pdf->Text(115, 58, $periodo);
        $pdf->Text(12, 65, 'FECHA:');
        $pdf->Text(49, 65, $fecha);
        $pdf->Text(12, 70, utf8_decode('NÚMERO DE CONTROL:'));
        $pdf->Text(49, 70, utf8_decode($no_control));
        $pdf->Text(12, 75, utf8_decode('ESTUDIANTE:'));
        $pdf->Text(49, 75, utf8_decode($estudiante));
        $pdf->Text(12, 80, utf8_decode('CARRERA:'));
        $pdf->Text(49, 80, utf8_decode($carrera));
        $pdf->Text(12, 85, utf8_decode('PLAN:'));
        $pdf->Text(49, 85, utf8_decode($plan));
        $pdf->Text(120, 85, utf8_decode('CRÉDITOS:'));

        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->SetXY(8, 90);
        $pdf->Cell(75, 7, 'MATERIA / DOCENTE', 1, 0, 'C');
        $pdf->Cell(13, 7, 'CLAVE', 1, 0, 'C');
        $pdf->Cell(12, 7, 'GRUPO', 1, 0, 'C');
        $pdf->Cell(9, 7, 'REP', 1, 0, 'C');
        $pdf->Cell(7, 7, 'CR', 1, 0, 'C');
        $pdf->SetFont('Montserrat-Bold', '', 6);
        $pdf->Cell(14, 7, 'LUNES', 1, 0, 'C');
        $pdf->Cell(14, 7, 'MARTES', 1, 0, 'C');
        $pdf->Cell(14, 7, utf8_decode('MIÉRCOLES'), 1, 0, 'C');
        $pdf->Cell(14, 7, 'JUEVES', 1, 0, 'C');
        $pdf->Cell(14, 7, 'VIERNES', 1, 0, 'C');
        $pdf->Cell(14, 7, utf8_decode('SÁBADO'), 1, 0, 'C');
        $pdf->Ln();

        $creditos_acumulados = 0;
        foreach($cuerpo as $row)
        {
            $lunes = $row['lunes'] != '' ? $row['lunes'] : '---';
            $martes = $row['martes'] != '' ? $row['martes'] : '---';
            $miercoles = $row['miercoles'] != '' ? $row['miercoles'] : '---';
            $jueves = $row['jueves'] != '' ? $row['jueves'] : '---';
            $viernes = $row['viernes'] != '' ? $row['viernes'] : '---';
            $sabado = $row['sabado'] != '' ? $row['sabado'] : '---';

            $creditos_acumulados = $creditos_acumulados + $row['creditos'];

            $pdf->SetX(8);
            $pdf->SetFont('Montserrat-Regular', '', 6);
            $pdf->MultiCell(75, 5, utf8_decode( $row['desc_materia'])."\n".utf8_decode($row['profesor']), 1, 'L', 0);

            $y = $pdf->GetY() - 10;
            $pdf->SetXY(83, $y);

            $pdf->Cell(13, 10, utf8_decode($row['cve_materia'] ), 1, 0, 'C');
            $pdf->Cell(12, 10, utf8_decode($row['desc_grupo_corto'] ), 1, 0, 'C');
            $pdf->Cell(9, 10, utf8_decode($row['desc_opcion_curso_corto']), 1, 0, 'C');
            $pdf->Cell(7, 10, utf8_decode($row['creditos'] ), 1, 0, 'C');
            $pdf->Cell(14, 10, $lunes, 1, 0, 'C');
            $pdf->Cell(14, 10, $martes, 1, 0, 'C');
            $pdf->Cell(14, 10, $miercoles, 1, 0, 'C');
            $pdf->Cell(14, 10, $jueves, 1, 0, 'C');
            $pdf->Cell(14, 10, $viernes, 1, 0, 'C');
            $pdf->Cell(14, 10, $sabado, 1, 0, 'C');

            $pdf->Ln();
        }
        $pdf->SetFont('Montserrat-SemiBold', '', 8);
        $pdf->Text(138, 85, utf8_decode($creditos_acumulados));

        $pdf->Output('D', $idestudiante.'_'.$periodo.'.pdf');
    }

    public function actionListaalumnos()
    {
        $idgrupo = Html::encode($_REQUEST['idgrupo']);

        $sql_encabezado = "SELECT
                               *
                           FROM
                                boleta_estudiante_encabezado, grupos
                           WHERE
                                grupos.idgrupo = :idgrupo";
        $encabezado = Yii::$app->db->createCommand($sql_encabezado)
                                   ->bindValue(':idgrupo', $idgrupo)
                                   ->queryOne();

        $sql_estudiantes = "SELECT
                                estudiantes.idestudiante,
    	                        estudiantes.nombre_estudiante,
	                            estudiantes.sexo,
	                            cat_opcion_curso.desc_opcion_curso
                            FROM
    	                        estudiantes
	                        INNER JOIN grupos_estudiantes ON estudiantes.idestudiante = grupos_estudiantes.idestudiante
	                        INNER JOIN cat_opcion_curso ON grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso
                            WHERE
                                grupos_estudiantes.idgrupo = :idgrupo";
        $cuerpo = Yii::$app->db->createCommand($sql_estudiantes)
                               ->bindValue(':idgrupo', $idgrupo)
                               ->queryAll();

        $periodo = utf8_decode($encabezado['desc_ciclo']);
        $fecha = date('Y-m-d');
        $carrera = $encabezado['desc_carrera'];
        $plan = $encabezado['plan_estudios'];

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setReporte('Boleta');
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $pdf->SetFont('Montserrat-SemiBold', '', 8);
        $pdf->SettextColor(0, 0, 0);
        $pdf->Text(12, 60, utf8_decode('PERIODO:'));
        $pdf->Text(30, 60, $periodo);
        $pdf->Text(125, 60, 'FECHA:');
        $pdf->Text(138, 60, $fecha);
        $pdf->Text(12, 65, utf8_decode('CARRERA:'));
        $pdf->Text(30, 65, utf8_decode($carrera));
        $pdf->Text(12, 70, utf8_decode('PLAN:'));
        $pdf->Text(30, 70, utf8_decode($plan));

        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->SetXY(12, 80);
        $pdf->Cell(10, 5, 'NO.', 1, 0, 'C');
        $pdf->Cell(30, 5, 'NO. CONTROL', 1, 0, 'C');
        $pdf->Cell(110, 5, 'ESTUDIANTE', 1, 0, 'C');
        $pdf->Cell(15, 5, 'SEXO', 1, 0, 'C');
        $pdf->Cell(25, 5, utf8_decode('OPCIÓN'), 1, 0, 'C');
        $pdf->Ln();

        $total_estudiantes = count($cuerpo);

        if($total_estudiantes > 0)
        {
            $numero = 1;
            $pdf->SetFont('Montserrat-regular', '', 8);
            foreach ($cuerpo as $row)
            {
                $pdf->SetX(12);
                $pdf->Cell(10, 5, $numero, 1, 0, 'C');
                $pdf->Cell(30, 5, $row['idestudiante'], 1, 0, 'C');
                $pdf->Cell(110, 5, utf8_decode($row['nombre_estudiante']), 1, 0, 'L');
                $pdf->Cell(15, 5, $row['sexo'], 1, 0, 'C');
                $pdf->Cell(25, 5, utf8_decode($row['desc_opcion_curso']), 1, 0, 'C');
                $pdf->Ln();
                $numero = $numero + 1;
            }
        }

        $pdf->Output('D', utf8_decode($encabezado['desc_grupo'])."_".$periodo.'.pdf');
    }

    public function actionHorarioprofesor()
    {
        //$idgrupo = Html::encode($_REQUEST['idgrupo']);

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setReporte('Horario Profesor');
        $pdf->AliasNbPages();
        $pdf->AddPage('L', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $pdf->SetFont('Montserrat-SemiBold', '', 14);
        $pdf->SettextColor(0, 0, 0);
        $url_header = Yii::$app->basePath.'/web/img/SEP1.png';
        $pdf->Image($url_header, 5, 7, 70);
        $pdf->Rect(5, 5, 270, 25);
        $pdf->Line(75, 5, 75, 30);
        $pdf->Line(200, 5, 200, 30);
        $pdf->Line(75, 18, 275, 18);
        $pdf->Text(115, 16, "Horario de Trabajo");
        $pdf->SetFont('Montserrat-SemiBold', '', 10);
        $pdf->Text(105, 27, "Referencia a la Norma ISO 9001:2015");
        $pdf->Line(200, 12, 275, 12);
        $pdf->Line(220, 5, 220, 30);
        $pdf->Text(202, 10, utf8_decode("Código:"));
        $pdf->Text(227, 10, utf8_decode("TecNM-AC-PO-003-01"));
        $pdf->Text(202, 16, utf8_decode("Revisión:"));
        $pdf->Text(245, 16, "0");
        $pdf->Text(202, 27, utf8_decode("Página"));
        $pdf->Text(242, 27, utf8_decode("1 de 2"));

        $pdf->Rect(5, 40, 270, 40);
        
        $pdf->Output('I', 'horario.pdf');
    }
}