<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Html;
use Fpdf\Fpdf;

use app\models\User;
use app\models\login\Usuario;
use app\models\ciclo\Ciclo;
use app\models\materia\Materia;
use app\models\profesor\Profesor;
use app\models\grupo\Grupo;

use app\repositories\EstudianteRepository;
use app\repositories\ProfesorRepository;
use app\repositories\CarreraRepository;
use app\repositories\GrupoRepository;
use app\repositories\MateriaRepository;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PDF extends FPDF
{
    public $header;
    public $footer;
    public $profesor;
    public $noControl;

    #region public function setNoControl($noControl)
    public function setNoControl($noControl)
    {
        $this->noControl = $noControl;
    }
    #endregion

    #region public function getNoControl()
    public function getNoControl()
    {
        return $this->noControl;
    }
    #endregion

    #region public function setHeader($header)
    public function setHeader($header)
    {
        $this->header = $header;
    }
    #endregion

    #region public function getHeader()
    public function getHeader()
    {
        return $this->header;
    }
    #endregion

    #region public function setFooter($footer)
    public function setFooter($footer)
    {
        $this->footer = $footer;
    }
    #endregion

    #region public function getFooter()
    public function getFooter()
    {
        return $this->footer;
    }
    #endregion

    #region public function setProfesor($profesor)
    public function setProfesor($profesor)
    {
        $this->profesor = $profesor;
    }
    #endregion

    #region public function getProfesor()
    public function getProfesor()
    {
        return $this->profesor;
    }
    #endregion

    #region public function Header()
    public function Header()
    {
        if($this->getHeader() == 'Boleta')
        {
            $url_header = Yii::$app->basePath.'/web/img/header.png';
            $this->Image($url_header, 10, 5, 150);
            $this->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $this->SetFont('Montserrat-Bold', '', 9);
            $this->SetTextColor(125, 125, 125);
            $this->Text(130, 35, utf8_decode('Instituto Tecnológico de Huimanguillo'));
            $this->SetFontSize(8);
            $this->Text(80, 42, utf8_decode('"2021: Año de la Independencia"'));

            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 8);
            $this->SetTextColor(76, 76, 76);
            $this->Text(12, 50, utf8_decode('SEP'));
            $this->Text(50, 50, utf8_decode('INSTITUTO TECNOLÓGICO DE HUIMANGUILLO'));
            $this->Text(140, 50, utf8_decode('SES'));
            $this->Text(155, 50, utf8_decode('TNM'));
        }
        else if($this->getHeader() == 'Horario')
        {
            $url_header = Yii::$app->basePath.'/web/img/header_horario.png';
            $this->Image($url_header, 10, 5, 197);

            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 8);
            $this->SetTextColor(76, 76, 76);
            $this->Text(12, 50, utf8_decode('SEP'));
            $this->Text(50, 50, utf8_decode('INSTITUTO TECNOLÓGICO DE HUIMANGUILLO'));
            $this->Text(140, 50, utf8_decode('SES'));

            $this->SetFont('Arial', 'B', 9);
            $this->SetFillColor(255,255,255);
            $this->SetTextColor(127, 127, 127);
            $this->SetXY(161, 5.5);
            $this->Cell(30, 5, $this->getNoControl(), 0, 1, 'L', 1);
        }
        else if($this->getHeader() == 'Lista Alumnos')
        {
            $url_header = Yii::$app->basePath.'/web/img/header.png';
            $this->Image($url_header, 10, 5, 150);
            $this->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $this->SetFont('Montserrat-Bold', '', 9);
            $this->SetTextColor(125, 125, 125);
            $this->Text(130, 35, utf8_decode('Instituto Tecnológico de Huimanguillo'));
            $this->SetFontSize(8);
            $this->Text(80, 42, utf8_decode('"2021: Año de la Independencia"'));

            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 8);
            $this->SetTextColor(76, 76, 76);
            $this->Text(12, 50, utf8_decode('SEP'));
            $this->Text(50, 50, utf8_decode('INSTITUTO TECNOLÓGICO DE HUIMANGUILLO'));
            $this->Text(140, 50, utf8_decode('SES'));
            $this->Text(155, 50, utf8_decode('TNM'));
        }
        if($this->getHeader() == 'Alumnos Calificacion')
        {
            $url_header = Yii::$app->basePath.'/web/img/header.png';
            $this->Image($url_header, 10, 5, 150);
            $this->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $this->SetFont('Montserrat-Bold', '', 9);
            $this->SetTextColor(125, 125, 125);
            $this->Text(130, 35, utf8_decode('Instituto Tecnológico de Huimanguillo'));
            $this->SetFontSize(8);
            $this->Text(80, 42, utf8_decode('"2021: Año de la Independencia"'));

            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 8);
            $this->SetTextColor(76, 76, 76);
            $this->Text(12, 50, utf8_decode('SEP'));
            $this->Text(50, 50, utf8_decode('INSTITUTO TECNOLÓGICO DE HUIMANGUILLO'));
            $this->Text(140, 50, utf8_decode('SES'));
            $this->Text(155, 50, utf8_decode('TNM'));
        }
        if($this->getHeader() == 'Acta Calificaciones')
        {
            $url_header = Yii::$app->basePath.'/web/img/header.png';
            $this->Image($url_header, 10, 5, 150);
            $this->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $this->SetFont('Montserrat-Bold', '', 9);
            $this->SetTextColor(125, 125, 125);
            $this->Text(90, 38, utf8_decode('ACTA DE CALIFICACIONES'));
            $this->Text(130, 30, utf8_decode('Instituto Tecnológico de Huimanguillo'));
            $this->Text(160, 35, utf8_decode('CLAVE: 27DIT0004E'));
        }
        else if($this->getHeader() == 'Reporte Final Profesor')
        {
            $url_header = Yii::$app->basePath.'/web/img/header_reporte_final.png';
            $this->Image($url_header, 10, 5, 197);
        }
        /*else if($this->getHeader() == 'Lista Calificacion')
        {
            $url_header = Yii::$app->basePath.'/web/img/header.png';
            $this->Image($url_header, 60, 5, 150);
            $this->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $this->SetFont('Montserrat-Bold', '', 9);
            $this->SetTextColor(125, 125, 125);
            $this->Text(180, 30, utf8_decode('Instituto Tecnológico de Huimanguillo'));
            $this->SetFontSize(8);
            $this->Text(120, 37, utf8_decode('"2021: Año de la Independencia"'));
            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 8);
            $this->SettextColor(76, 76, 76);
            $this->Text(50, 45, utf8_decode('SEP'));
            $this->Text(80, 45, utf8_decode('INSTITUTO TECNOLÓGICO DE HUIMANGUILLO'));
            $this->Text(180, 45, utf8_decode('SES'));
            $this->Text(220, 45, utf8_decode('TNM'));
        }*/
    }
    #endregion

    #region public function Footer()
    public function Footer()
    {
        //Imprime el número de páginas en el pie de cada página
        $this->SetXY(205, 265);
        $this->AddFont('Montserrat-Bold', '', 'Montserrat-Regular.php');
        $this->SetFont('Montserrat-regular', '', 7.5);
        $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().'-{nb}', 0, 0, 'C');

        if($this->getFooter() == 'Boleta')
        {
            $url_footer = Yii::$app->basePath.'/web/img/footer.png';
            $this->Image($url_footer, 12, 245, 185);
        }
        else if($this->getFooter() == 'Horario')
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
            $this->Text(12, 265, $this->getNoControl());
            $this->Text(190, 265, 'Rev. O');
        }
        else if($this->getFooter() == 'Lista Alumnos')
        {
            $url_footer = Yii::$app->basePath.'/web/img/footer.png';
            $this->Image($url_footer, 12, 245, 185);
        }
        else if($this->getFooter() == 'Alumnos Calificacion')
        {
            $url_footer = Yii::$app->basePath.'/web/img/footer.png';
            $this->Image($url_footer, 12, 245, 185);
        }
        else if($this->getFooter() == 'Acta Calificaciones')
        {
            $url_footer = Yii::$app->basePath.'/web/img/footer.png';
            $this->Image($url_footer, 12, 245, 185);
        }
        else if($this->getFooter() == 'Reporte Final Profesor')
        {
            $this->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $this->SetFont('Montserrat-SemiBold', '', 10);
            $this->Line(25, 245, 95, 245);
            $this->Text(48, 225, utf8_decode('DOCENTE'));
            $this->SetXY(20, 237);
            $this->Cell(80, 5, $this->getProfesor(), 0, 0, 'C');
            $this->Line(120, 245, 190, 245);
            $this->Text(130, 225, utf8_decode('JEFE DEL ÁREA ACADÉMICA'));
            $this->Text(135, 240, utf8_decode('ALEXIS PIÑA MARCIAL'));
            $this->SetTextColor(125, 125, 125);
            $this->Text(12, 265, '181240065');
            $this->Text(190, 265, 'Rev. O');
        }
    }
    #endregion
}

class ReporteController extends Controller
{
    private $estudianteRepository;
    private $profesorRepository;
    private $carreraRepository;
    private $grupoRepository;
    private $materiaRepository;

    #region public function behaviors()
    public function behaviors()
    {
        return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['listaalumnos', 'horarioprofesor', 'listaalumnoscalificacion', 'listaalumnoscalificacionprofesor'],//Especificar que acciones se van proteger
                    'rules' => [
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['listaalumnos', 'horarioprofesor', 'listaalumnoscalificacion', 'listaalumnoscalificacionprofesor'],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 1);
                            },  
                        ],
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['listaalumnos', 'horarioprofesor', 'listaalumnoscalificacion', 'listaalumnoscalificacionprofesor'],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 2);
                            },  
                        ],
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['listaalumnos', 'horarioprofesor', 'listaalumnoscalificacion', 'listaalumnoscalificacionprofesor'],//Especificar que acciones tiene permitidas este usuario
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
                        ],
                        [
                            //El administrador tiene permisos sobre las siguientes acciones
                            'actions' => ['listaalumnos', 'horarioprofesor', 'listaalumnoscalificacion', 'listaalumnoscalificacionprofesor'],//Especificar que acciones tiene permitidas este usuario
                            //Esta propiedad establece que tiene permisos
                            'allow' => true,
                            //Usuarios autenticados, el signo ? es para invitados
                            'roles' => ['@'],
                            //Este método nos permite crear un filtro sobre la identidad del usuario
                            //y así establecer si tiene permisos o no
                            'matchCallback' => function ($rule, $action) {
                                //Llamada al método que comprueba si es un administrador
                                //return User::isUserAdministrador(Yii::$app->user->identity->idusuario);
                                return User::isUserAutenticado(Yii::$app->user->identity->idusuario, 4);
                            },  
                        ],
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
    #endregion

    #region public function __construct()
    public function __construct($id, $module, $config = [],
                                EstudianteRepository $estudianteRepository,
                                ProfesorRepository $profesorRepository,
                                CarreraRepository $carreraRepository,
                                GrupoRepository $grupoRepository,
                                MateriaRepository $materiaRepository
                                )
    {
        parent::__construct($id, $module, $config);
        $this->estudianteRepository = $estudianteRepository;
        $this->profesorRepository = $profesorRepository;
        $this->carreraRepository = $carreraRepository;
        $this->grupoRepository = $grupoRepository;
        $this->materiaRepository = $materiaRepository;
    }
    #endregion

    #region public function actionBoleta()
    public function actionBoleta()
    {
        $idestudiante = Html::encode($_REQUEST['id']);
        $idciclo = Html::encode($_REQUEST['idciclo']);

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
        $pdf->setHeader('Boleta');
        $pdf->setFooter('Boleta');
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
        $pdf->Text(12, 80, utf8_decode('CARRERA:'));
        $pdf->Text(49, 80, utf8_decode($carrera));
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
                $calificacion = ($row['calificacion'] == 'NA' || $row['calificacion'] == '') ? 0 : $row['calificacion'];
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

        $pdf->Output('D', $estudiante.'_'.$periodo.'.pdf');
    }
    #endregion

    #region public function actionHorario()
    public function actionHorario()
    {
        $idestudiante = Html::encode($_REQUEST['id']);
        $idciclo = Html::encode($_REQUEST['idciclo']);

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
                            horario_estudiante_v
                         WHERE
                            idestudiante =:idestudiante
                         AND
                            idciclo = :idciclo
                         ORDER BY
                            lunes, viernes, sabado";
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
        $pdf->SetHeader('Horario');
        $pdf->SetFooter('Horario');
        $pdf->SetNoControl($no_control);
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $pdf->SetFont('Montserrat-SemiBold', '', 8);
        $pdf->SetTextColor(0, 0, 0);
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
            $pdf->MultiCell(75, 5, utf8_decode( $row['desc_materia'])."\n".utf8_decode($row['profesor'])." - Aula: ".utf8_decode($row['aula']), 1, 'L', 0);

            $y = $pdf->GetY() - 10;
            $pdf->SetXY(83, $y);

            $pdf->Cell(13, 10, utf8_decode($row['cve_materia'] ), 1, 0, 'C');
            $pdf->Cell(12, 10, utf8_decode($row['desc_grupo'] ), 1, 0, 'C');
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
    #endregion

    #region public function actionListaalumnos()
    public function actionListaalumnos()
    {
        $idgrupo = Html::encode($_REQUEST['idgrupo']);
        $idciclo = (Html::encode($_REQUEST['idciclo']) != "") ? Html::encode($_REQUEST['idciclo']) : Ciclo::find()->max("idciclo");

        $encabezado = (new \yii\db\Query())->from(["cat_carreras"])
                                           ->select(["ciclo.desc_ciclo",
                                                    "cat_carreras.desc_carrera",
                                                    "cat_carreras.plan_estudios",
                                                    "grupos.desc_grupo",
                                                    "grupos.desc_grupo_corto",
                                                    "cat_materias.desc_materia"
                                           ])
                                           ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                                           ->innerJoin(["ciclo"], "ciclo.idciclo = grupos.idciclo")
                                           ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                                           ->where(["grupos.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                                           ->one();

        $cuerpo = (new \yii\db\Query())->from(["estudiantes"])
                                     ->select(["estudiantes.idestudiante",
                                               "estudiantes.nombre_estudiante",
                                               "estudiantes.sexo",
                                               "cat_opcion_curso.desc_opcion_curso",
                                               "cat_materias.desc_materia"
                                     ])
                                     ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                                     ->innerJoin(["cat_opcion_curso"], "grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso")
                                     ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                                     ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                                     ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                                     ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                                     ->all();

        $periodo = utf8_decode($encabezado['desc_ciclo']);
        $fecha = date('Y-m-d');
        $carrera = $encabezado['desc_carrera'];
        $plan = $encabezado['plan_estudios'];
        $materia = $cuerpo[0]['desc_materia'];
        $grupo = $encabezado['desc_grupo'];

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setHeader('Lista Alumnos');
        $pdf->setFooter('Lista Alumnos');
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
        $pdf->Text(12, 75, utf8_decode('MATERIA:'));
        $pdf->Text(30, 75, utf8_decode($materia));
        $pdf->Text(12, 80, utf8_decode('GRUPO:'));
        $pdf->Text(30, 80, utf8_decode($grupo));

        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->SetXY(12, 85);
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
    #endregion

    #region public function actionListaalumnoscalificacion($idgrupo, $idciclo)
    public function actionListaalumnoscalificacion($idgrupo, $idciclo)
    {
        $idgrupo = Html::encode($idgrupo);
        $idciclo = Html::encode($idciclo);

        $materia = (new \yii\db\Query())
                            ->from(["grupos"])
                            ->select(["cat_materias.desc_materia"])
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->one();

        $encabezado = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                "ciclo.desc_ciclo",
                            	"cat_carreras.desc_carrera",
	                            "cat_carreras.plan_estudios",
	                            "grupos.desc_grupo",
	                            "grupos.desc_grupo_corto",
	                            "cat_materias.desc_materia",
                                "CONCAT(profesores.apaterno, ' ', profesores.amaterno, ' ', profesores.nombre_profesor) AS profesor"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["ciclo"], "ciclo.idciclo = grupos.idciclo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->innerJoin(["profesores"], "grupos.idprofesor = profesores.idprofesor")
                            ->where(["grupos.idgrupo" => $idgrupo, "ciclo.idciclo" => $idciclo])
                            ->all();

        $cuerpo = (new \yii\db\Query())
                            ->from(["estudiantes"])
                            ->select([
                                "estudiantes.idestudiante",
    	                        "estudiantes.nombre_estudiante",
                                "grupos_estudiantes.p1", "grupos_estudiantes.p2", "grupos_estudiantes.p3",
                                "grupos_estudiantes.p4", "grupos_estudiantes.p5", "grupos_estudiantes.p6",
                                "grupos_estudiantes.p7", "grupos_estudiantes.p8", "grupos_estudiantes.p9",
                                "grupos_estudiantes.s1", "grupos_estudiantes.s2", "grupos_estudiantes.s3",
                                "grupos_estudiantes.s4", "grupos_estudiantes.s5", "grupos_estudiantes.s6",
                                "grupos_estudiantes.s7", "grupos_estudiantes.s8", "grupos_estudiantes.s9",
                                "grupos_estudiantes.sp1", "grupos_estudiantes.sp2", "grupos_estudiantes.sp3",
                                "grupos_estudiantes.sp4", "grupos_estudiantes.sp5", "grupos_estudiantes.sp6",
                                "grupos_estudiantes.sp7", "grupos_estudiantes.sp8", "grupos_estudiantes.sp9"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                            ->innerJoin(["cat_opcion_curso"], "grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso")
                            ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->all();

        $periodo = utf8_decode($encabezado[0]['desc_ciclo']);
        $fecha = date('Y-m-d');
        $carrera = $encabezado[0]['desc_carrera'];
        $plan = $encabezado[0]['plan_estudios'];
        $materia = $materia['desc_materia'];
        $grupo = $encabezado[0]['desc_grupo'];
        $profesor = utf8_decode($encabezado[0]['profesor']);

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setHeader('Alumnos Calificacion');
        $pdf->setFooter('Alumnos Calificacion');
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $this->generarEncabezadoCalificaciones($pdf, 
                                              array("periodo" => $periodo,
                                                    "carrera" => $carrera,
                                                    "plan" => $plan,
                                                    "profesor" => $profesor,
                                                    "materia" => $materia,
                                                    "grupo" => $grupo,
                                                    "fecha" => $fecha,
                                                    "seguimiento" => ""),
                                              "Vertical1"
                                            );

        $x_encabezado = 5;
        $y_encabezado = 77;

        $x = $this->generarEncabezadoTablaCalificaciones($pdf, $x_encabezado, $y_encabezado, $cuerpo);

        $pdf->Ln();

        $total_estudiantes = count($cuerpo);

        $numero = 1;
        $pdf->SetFont('Montserrat-regular', '', 8);
        foreach ($cuerpo as $row)
        {
            $s1 = $row['s1'];
            $s2 = $row['s2'];
            $s3 = $row['s3'];
            $s4 = $row['s4'];
            $s5 = $row['s5'];
            $s6 = $row['s6'];
            $s7 = $row['s7'];
            $s8 = $row['s8'];
            $s9 = $row['s9'];

            $p1 = ($row['p1'] == "NA") ? (($s1 == "") ? $row['p1'] : $s1) : $row['p1'];
            $p2 = ($row['p2'] == "NA") ? (($s2 == "") ? $row['p2'] : $s2) : $row['p2'];
            $p3 = ($row['p3'] == "NA") ? (($s3 == "") ? $row['p3'] : $s3) : $row['p3'];
            $p4 = ($row['p4'] == "NA") ? (($s4 == "") ? $row['p4'] : $s4) : $row['p4'];
            $p5 = ($row['p5'] == "NA") ? (($s5 == "") ? $row['p5'] : $s5) : $row['p5'];
            $p6 = ($row['p6'] == "NA") ? (($s6 == "") ? $row['p6'] : $s6) : $row['p6'];
            $p7 = ($row['p7'] == "NA") ? (($s7 == "") ? $row['p7'] : $s7) : $row['p7'];
            $p8 = ($row['p8'] == "NA") ? (($s8 == "") ? $row['p8'] : $s8) : $row['p8'];
            $p9 = ($row['p9'] == "NA") ? (($s9 == "") ? $row['p9'] : $s9) : $row['p9'];

            $pdf->SetX($x);
            $pdf->Cell(8, 5, $numero, 1, 0, 'C');
            $pdf->Cell(25, 5, $row['idestudiante'], 1, 0, 'C');
            $pdf->Cell(75, 5, utf8_decode($row['nombre_estudiante']), 1, 0, 'L');
            ($p1 > 0 || $p1 == "NA") ? $pdf->Cell(8, 5, $p1, 1, 0, 'C') : "";
            ($p2 > 0 || $p2 == "NA") ? $pdf->Cell(8, 5, $p2, 1, 0, 'C') : "";
            ($p3 > 0 || $p3 == "NA") ? $pdf->Cell(8, 5, $p3, 1, 0, 'C') : "";
            ($p4 > 0 || $p4 == "NA") ? $pdf->Cell(8, 5, $p4, 1, 0, 'C') : "";
            ($p5 > 0 || $p5 == "NA") ? $pdf->Cell(8, 5, $p5, 1, 0, 'C') : "";
            ($p6 > 0 || $p6 == "NA") ? $pdf->Cell(8, 5, $p6, 1, 0, 'C') : "";
            ($p7 > 0 || $p7 == "NA") ? $pdf->Cell(8, 5, $p7, 1, 0, 'C') : "";
            ($p8 > 0 || $p8 == "NA") ? $pdf->Cell(8, 5, $p8, 1, 0, 'C') : "";
            ($p9 > 0 || $p9 == "NA") ? $pdf->Cell(8, 5, $p9, 1, 0, 'C') : "";
            $pdf->Ln();

            if($numero == 32 || $numero == 64 || $numero == 96)
            {
                $pdf->AddPage('P', 'Letter');
                $this->generarEncabezadoCalificaciones($pdf, 
                                                       array("periodo" => $periodo,
                                                             "carrera" => $carrera,
                                                             "plan" => $plan,
                                                             "profesor" => $profesor,
                                                             "materia" => $materia,
                                                             "grupo" => $grupo,
                                                             "fecha" => $fecha,
                                                             "seguimiento" => ""),
                                                       "Vertical1"
                                                      );
                $pdf->SetXY($x, $y_encabezado);
                $this->generarEncabezadoTablaCalificaciones($pdf, $x_encabezado, $y_encabezado, $cuerpo);
                $pdf->SetFont('Montserrat-regular', '', 8);
                $pdf->Ln();
            }
            $numero = $numero + 1;
        }

        $pdf->Output('D', utf8_decode($carrera."_".$materia."_".$grupo)."_".$periodo.'.pdf');
    }
    #endregion

    #region public function actionListaalumnoscalificacionseguimientos($idgrupo, $idciclo, $seguimiento)
    public function actionListaalumnoscalificacionseguimientos($idgrupo, $idciclo, $seguimiento)
    {
        $idgrupo = Html::encode($idgrupo);
        $idciclo = Html::encode($idciclo);

        $materia = (new \yii\db\Query())
                            ->from(["grupos"])
                            ->select(["cat_materias.desc_materia"])
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->one();

        $encabezado = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                "ciclo.desc_ciclo",
                            	"cat_carreras.desc_carrera",
	                            "cat_carreras.plan_estudios",
	                            "grupos.desc_grupo",
	                            "grupos.desc_grupo_corto",
	                            "cat_materias.desc_materia",
                                "CONCAT(profesores.apaterno, ' ', profesores.amaterno, ' ', profesores.nombre_profesor) AS profesor"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["ciclo"], "ciclo.idciclo = grupos.idciclo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->innerJoin(["profesores"], "grupos.idprofesor = profesores.idprofesor")
                            ->where(["grupos.idgrupo" => $idgrupo, "ciclo.idciclo" => $idciclo])
                            ->all();

        $cuerpo = (new \yii\db\Query())
                            ->from(["estudiantes"])
                            ->select([
                                "estudiantes.idestudiante",
    	                        "estudiantes.nombre_estudiante",
                                "grupos_estudiantes.p1", "grupos_estudiantes.p2", "grupos_estudiantes.p3",
                                "grupos_estudiantes.p4", "grupos_estudiantes.p5", "grupos_estudiantes.p6",
                                "grupos_estudiantes.p7", "grupos_estudiantes.p8", "grupos_estudiantes.p9",
                                "grupos_estudiantes.s1", "grupos_estudiantes.s2", "grupos_estudiantes.s3",
                                "grupos_estudiantes.s4", "grupos_estudiantes.s5", "grupos_estudiantes.s6",
                                "grupos_estudiantes.s7", "grupos_estudiantes.s8", "grupos_estudiantes.s9",
                                "grupos_estudiantes.sp1", "grupos_estudiantes.sp2", "grupos_estudiantes.sp3",
                                "grupos_estudiantes.sp4", "grupos_estudiantes.sp5", "grupos_estudiantes.sp6",
                                "grupos_estudiantes.sp7", "grupos_estudiantes.sp8", "grupos_estudiantes.sp9"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                            ->innerJoin(["cat_opcion_curso"], "grupos_estudiantes.idopcion_curso = cat_opcion_curso.idopcion_curso")
                            ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->all();

        $periodo = utf8_decode($encabezado[0]['desc_ciclo']);
        $fecha = date('Y-m-d');
        $carrera = $encabezado[0]['desc_carrera'];
        $plan = $encabezado[0]['plan_estudios'];
        $materia = $materia['desc_materia'];
        $grupo = $encabezado[0]['desc_grupo'];
        $profesor = utf8_decode($encabezado[0]['profesor']);

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setHeader('Alumnos Calificacion');
        $pdf->setFooter('Alumnos Calificacion');
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $this->generarEncabezadoCalificaciones($pdf, 
                                              array("periodo" => $periodo,
                                                    "carrera" => $carrera,
                                                    "plan" => $plan,
                                                    "profesor" => $profesor,
                                                    "materia" => $materia,
                                                    "grupo" => $grupo,
                                                    "fecha" => $fecha,
                                                    "seguimiento" => $seguimiento),
                                              "Vertical1"
                                            );

        $x_encabezado = 5;
        $y_encabezado = 77;

        $x = $this->generarEncabezadoTablaCalificaciones($pdf, $x_encabezado, $y_encabezado, $cuerpo, $seguimiento);

        $pdf->Ln();

        $numero = 1;
        $pdf->SetFont('Montserrat-regular', '', 8);
        foreach ($cuerpo as $row)
        {
            $s1 = $row['s1'];
            $s2 = $row['s2'];
            $s3 = $row['s3'];
            $s4 = $row['s4'];
            $s5 = $row['s5'];
            $s6 = $row['s6'];
            $s7 = $row['s7'];
            $s8 = $row['s8'];
            $s9 = $row['s9'];

            $sp1 = $row['sp1'];
            $sp2 = $row['sp2'];
            $sp3 = $row['sp3'];
            $sp4 = $row['sp4'];
            $sp5 = $row['sp5'];
            $sp6 = $row['sp6'];
            $sp7 = $row['sp7'];
            $sp8 = $row['sp8'];
            $sp9 = $row['sp9'];

            $p1 = ($row['p1'] == "NA") ? (($s1 == "") ? $row['p1'] : $s1) : $row['p1'];
            $p2 = ($row['p2'] == "NA") ? (($s2 == "") ? $row['p2'] : $s2) : $row['p2'];
            $p3 = ($row['p3'] == "NA") ? (($s3 == "") ? $row['p3'] : $s3) : $row['p3'];
            $p4 = ($row['p4'] == "NA") ? (($s4 == "") ? $row['p4'] : $s4) : $row['p4'];
            $p5 = ($row['p5'] == "NA") ? (($s5 == "") ? $row['p5'] : $s5) : $row['p5'];
            $p6 = ($row['p6'] == "NA") ? (($s6 == "") ? $row['p6'] : $s6) : $row['p6'];
            $p7 = ($row['p7'] == "NA") ? (($s7 == "") ? $row['p7'] : $s7) : $row['p7'];
            $p8 = ($row['p8'] == "NA") ? (($s8 == "") ? $row['p8'] : $s8) : $row['p8'];
            $p9 = ($row['p9'] == "NA") ? (($s9 == "") ? $row['p9'] : $s9) : $row['p9'];

            $pdf->SetX($x);
            $pdf->Cell(8, 5, $numero, 1, 0, 'C');
            $pdf->Cell(25, 5, $row['idestudiante'], 1, 0, 'C');
            $pdf->Cell(75, 5, utf8_decode($row['nombre_estudiante']), 1, 0, 'L');
            ($sp1 == $seguimiento) ? (($p1 > 0 || $p1 == "NA") ? $pdf->Cell(8, 5, $p1, 1, 0, 'C') : "") : "";
            ($sp2 == $seguimiento) ? (($p2 > 0 || $p2 == "NA") ? $pdf->Cell(8, 5, $p2, 1, 0, 'C') : "") : "";
            ($sp3 == $seguimiento) ? (($p3 > 0 || $p3 == "NA") ? $pdf->Cell(8, 5, $p3, 1, 0, 'C') : "") : "";
            ($sp4 == $seguimiento) ? (($p4 > 0 || $p4 == "NA") ? $pdf->Cell(8, 5, $p4, 1, 0, 'C') : "") : "";
            ($sp5 == $seguimiento) ? (($p5 > 0 || $p5 == "NA") ? $pdf->Cell(8, 5, $p5, 1, 0, 'C') : "") : "";
            ($sp6 == $seguimiento) ? (($p6 > 0 || $p6 == "NA") ? $pdf->Cell(8, 5, $p6, 1, 0, 'C') : "") : "";
            ($sp7 == $seguimiento) ? (($p7 > 0 || $p7 == "NA") ? $pdf->Cell(8, 5, $p7, 1, 0, 'C') : "") : "";
            ($sp8 == $seguimiento) ? (($p8 > 0 || $p8 == "NA") ? $pdf->Cell(8, 5, $p8, 1, 0, 'C') : "") : "";
            ($sp9 == $seguimiento) ? (($p9 > 0 || $p9 == "NA") ? $pdf->Cell(8, 5, $p9, 1, 0, 'C') : "") : "";
            $pdf->Ln();

            if($numero == 32 || $numero == 64 || $numero == 96)
            {
                $pdf->AddPage('P', 'Letter');

                $this->generarEncabezadoCalificaciones($pdf, 
                                                      array("periodo" => $periodo,
                                                            "carrera" => $carrera,
                                                            "plan" => $plan,
                                                            "profesor" => $profesor,
                                                            "materia" => $materia,
                                                            "grupo" => $grupo,
                                                            "fecha" => $fecha,
                                                            "seguimiento" => $seguimiento),
                                                      "Vertical1"
                                                    );
                $pdf->SetXY($x, $y_encabezado);
                $this->generarEncabezadoTablaCalificaciones($pdf, $x_encabezado, $y_encabezado, $cuerpo, $seguimiento);
                $pdf->SetFont('Montserrat-regular', '', 8);
                $pdf->Ln();
            }
            $numero = $numero + 1;
        }

        $pdf->Output('D', utf8_decode($carrera."_".$materia."_".$grupo)."_".$periodo.'.pdf');
    }
    #endregion

    #region public function actionListaalumnoscalificacionprofesor($idprofesor, $idciclo)
    public function actionListaalumnoscalificacionprofesor($idprofesor, $idciclo)
    {
        $idciclo = Html::encode($idciclo);
        $idprofesor = Html::encode($idprofesor);

        $profesor_grupos = (new \yii\db\Query())
                            ->from(["grupos"])
                            ->select([
                                "grupos.idgrupo",
	                            "grupos.idciclo",
                                "cat_materias.desc_materia"
                            ])
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos.idprofesor" => $idprofesor, "grupos.idciclo" => $idciclo])
                            ->all();

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setHeader('Alumnos Calificacion');
        $pdf->setFooter('Alumnos Calificacion');
        $pdf->AliasNbPages();

        foreach ($profesor_grupos as $registros)
        {
            $idgrupo = $registros["idgrupo"];

            $encabezado = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                "ciclo.desc_ciclo",
                                "cat_carreras.desc_carrera",
                                "cat_carreras.plan_estudios",
                                "grupos.desc_grupo",
                                "grupos.desc_grupo_corto",
                                "cat_materias.desc_materia",
                                "CONCAT(profesores.apaterno, ' ', profesores.amaterno, ' ', profesores.nombre_profesor) AS profesor"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["ciclo"], "ciclo.idciclo = grupos.idciclo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->innerJoin(["profesores"], "grupos.idprofesor = profesores.idprofesor")
                            ->where(["grupos.idgrupo" => $idgrupo, "ciclo.idciclo" => $idciclo])
                            ->all();

            $cuerpo = (new \yii\db\Query())
                            ->from(["estudiantes"])
                            ->select([
                                "estudiantes.idestudiante",
    	                        "estudiantes.nombre_estudiante",
                                "cat_materias.desc_materia",
                                "grupos_estudiantes.p1", "grupos_estudiantes.p2", "grupos_estudiantes.p3",
                                "grupos_estudiantes.p4", "grupos_estudiantes.p5", "grupos_estudiantes.p6",
                                "grupos_estudiantes.p7", "grupos_estudiantes.p8", "grupos_estudiantes.p9",
                                "grupos_estudiantes.s1", "grupos_estudiantes.s2", "grupos_estudiantes.s3",
                                "grupos_estudiantes.s4", "grupos_estudiantes.s5", "grupos_estudiantes.s6",
                                "grupos_estudiantes.s7", "grupos_estudiantes.s8", "grupos_estudiantes.s9",
                                "grupos_estudiantes.sp1", "grupos_estudiantes.sp2", "grupos_estudiantes.sp3",
                                "grupos_estudiantes.sp4", "grupos_estudiantes.sp5", "grupos_estudiantes.sp6",
                                "grupos_estudiantes.sp7", "grupos_estudiantes.sp8", "grupos_estudiantes.sp9"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["grupos_estudiantes"], "estudiantes.idestudiante = grupos_estudiantes.idestudiante")
                            ->innerJoin(["grupos"], "grupos_estudiantes.idgrupo = grupos.idgrupo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos_estudiantes.idgrupo" => $idgrupo, "grupos.idciclo" => $idciclo])
                            ->all();

            $periodo = utf8_decode($encabezado[0]['desc_ciclo']);
            $fecha = date('Y-m-d');
            $carrera = $encabezado[0]['desc_carrera'];
            $plan = $encabezado[0]['plan_estudios'];
            $materia = $registros["desc_materia"];
            $grupo = $encabezado[0]['desc_grupo'];
            $profesor = utf8_decode($encabezado[0]['profesor']);

            $pdf->AddPage('P', 'Letter');
            $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
            $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
            $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

            $this->generarEncabezadoCalificaciones($pdf, 
                                                    array("periodo" => $periodo,
                                                          "carrera" => $carrera,
                                                          "plan" => $plan,
                                                          "profesor" => $profesor,
                                                          "materia" => $materia,
                                                          "grupo" => $grupo,
                                                          "fecha" => $fecha,
                                                          "seguimiento" => ""),
                                                    "Vertical1"
                                                  );

            $x_encabezado = 5;
            $y_encabezado = 77;

            $x = $this->generarEncabezadoTablaCalificaciones($pdf, $x_encabezado, $y_encabezado, $cuerpo);

            $pdf->Ln();

            $numero = 1;
            $pdf->SetFont('Montserrat-regular', '', 8);
            foreach ($cuerpo as $row)
            {
                $s1 = $row['s1'];
                $s2 = $row['s2'];
                $s3 = $row['s3'];
                $s4 = $row['s4'];
                $s5 = $row['s5'];
                $s6 = $row['s6'];
                $s7 = $row['s7'];
                $s8 = $row['s8'];
                $s9 = $row['s9'];

                $p1 = ($row['p1'] == "NA") ? (($s1 == "") ? $row['p1'] : $s1) : $row['p1'];
                $p2 = ($row['p2'] == "NA") ? (($s2 == "") ? $row['p2'] : $s2) : $row['p2'];
                $p3 = ($row['p3'] == "NA") ? (($s3 == "") ? $row['p3'] : $s3) : $row['p3'];
                $p4 = ($row['p4'] == "NA") ? (($s4 == "") ? $row['p4'] : $s4) : $row['p4'];
                $p5 = ($row['p5'] == "NA") ? (($s5 == "") ? $row['p5'] : $s5) : $row['p5'];
                $p6 = ($row['p6'] == "NA") ? (($s6 == "") ? $row['p6'] : $s6) : $row['p6'];
                $p7 = ($row['p7'] == "NA") ? (($s7 == "") ? $row['p7'] : $s7) : $row['p7'];
                $p8 = ($row['p8'] == "NA") ? (($s8 == "") ? $row['p8'] : $s8) : $row['p8'];
                $p9 = ($row['p9'] == "NA") ? (($s9 == "") ? $row['p9'] : $s9) : $row['p9'];

                $pdf->SetX($x);
                $pdf->Cell(8, 5, $numero, 1, 0, 'C');
                $pdf->Cell(25, 5, $row['idestudiante'], 1, 0, 'C');
                $pdf->Cell(75, 5, utf8_decode($row['nombre_estudiante']), 1, 0, 'L');
                ($p1 > 0 || $p1 == "NA") ? $pdf->Cell(8, 5, $p1, 1, 0, 'C') : "";
                ($p2 > 0 || $p2 == "NA") ? $pdf->Cell(8, 5, $p2, 1, 0, 'C') : "";
                ($p3 > 0 || $p3 == "NA") ? $pdf->Cell(8, 5, $p3, 1, 0, 'C') : "";
                ($p4 > 0 || $p4 == "NA") ? $pdf->Cell(8, 5, $p4, 1, 0, 'C') : "";
                ($p5 > 0 || $p5 == "NA") ? $pdf->Cell(8, 5, $p5, 1, 0, 'C') : "";
                ($p6 > 0 || $p6 == "NA") ? $pdf->Cell(8, 5, $p6, 1, 0, 'C') : "";
                ($p7 > 0 || $p7 == "NA") ? $pdf->Cell(8, 5, $p7, 1, 0, 'C') : "";
                ($p8 > 0 || $p8 == "NA") ? $pdf->Cell(8, 5, $p8, 1, 0, 'C') : "";
                ($p9 > 0 || $p9 == "NA") ? $pdf->Cell(8, 5, $p9, 1, 0, 'C') : "";
                $pdf->Ln();

                if($numero == 32 || $numero == 64 || $numero == 96)
                {
                    $pdf->AddPage('P', 'Letter');
                    $this->generarEncabezadoCalificaciones($pdf, 
                                                           array("periodo" => $periodo,
                                                                 "carrera" => $carrera,
                                                                 "plan" => $plan,
                                                                 "profesor" => $profesor,
                                                                 "materia" => $materia,
                                                                 "grupo" => $grupo,
                                                                 "fecha" => $fecha,
                                                                 "seguimiento" => ""),
                                                           "Vertical1"
                                                         );
                    $pdf->SetXY($x, $y_encabezado);
                    $this->generarEncabezadoTablaCalificaciones($pdf, $x_encabezado, $y_encabezado, $cuerpo);
                    $pdf->SetFont('Montserrat-regular', '', 8);
                    $pdf->Ln();
                }
                $numero = $numero + 1;
            }
        }
        $pdf->Output('D', "Calificaciones ".utf8_decode($periodo).'.pdf');
    }
    #endregion

    #region public function actionActacalificaciones($idgrupo)
    public function actionActacalificaciones($idgrupo)
    {
        $idgrupo = Html::encode($idgrupo);

        $materia = (new \yii\db\Query())
                            ->from(["grupos"])
                            ->select(["cat_materias.desc_materia"])
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->where(["grupos.idgrupo" => $idgrupo])
                            ->one();

        $encabezado = (new \yii\db\Query())
                            ->from(["cat_carreras"])
                            ->select([
                                "ciclo.desc_ciclo",
                            	"cat_carreras.desc_carrera",
	                            "cat_carreras.plan_estudios",
	                            "grupos.desc_grupo",
	                            "grupos.desc_grupo_corto",
	                            "cat_materias.desc_materia",
                                "cat_materias.creditos",
                                "CONCAT(profesores.apaterno, ' ', profesores.amaterno, ' ', profesores.nombre_profesor) AS profesor",
                                "(SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo) AS total_estudiantes"
                            ])
                            ->innerJoin(["grupos"], "cat_carreras.idcarrera = grupos.idcarrera")
                            ->innerJoin(["ciclo"], "ciclo.idciclo = grupos.idciclo")
                            ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                            ->innerJoin(["profesores"], "grupos.idprofesor = profesores.idprofesor")
                            ->where(["grupos.idgrupo" => $idgrupo])
                            ->all();

        $cuerpo = (new \yii\db\Query())
                            ->from(["actas_calificaciones"])
                            ->select([
                                "estudiantes.sexo",
                                "actas_calificaciones.idestudiante",
                                "estudiantes.nombre_estudiante",
                                "actas_calificaciones.pri_opt", 
                                "actas_calificaciones.seg_opt",
                                "(CASE
                                    WHEN actas_calificaciones.idopcion_curso = 2 THEN
                                    'REP'
                                    WHEN actas_calificaciones.idopcion_curso = 3 THEN
                                    'ESP'
                                    WHEN actas_calificaciones.idopcion_curso = 4 THEN
                                    'DUAL'
                                    WHEN actas_calificaciones.idopcion_curso = 5 THEN
                                    'AUT' ELSE 'ORD'
                                END) AS opc_curso",
                                "(SELECT lunes FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS lunes",
                                "(SELECT martes FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS martes",
                                "(SELECT miercoles FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS miercoles",
                                "(SELECT jueves FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS jueves",
                                "(SELECT viernes FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS viernes",
                                "(SELECT sabado FROM grupos WHERE idgrupo = actas_calificaciones.idgrupo) AS sabado"
                            ])
                            ->orderBy(["estudiantes.nombre_estudiante" => SORT_ASC])
                            ->innerJoin(["estudiantes"], "estudiantes.idestudiante = actas_calificaciones.idestudiante")
                            ->where(["actas_calificaciones.idgrupo" => $idgrupo])
                            ->all();

        $periodo = utf8_decode($encabezado[0]['desc_ciclo']);
        $fecha = date('Y-m-d');
        $carrera = $encabezado[0]['desc_carrera'];
        $plan_estudios = $encabezado[0]['plan_estudios'];
        $materia = $materia['desc_materia'];
        $grupo = $encabezado[0]['desc_grupo'];
        $profesor = utf8_decode($encabezado[0]['profesor']);
        $creditos = $encabezado[0]['creditos'];
        $total_estudiantes = $encabezado[0]['total_estudiantes'];

        $lunes = (count($cuerpo) > 0) ? $cuerpo[0]['lunes'] : "";
        $martes = (count($cuerpo) > 0) ? $cuerpo[0]['martes'] : "";
        $miercoles = (count($cuerpo) > 0) ? $cuerpo[0]['miercoles'] : "";
        $jueves = (count($cuerpo) > 0) ? $cuerpo[0]['jueves'] : "";
        $viernes = (count($cuerpo) > 0) ? $cuerpo[0]['viernes'] : "";
        $sabado = (count($cuerpo) > 0) ? $cuerpo[0]['sabado'] : "";

        if($sabado != ""){
            $horario = "SABADO ".$sabado;
        }else{
            if($viernes != ""){
                $horario = "LUNES - VIERNES ".$lunes;
            }else{
                if($jueves != ""){
                    $horario = "LUNES - JUEVES ".$lunes;
                }else{
                    if($miercoles != ""){
                        $horario = "LUNES - MIERCOLES ".$lunes;
                    }else{
                        if($martes != ""){
                            $horario = "LUNES - MARTES ".$lunes;
                        }else{
                            if($lunes != ""){
                                $horario = "LUNES".$lunes;
                            }else{
                                $horario = "";
                            }
                        }
                    }
                }
            }
        }

        header('Content-type: application/pdf');
        $pdf = new PDF();
        $pdf->setHeader('Acta Calificaciones');
        $pdf->setFooter('Acta Calificaciones');
        $pdf->AliasNbPages();
        $pdf->AddPage('P', 'Letter');
        $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
        $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
        $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
        $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

        $this->generarEncabezadoCalificaciones($pdf, array("periodo" => $periodo,
                                                           "carrera" => $carrera,
                                                           "plan_estudios" => $plan_estudios,
                                                           "profesor" => $profesor,
                                                           "materia" => $materia,
                                                           "grupo" => $grupo,
                                                           "fecha" => $fecha,
                                                           "creditos" => $creditos,
                                                           "total_estudiantes" => $total_estudiantes,
                                                           "horario" => $horario,
                                                           "seguimiento" => ""),
                                                           "Vertical"
                                               );

        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->SetXY(5, 63);
        $pdf->Cell(8, 8, 'NO.', 1, 0, 'C');
        $pdf->Cell(13, 8, utf8_decode('GÉNERO'), 1, 0, 'C');
        $pdf->Cell(22, 8, 'NO. CONTROL', 1, 0, 'C');
        $pdf->Cell(90, 8, 'NOMBRE DEL ESTUDIANTE', 1, 0, 'C');

        $pdf->SetFont('Montserrat-regular', '', 7);
        $pdf->Cell(8, 8, 'Dual', 1, 0, 'C');
        $pdf->Cell(8, 8, 'Aut.', 1, 0, 'C');
        $pdf->Cell(8, 8, 'Ord.', 1, 0, 'C');
        $pdf->Cell(8, 8, 'Rep.', 1, 0, 'C');
        $pdf->Cell(8, 8, 'Esp.', 1, 0, 'C');

        $pdf->SetFont('Montserrat-Bold', '', 7);
        $pdf->Cell(30, 4, utf8_decode('CALIFICACIÓN'), 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetX(178);
        $pdf->Cell(15, 4, utf8_decode('PO'), 1, 0, 'C');
        $pdf->Cell(15, 4, utf8_decode('SO'), 1, 0, 'C');
        $pdf->Ln();

        $numero = 1;
        $pdf->SetFont('Montserrat-regular', '', 8);

        $porcentaje_aprobados = 0;
        $porcentaje_reprobados = 0;
        $total_reprobados = 0;
        $total_aprobados = 0;
        $total_alumnos = count($cuerpo);
        foreach ($cuerpo as $row)
        {
            $genero = $row['sexo'];
            $idestudiante = $row['idestudiante'];
            $estudiante = $row['nombre_estudiante'];
            $opc_curso = $row['opc_curso'];
            $pri_opt = $row['pri_opt'];
            $seg_opt = $row['seg_opt'];

            $dual = ($opc_curso == "DUAL") ? "X" : "";
            $aut = ($opc_curso == "AUT") ? "X" : "";
            $ord = ($opc_curso == "ORD") ? "X" : "";
            $rep = ($opc_curso == "REP") ? "X" : "";
            $esp = ($opc_curso == "ESP") ? "X" : "";

            $calificacion = ($pri_opt != "") ? $pri_opt : $seg_opt;

            $reprobados = ($calificacion == "NA") ? 1 : 0;
            $total_reprobados = $total_reprobados + $reprobados;

            $aprobados = ($calificacion != "NA") ? 1 : 0;
            $total_aprobados = $total_aprobados + $aprobados;

            $pdf->SetX(5);
            $pdf->Cell(8, 4, $numero, 1, 0, 'C');
            $pdf->Cell(13, 4, $genero, 1, 0, 'C');
            $pdf->Cell(22, 4, $idestudiante, 1, 0, 'C');
            $pdf->Cell(90, 4, utf8_decode($estudiante), 1, 0, 'L');
            $pdf->Cell(8, 4, $dual, 1, 0, 'C');
            $pdf->Cell(8, 4, $aut, 1, 0, 'C');
            $pdf->Cell(8, 4, $ord, 1, 0, 'C');
            $pdf->Cell(8, 4, $rep, 1, 0, 'C');
            $pdf->Cell(8, 4, $esp, 1, 0, 'C');
            $pdf->Cell(15, 4, $pri_opt, 1, 0, 'C');
            $pdf->Cell(15, 4, $seg_opt, 1, 0, 'C');
            $pdf->Ln();

            $numero = $numero + 1;
        }
        $porcentaje_aprobados = ($total_aprobados > 0) ? round(($total_aprobados * 100) / $total_alumnos, 0) : 0;
        $porcentaje_reprobados = ($total_reprobados > 0) ? round(($total_reprobados * 100) / $total_alumnos, 0) : 0;

        $pdf->SetX(5);
        $pdf->Cell(173, 4, utf8_decode("% APROBACIÓN"), 0, 0, 'R');
        $pdf->Cell(15, 4, "%", 1, 0, 'C');
        $pdf->Cell(15, 4, $porcentaje_aprobados, 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(173, 4, utf8_decode("% REPROBACIÓN"), 0, 0, 'R');
        $pdf->Cell(15, 4, "%", 1, 0, 'C');
        $pdf->Cell(15, 4, $porcentaje_reprobados, 1, 0, 'C');

        $pdf->SetFont('Montserrat-regular', '', 9);
        $pdf->Ln(5);
        $pdf->SetX(5);
        $pdf->Cell(174, 4, utf8_decode("Este documento no es válido si tiene tachaduras o enmendaduras"), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetX(5);
        $pdf->Cell(174, 4, utf8_decode("PO = 1ra. Oportunidad  SO = 2da oportunidad"), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetX(5);
        $pdf->Cell(174, 4, utf8_decode("Aut.(curso global o autodidacta) Rep. (curso de repeticion) Esp.(curso especial)"), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetX(5);
        $pdf->Cell(174, 4, utf8_decode("Carretera del Golfo Malpaso – El Bellote, Km. 98.1, R/A Libertad, Huimanguillo, Tabasco, México. A 14 de julio de 2021"), 0, 0, 'L');

        $pdf->Ln(15);
        $pdf->SetX(60);
        $pdf->Cell(85, 4, utf8_decode("FIRMA DEL PROFESOR: _______________________________"), 0, 0, 'L');

        $pdf->Output('D', utf8_decode($carrera."_".$materia."_".$grupo)."_".$periodo.'.pdf');
    }
    #endregion

    #region private function generarEncabezadoTablaCalificaciones($pdf, $x, $y, $parciales, $seguimiento = "")
    private function generarEncabezadoTablaCalificaciones($pdf, $x, $y, $parciales, $seguimiento = "")
    {
        $x_encabezado = $x;
        $aumentar = 148;
        $disminuir = $x;
        $aumentar_encabezado = $x;

        for($i = 1; $i <= 9; $i++)
        {
            $parcial = $parciales[0]['p'.$i];
            $sp = $parciales[0]['sp'.$i];

            if($seguimiento == "")
            {
                if ($parcial > 0 || $parcial == "NA")
                {
                    $x_encabezado = $x_encabezado + 5;
                    if($i > 1)
                    {
                        $aumentar = $aumentar - 10;
                        $disminuir = $disminuir - 5;
                    }
                }
            }
            else
            {
                if ($sp == $seguimiento)
                {
                    if ($parcial > 0 || $parcial == "NA")
                    {
                        $x_encabezado = $x_encabezado + 5;
                        if ($i > 1)
                        {
                            $aumentar = $aumentar - 10;
                            $disminuir = $disminuir - 5;
                        }
                    }
                }
            }
        }
        
        $adicional = ($seguimiento > 1) ? 5 : 0;

        $pdf->SetXY($x_encabezado + $aumentar + $adicional, $y);

        for($j = 1; $j <= 9; $j++)
        {
            $parcial = $parciales[0]['p'.$j];
            $sp = $parciales[0]['sp'.$j];

            if($seguimiento == "")
            {
                if ($parcial > 0 || $parcial == "NA")
                {
                    $pdf->Cell(8, 5, 'T'.$j, 1, 0, 'C');
                }
            }
            else
            {
                if ($sp == $seguimiento)
                {
                    if ($parcial > 0 || $parcial == "NA")
                    {
                        $pdf->Cell(8, 5, 'T'.$j, 1, 0, 'C');
                    }
                }
            }
        }

        $pdf->SetFont('Montserrat-Bold', '', 8);
        $pdf->SetXY((45 + $disminuir), $y);
        $pdf->Cell(8, 5, 'NO.', 1, 0, 'C');
        $pdf->Cell(25, 5, 'NO. CONTROL', 1, 0, 'C');
        $pdf->Cell(75, 5, 'ESTUDIANTE', 1, 0, 'C');

        return 45 + $disminuir;
    }
    #endregion

    #region private function generarEncabezadoCalificaciones($pdf, $datos = array(), $orientacion_hoja = "")
    private function generarEncabezadoCalificaciones($pdf, $datos = array(), $orientacion_hoja = "")
    {
        $pdf->SetFont('Montserrat-SemiBold', '', 7);
        $pdf->SettextColor(0, 0, 0);

        if($orientacion_hoja == "Horizontal")
        {
            $pdf->Text(12, 60, utf8_decode('PERIODO:'));
            $pdf->Text(30, 60, utf8_decode($datos['periodo']));
            $pdf->Text(12, 65, utf8_decode('CARRERA:'));
            $pdf->Text(30, 65, utf8_decode($datos['carrera']));
            $pdf->Text(12, 70, utf8_decode('PLAN:'));
            $pdf->Text(30, 70, utf8_decode($datos['plan']));
            $pdf->Text(70, 60, 'PROFESOR:');
            $pdf->Text(135, 60, $datos['profesor']);
            $pdf->Text(70, 65, utf8_decode('MATERIA:'));
            $pdf->Text(135, 65, utf8_decode($datos['materia']));
            $pdf->Text(705, 70, utf8_decode('GRUPO:'));
            $pdf->Text(135, 70, utf8_decode($datos['grupo']));
            $pdf->Text(219, 60, 'FECHA:');
            $pdf->Text(243, 60, $datos['fecha']);

            if($datos['seguimiento'] != "")
            {
                $pdf->Text(219, 65, 'SEGUIMIENTO:');
                $pdf->Text(243, 65, $datos['seguimiento']);
            }
        }
        else if($orientacion_hoja == "Vertical")
        {
            $pdf->Text(12, 45, utf8_decode('CARRERA:'));
            $pdf->Text(37, 45, utf8_decode($datos['carrera']));
            $pdf->Text(12, 49, utf8_decode('MATERIA:'));
            $pdf->Text(37, 49, utf8_decode($datos['materia']));
            $pdf->Text(12, 53, utf8_decode('HORARIO:'));
            $pdf->Text(37, 53, $datos['horario']);
            $pdf->Text(12, 57, utf8_decode('CATEDRÁTICO:'));
            $pdf->Text(37, 57, strtoupper($datos['profesor']));

            $pdf->Text(150, 45, utf8_decode('PERIODO:'));
            $pdf->Text(175, 45, utf8_decode($datos['periodo']));
            $pdf->Text(150, 49, 'FECHA:');
            $pdf->Text(175, 49, $datos['fecha']);
            $pdf->Text(150, 53, 'ESTUDIANTES:');
            $pdf->Text(175, 53, $datos['total_estudiantes']);
            $pdf->Text(150, 57, 'PAQUETE:');
            $pdf->Text(175, 57, utf8_decode($datos['plan_estudios']));
            $pdf->Text(150, 61, utf8_decode('CRÉDITOS:'));
            $pdf->Text(175, 61, $datos['creditos']);
        }
        else if($orientacion_hoja == "Vertical1")
        {
            $pdf->Text(5, 60, utf8_decode('PERIODO:'));
            $pdf->Text(20, 60, utf8_decode($datos['periodo']));
            $pdf->Text(5, 65, utf8_decode('CARRERA:'));
            $pdf->Text(20, 65, utf8_decode($datos['carrera']));
            $pdf->Text(5, 70, utf8_decode('PLAN:'));
            $pdf->Text(20, 70, utf8_decode($datos['plan']));

            $x = ($datos['carrera'] == 'ING. EN INNOVACION AGRICOLA SUSTENTABLE') ? 85 : 85;
            $x1 = $x + 16;

            $pdf->Text($x, 60, 'PROFESOR:');
            $pdf->Text($x1, 60, $datos['profesor']);
            $pdf->Text($x, 65, utf8_decode('MATERIA:'));
            $pdf->Text($x1, 65, utf8_decode($datos['materia']));
            $pdf->Text($x, 70, utf8_decode('GRUPO:'));
            $pdf->Text($x1, 70, utf8_decode($datos['grupo']));

            $pdf->Text($x + 100, 60, 'FECHA:');
            $pdf->Text($x + 111, 60, $datos['fecha']);

            if($datos['seguimiento'] != "")
            {
                $pdf->Text($x + 100, 65, 'SEG:');
                $pdf->Text($x + 111, 65, $datos['seguimiento']);
            }
        }
    }
    #endregion

    #region public function actionReportefinalprofesor($idprofesor, $idciclo)
    public function actionReportefinalprofesor($idprofesor, $idciclo)
    {
        $idprofesor = Html::encode($idprofesor);
        $idciclo = Html::encode($idciclo);

        $total_profesor = Profesor::find()->where(["idprofesor" => $idprofesor])->count();
        $total_ciclo = Ciclo::find()->where(["idciclo" => $idciclo])->count();

        if($total_profesor == 1 && $total_ciclo == 1)
        {
            $profesor = Profesor::find()->where(["idprofesor" => $idprofesor])->one();
            $profesor = utf8_decode($profesor->apaterno." ".$profesor->amaterno." ".$profesor->nombre_profesor);

            $ciclo = Ciclo::find()->where(["idciclo" => $idciclo])->one();
            $ciclo = $ciclo->desc_ciclo;

            $periodo = explode("-", $ciclo);
            $periodo1 = $periodo[0];
            $periodo2 = $periodo[1];

            $grupos_atendidos = Grupo::find()->where(["idprofesor" => $idprofesor, "idciclo" => $idciclo])->groupBy("desc_grupo")->count();
            $materias_impartidas = Grupo::find()->where(["idprofesor" => $idprofesor, "idciclo" => $idciclo])->count();

            $cuerpo = (new \yii\db\Query())->from(["grupos"])
                                        ->select(["cat_materias.desc_materia",
                                                "cat_carreras.cve_carrera",
                                                "(SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo) AS total_estudiantes",
                                                "(SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE pri_opt <> 'NA' AND pri_opt <> '' AND idgrupo = grupos.idgrupo) AS po",
                                                "ROUND(((SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE pri_opt <> 'NA' AND pri_opt <> '' AND idgrupo = grupos.idgrupo) / (SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo)) * 100)  AS po_porcentaje",
                                                "(SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE seg_opt <> 'NA' AND seg_opt <> '' AND idgrupo = grupos.idgrupo) AS so",
	                                            "ROUND(((SELECT COUNT(idacta_cal) FROM actas_calificaciones WHERE seg_opt <> 'NA' AND seg_opt <> '' AND idgrupo = grupos.idgrupo) / (SELECT COUNT(idestudiante) FROM grupos_estudiantes WHERE idgrupo = grupos.idgrupo)) * 100)  AS so_porcentaje",
                                                "(SELECT
                                                    COUNT(estudiantes.idestudiante) 
                                                  FROM
                                                    estudiantes
                                                  INNER JOIN grupos_estudiantes ON estudiantes.idestudiante = grupos_estudiantes.idestudiante
                                                  WHERE
                                                    grupos_estudiantes.idgrupo = grupos.idgrupo
                                                  AND
                                                    estudiantes.cve_estatus = 'DES'
                                                ) AS bajas"
                                        ])
                                        ->innerJoin(["cat_materias"], "grupos.idmateria = cat_materias.idmateria")
                                        ->innerJoin(["cat_carreras"], "grupos.idcarrera = cat_carreras.idcarrera")
                                        ->where(["grupos.idprofesor" => $idprofesor, "grupos.idciclo" => $idciclo])
                                        ->orderBy(["cat_carreras.desc_carrera" => SORT_ASC, "cat_materias.desc_materia" => SORT_ASC])
                                        ->all();

            header('Content-type: application/pdf');
            $pdf = new PDF();
            $pdf->setHeader('Reporte Final Profesor');
            $pdf->setFooter('Reporte Final Profesor');
            $pdf->setProfesor($profesor);
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'Letter');
            $pdf->AddFont('Montserrat-SemiBold', '', 'Montserrat-SemiBold.php');
            $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $pdf->AddFont('Montserrat-MediumItalic', '', 'Montserrat-MediumItalic.php');
            $pdf->AddFont('Montserrat-LightItalic', '', 'Montserrat-LightItalic.php');
            $pdf->AddFont('Montserrat-Bold', '', 'Montserrat-Bold.php');
            $pdf->AddFont('Montserrat-Regular', '', 'Montserrat-Regular.php');

            $pdf->SetFont('Montserrat-Bold', '', 10);
            $pdf->SettextColor(0, 0, 0);
            $pdf->Text(70, 42, utf8_decode('INSTITUTO TECNOLÓGICO DE HUIMANGUILLO'));
            $pdf->Text(85, 48, utf8_decode('SUBDIRECCIÓN ACADÉMICA'));

            $y = 60;
            $pdf->SetFont('Montserrat-Regular', '', 10);
            $pdf->Text(10, $y, utf8_decode('DEPARTAMENTO DE: _______________________________________________________'));
            $pdf->Text(10, $y + 6, utf8_decode('REPORTE FINAL DEL SEMESTRE: ___________________________'));
            $pdf->Text(10, $y + 12, utf8_decode('PERIODO: _____________ AL _____________'));
            $pdf->Text(10, $y + 18, utf8_decode('PROFESOR(A): ______________________________________________________________'));
            $pdf->Text(10, $y + 24, utf8_decode('No. DE GRUPOS ATENDIDOS: _____________ No. DE ASIGNATURAS DIFERENTES _____________'));

            $pdf->SetFont('Montserrat-SemiBold', '', 10);
            $pdf->Text(55, $y - 1, utf8_decode("INGENIERÍAS"));
            $pdf->Text(75, $y + 5, $ciclo);
            $pdf->Text(34, $y + 11, $periodo1);
            $pdf->Text(62, $y + 11, $periodo2);
            $pdf->Text(40, $y + 17, $profesor);
            $pdf->Text(73, $y + 23, $grupos_atendidos);
            $pdf->Text(160, $y + 23, $materias_impartidas);

            $pdf->Ln();

            $pdf->SetFont('Montserrat-Bold', '', 8);
            $pdf->SetXY(5, $y + 30);
            $pdf->Cell(102, 10, 'ASIGNATURA', 1, 0, 'C');
            $pdf->Cell(30, 10, 'CARRERA', 1, 0, 'C');
            $pdf->Cell(9, 10, 'A', 1, 0, 'C');
            $pdf->Cell(18, 5, 'B', 1, 0, 'C');
            $pdf->Cell(9, 10, 'C', 1, 0, 'C');
            $pdf->Cell(9, 10, 'D', 1, 0, 'C');
            $pdf->Cell(9, 10, 'E', 1, 0, 'C');
            $pdf->Cell(9, 10, 'F', 1, 0, 'C');
            $pdf->Cell(9, 10, 'G', 1, 0, 'C');
            $pdf->SetXY(146, $y + 35);
            $pdf->Cell(9, 5, 'PO', 1, 0, 'C');
            $pdf->Cell(9, 5, 'SO', 1, 0, 'C');
            $pdf->Ln();

            $total_estudiantes_acumulado = 0;
            $total_primera_oportunidad_acreditados_acumulado = 0;
            $total_segunda_oportunidad_acreditados_acumulado = 0;
            $total_porcentaje_acreditados_acumulado = 0;
            $total_porcentaje_no_acreditados_acumulado = 0;
            $total_estudiantes_no_acreditados_acumulado = 0;
            $total_estudiantes_desertores_acumulado = 0;
            $total_porcentaje_estudiantes_desertores_acumulado = 0;

            foreach($cuerpo as $row)
            {
                $carrera = $row["cve_carrera"];
                $materia = $row["desc_materia"];
                $total_estudiantes = $row["total_estudiantes"];
                $primera_oportunidad_acreditados = $row["po"];
                $segunda_oportunidad_acreditados = $row["so"];
                $primera_oportunidad_porcentaje_acreditados = $row["po_porcentaje"];
                $segunda_oportunidad_porcentaje_acreditados = $row["so_porcentaje"];
                $desertores = $row["bajas"];

                //Devuelve el número de estudiantes que no acreditaron la materia
                $no_acreditados = $total_estudiantes - ($primera_oportunidad_acreditados + $segunda_oportunidad_acreditados);
                //Devuelve el porcentaje de estudiantes que no acreditaron la materia
                $porcentaje_no_acreditados = 100 - ($primera_oportunidad_porcentaje_acreditados + $segunda_oportunidad_porcentaje_acreditados);
                //Devuelve el porcentaje de desertores de estudiantes por materia
                $porcentaje_desertores = ($row["total_estudiantes"] > 0) ? round(($desertores / $total_estudiantes) * 100) : 0;

                //Acumula la suma total de estudiantes
                $total_estudiantes_acumulado = $total_estudiantes_acumulado + $total_estudiantes;
                //Acumula la suma total de estudiantes que acreditaron la materia en la primera oportunidad
                $total_primera_oportunidad_acreditados_acumulado = $total_primera_oportunidad_acreditados_acumulado + $primera_oportunidad_acreditados;
                //Acumula la suma total de estudiantes que acreditaron la materia en la segunda oportunidad
                $total_segunda_oportunidad_acreditados_acumulado = $total_segunda_oportunidad_acreditados_acumulado + $segunda_oportunidad_acreditados;
                //Acumula el porcentaje total de estudiantes que acreditaron la materia
                $total_porcentaje_acreditados_acumulado = $total_porcentaje_acreditados_acumulado + ($primera_oportunidad_porcentaje_acreditados + $segunda_oportunidad_porcentaje_acreditados);
                //Acumula la suma total de estudiantes que no acreditaron la materia
                $total_estudiantes_no_acreditados_acumulado = $total_estudiantes_no_acreditados_acumulado + $no_acreditados;
                //Acumula el porcentaje total de estudiantes que no acreditaron la materia
                $total_porcentaje_no_acreditados_acumulado = $total_porcentaje_no_acreditados_acumulado + $porcentaje_no_acreditados;
                //Acumula la suma total de estudiantes desertores por materia
                $total_estudiantes_desertores_acumulado = $total_estudiantes_desertores_acumulado + $desertores;
                //Acumula la suma total de estudiantes desertores por materia
                $total_porcentaje_estudiantes_desertores_acumulado = $total_porcentaje_estudiantes_desertores_acumulado + $porcentaje_desertores;

                $pdf->SetX(5);
                $pdf->SetFont('Montserrat-Regular', '', 8);
                $pdf->Cell(102, 7, utf8_decode($materia), 1, 0, 'L');
                $pdf->Cell(30, 7, utf8_decode($carrera), 1, 0, 'C');
                $pdf->Cell(9, 7, $total_estudiantes, 1, 0, 'C');
                $pdf->Cell(9, 7, ($primera_oportunidad_acreditados > 0) ? $primera_oportunidad_acreditados : "---", 1, 0, 'C');
                $pdf->Cell(9, 7, ($segunda_oportunidad_acreditados > 0) ? $segunda_oportunidad_acreditados : "---", 1, 0, 'C');
                $pdf->Cell(9, 7, ($primera_oportunidad_porcentaje_acreditados + $segunda_oportunidad_porcentaje_acreditados)."%", 1, 0, 'C');
                $pdf->Cell(9, 7, ($no_acreditados > 0) ? $no_acreditados : "---", 1, 0, 'C');
                $pdf->Cell(9, 7, ($row["total_estudiantes"] > 0) ? (($porcentaje_no_acreditados > 0) ? $porcentaje_no_acreditados."%" : "---") : "---", 1, 0, 'C');
                $pdf->Cell(9, 7, ($desertores > 0) ? $desertores : "---", 1, 0, 'C');
                $pdf->Cell(9, 7, ($porcentaje_desertores > 0) ? $porcentaje_desertores."%" : "---", 1, 0, 'C');

                $pdf->Ln();
            }

            $pdf->setFillColor(221, 221, 221);
            $pdf->SetX(5);
            $pdf->SetFont('Montserrat-Bold', '', 8);
            $pdf->Cell(132, 10, 'TOTALES   ', 1, 0, 'R', 1);
            $pdf->Cell(9, 10, $total_estudiantes_acumulado, 1, 0, 'C', 1);
            $pdf->Cell(9, 10, $total_primera_oportunidad_acreditados_acumulado, 1, 0, 'C', 1);
            $pdf->Cell(9, 10, $total_segunda_oportunidad_acreditados_acumulado, 1, 0, 'C', 1);
            $pdf->Cell(9, 10, round($total_porcentaje_acreditados_acumulado / $materias_impartidas)."%", 1, 0, 'C', 1);
            $pdf->Cell(9, 10, $total_estudiantes_no_acreditados_acumulado, 1, 0, 'C', 1);
            $pdf->Cell(9, 10, round($total_porcentaje_no_acreditados_acumulado / $materias_impartidas)."%", 1, 0, 'C', 1);
            $pdf->Cell(9, 10, $total_estudiantes_desertores_acumulado, 1, 0, 'C', 1);
            $pdf->Cell(9, 10, round($total_porcentaje_estudiantes_desertores_acumulado / $materias_impartidas)."%", 1, 0, 'C', 1);
            $pdf->Ln();

            $pdf->SetFont('Montserrat-Regular', '', 7);
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("A = TOTAL DE ESTUDIANTES POR MATERIA"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("B = No. DE ESTUDIANTES ACREDITADOS (PO=PRIMERA OPORTUNIDAD, SO= SEGUNDA OPORTUNIDAD"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("C = % DE ESTUDIANTES ACREDITADOS"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("D = No. DE ESTUDIANTES NO ACREDITADOS"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("E = % DE ESTUDIANTES NO ACREDITADOS"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("F = No. DE ESTUDIANTES QUE DESERTARON DURANTE EL SEMESTRE EN LA MATERIA"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("G = % DE ESTUDIANTES QUE DESERTARON EN LA MATERIA"), 0, 0, 'L');

            $pdf->Ln();
            $pdf->Ln();
            $pdf->SetX(5);
            $pdf->Cell(200, 4, utf8_decode("NOTAS:"), 0, 0, 'L');
            $pdf->SetFont('Montserrat-Regular', '', 6);
            $pdf->Ln();
            $pdf->SetX(10);
            $pdf->Cell(195, 4, utf8_decode("1. Los estudiantes que se incluirán en la columna D son todos los estudiantes no acreditados incluyendo los desertores."), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(15);
            $pdf->Cell(190, 4, utf8_decode("a. Entendiendo como estudiante desertor al que toma la decisión de no presentar exámenes de regularización o extraordinarios aun teniendo derecho a ellos."), 0, 0, 'L');
            $pdf->Ln();
            $pdf->SetX(10);
            $pdf->Cell(195, 4, utf8_decode("2. Este registro deberá de acompañarse con sus respectivos instrumentos de evaluación y listas de calificaciones que avalen los datos aquí presentados."), 0, 0, 'L');

            $pdf->Output('D', 'Reporte_Final_'.$ciclo.'_'.$profesor.'.pdf');
        }
        else
        {
            throw new \yii\web\HttpException(404,'Oops. Not logged in.');
        }
    }
    #endregion

    /*
    public function actionHorarioprofesor()
    {
        $idprofesor = 25;
        $idciclo = 1;
        $sql_materias = "SELECT
                            *
                         FROM
                            horario_profesor_v
                         WHERE
                            idprofesor =:idprofesor
                         AND
                            idciclo = :idciclo";
        $cuerpo = Yii::$app->db->createCommand($sql_materias)
                               ->bindValue(':idprofesor', $idprofesor)
                               ->bindValue(':idciclo', $idciclo)
                               ->queryAll();
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
        $pdf->Rect(5, 5, 270, 20);
        $pdf->Line(75, 5, 75, 25);
        $pdf->Line(200, 5, 200, 25);
        $pdf->Line(75, 15, 200, 15);
        $pdf->Text(115, 13, "Horario de Trabajo");
        $pdf->SetFont('Montserrat-SemiBold', '', 10);
        $pdf->Text(105, 22, "Referencia a la Norma ISO 9001:2015");
        $pdf->Line(200, 18, 275, 18);
        $pdf->Line(200, 12, 275, 12);
        $pdf->Line(220, 5, 220, 25);
        $pdf->Text(202, 10, utf8_decode("Código:"));
        $pdf->Text(227, 10, utf8_decode("TecNM-AC-PO-003-01"));
        $pdf->Text(202, 16, utf8_decode("Revisión:"));
        $pdf->Text(245, 16, "0");
        $pdf->Text(202, 23, utf8_decode("Página"));
        $pdf->Text(242, 23, utf8_decode("1 de 2"));
        $pdf->Rect(5, 30, 270, 41);
        $pdf->Line(5, 36, 275, 36);//HORIZONTAL
        $pdf->Text(7, 34, utf8_decode("INSTITUTO TECNOLÓGICO DE:"));
        $pdf->Line(75, 30, 75, 36);//VERTICAL
        $pdf->Line(130, 30, 130, 71);//VERTICAL
        $pdf->Text(131, 34, utf8_decode("C.C.T.:"));
        $pdf->Line(147, 30, 147, 71);//VERTICAL
        $pdf->Line(164, 36, 164, 71);//VERTICAL
        $pdf->Line(180, 30, 180, 36);//VERTICAL
        $pdf->Text(181, 34, utf8_decode("PERIODO ESCOLAR"));
        $pdf->Line(225, 30, 225, 36);//VERTICAL
        $pdf->SetFont('Montserrat-SemiBold', '', 7);
        $pdf->Text(6, 39, utf8_decode("NOMBRE COMPLETO:"));
        $pdf->Text(165, 39, utf8_decode("CLAVE COMPLETA DE LA(S) PLAZA(S):"));
        $pdf->Line(5, 41, 164, 41);//HORIZONTAL
        $pdf->Text(6, 44, utf8_decode("ESCOLARIDAD DEL PERSONAL"));
        $pdf->Text(131, 44, utf8_decode("PASANTE"));
        $pdf->Text(148, 44, utf8_decode("TITULADO"));
        $pdf->Line(5, 46, 164, 46);//HORIZONTAL
        $pdf->Text(6, 49, utf8_decode("LICENCIATURA EN:"));
        $pdf->Line(5, 51, 275, 51);//HORIZONTAL
        $pdf->Text(6, 54, utf8_decode("ESPECIALIZACIÓN EN:"));
        $pdf->Text(165, 54, utf8_decode("TIPO DE NOMBRAMIENTO:"));
        $pdf->Text(222, 54, utf8_decode("FECHA DE INGRESO A LA S.E.P.:"));
        $pdf->Line(221, 51, 221, 71);//VERTICAL
        $pdf->Line(5, 56, 164, 56);//HORIZONTAL
        $pdf->Text(6, 59, utf8_decode("MAESTRÍA EN:"));
        $pdf->Line(5, 61, 275, 61);//HORIZONTAL
        $pdf->Text(6, 64, utf8_decode("DOCTORADO EN:"));
        $pdf->Text(165, 64, utf8_decode("NO. DE TARJETA DE CONTROL:"));
        $pdf->Text(222, 64, utf8_decode("FECHA DE INGRESO A LA INSTITUCIÓN:"));
        $pdf->Line(5, 66, 164, 66);//HORIZONTAL
        $pdf->Text(6, 69, utf8_decode("UNIDAD ORGÁNICA DE ADSCRIPCIÓN:"));
        $pdf->SetFont('Montserrat-SemiBold', '', 10);
        $pdf->Text(6, 77, utf8_decode("I.- CARGA ACADÉMICA"));
        $pdf->SetFont('Montserrat-Bold', '', 7);
        $pdf->SetFillColor(191, 191, 191);
        $pdf->SetXY(6, 80);
        $pdf->Cell(85, 12, "ASIGNATURA", 1, 0, 'C', true);
        $pdf->Cell(14, 12, "GRUPO", 1, 0, 'C', true);
        $pdf->MultiCell(14, 4, "ESTU-\nDIANTES\n ", 1, 'C', true);
        $pdf->SetXY(119, 80);
        $pdf->MultiCell(15, 4, "AULA\nTALLER o\nLAB.", 1, 'C', true);
        $pdf->SetXY(134, 80);
        $pdf->Cell(12, 12, "NIVEL", 1, 0, 'C', true);
        $pdf->SetXY(146, 80);
        $pdf->MultiCell(15, 4, "MODALI-\nDAD\n ", 1, 'C', true);
        $pdf->SetXY(161, 80);
        $pdf->Cell(14, 12, "CARRERA", 1, 0, 'C', true);
        $pdf->Cell(80, 6, "HORARIO", 1, 0, 'C', true);
        $pdf->SetXY(175, 86);
        $pdf->Cell(16, 6, "L", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "M", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "M", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "J", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "V", 1, 0, 'C', true);
        $pdf->SetXY(255, 80);
        $pdf->MultiCell(20, 6, "TOTAL HRS\nSEMANALES", 1, 'C', true);
        $pdf->Ln();
        $pdf->SetY(92);
        $pdf->SetFont('Montserrat-regular', '', 6.5);
        foreach($cuerpo as $row)
        {
            $pdf->SetX(6);
            $pdf->Cell(85, 5, utf8_decode($row['desc_materia']), 1, 0, 'L');
            $pdf->Cell(14, 5, utf8_decode($row['desc_grupo']), 1, 0, 'L');
            $pdf->Cell(14, 5, "", 1, 0, 'L');
            $pdf->Cell(15, 5, utf8_decode($row['aula']), 1, 0, 'L');
            $pdf->Cell(12, 5, "", 1, 0, 'L');
            $pdf->Cell(15, 5, "", 1, 0, 'L');
            $pdf->Cell(14, 5, "", 1, 0, 'L');
            $pdf->Cell(16, 5, $row['lunes'], 1, 0, 'C');
            $pdf->Cell(16, 5, $row['martes'], 1, 0, 'C');
            $pdf->Cell(16, 5, $row['miercoles'], 1, 0, 'C');
            $pdf->Cell(16, 5, $row['jueves'], 1, 0, 'C');
            $pdf->Cell(16, 5, $row['viernes'], 1, 0, 'C');
            $pdf->Cell(20, 5, "", 1, 0, 'L');
            $pdf->Ln();
        }
        $pdf->SetX(6);
        $pdf->Cell(169, 5, utf8_decode("PREPARACIÓN, CONTROL Y EVALUACIÓN DE MATERIAS QUE IMPARTE"), 1, 0, 'L');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(20, 5, "", 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetX(6);
        $pdf->Cell(169, 5, "SUBTOTAL     ", 1, 0, 'R');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(20, 5, "", 1, 0, 'C');
        $y = $pdf->GetY();
        $pdf->SetFont('Montserrat-SemiBold', '', 10);
        $pdf->Text(6, $y+10, utf8_decode("II.- ACTIVIDADES DE APOYO A LA DOCENCIA"));
        $pdf->SetFont('Montserrat-Bold', '', 7);
        $pdf->SetXY(6, $y+13);
        $pdf->Cell(140, 12, "NOMBRE DE LA ACTIVIDAD", 1, 0, 'C', true);
        $pdf->Cell(29, 12, "METAS A ATENDER", 1, 0, 'C', true);
        $pdf->SetXY(175, $y+13);
        $pdf->Cell(80, 6, "HORARIO", 1, 0, 'C', true);
        $pdf->SetXY(175, $y+19);
        $pdf->Cell(16, 6, "L", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "M", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "M", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "J", 1, 0, 'C', true);
        $pdf->Cell(16, 6, "V", 1, 0, 'C', true);
        $pdf->SetXY(255, $y+13);
        $pdf->MultiCell(20, 6, "TOTAL HRS\nSEMANALES", 1, 'C', true);
        $pdf->Ln();
        $actividades = array('ORGANIZAR Y REALIZAR ACTIVIDADES DE CAPACITACIÓN Y SUPERACIÓN DOCENTE',
                             'PRESTAR ASESORÍAS DOCENTES A ESTUDIANTES Y PASANTES',
                             'DEFINIR, ADECUAR, PLANEAR, DIRIGIR, COORDINAR Y EVALUAR PROYECTOS Y PROGRAMAS DOCENTES',
                             'DISEÑAR O PRODUCIR MATERIALES DIDÁCTICOS',
                             'ACTIVIDADES DE APOYO A LA DOCENCIA Y A LA INVESTIGACIÓN',
                             'PRESTAR  ASESORÍAS EN PROYECTOS EXTERNOS Y LABORES DE EXTENSIÓN',
                             'PRESTAR ASESORÍAS EN SERVICIO SOCIAL'
                            );
        $pdf->SetXY(6, $y+25);
        $pdf->SetFont('Montserrat-regular', '', 7);
        for($i = 0; $i < count($actividades); $i++)
        {
            $pdf->SetX(6);
            $pdf->Cell(140, 5, utf8_decode($actividades[$i]), 1, 0, 'L');
            $pdf->Cell(29, 5, "", 1, 0, 'C');
            $pdf->Cell(16, 5, "", 1, 0, 'C');
            $pdf->Cell(16, 5, "", 1, 0, 'C');
            $pdf->Cell(16, 5, "", 1, 0, 'C');
            $pdf->Cell(16, 5, "", 1, 0, 'C');
            $pdf->Cell(16, 5, "", 1, 0, 'C');
            $pdf->Cell(20, 5, "", 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->SetX(6);
        $pdf->Cell(169, 5, "SUBTOTAL     ", 1, 0, 'R');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(20, 5, "", 1, 0, 'C');
        $pdf->Ln();
        $pdf->SetX(6);
        $pdf->Cell(169, 5, "TOTAL     ", 1, 0, 'R');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(16, 5, "", 1, 0, 'C');
        $pdf->Cell(20, 5, "", 1, 0, 'C');
        
        $pdf->Output('I', 'horario.pdf');
    }*/

    public function actionDalu($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ALU_CTR');
        $sheet->setCellValue('B1', 'ALU_NOM');
        $sheet->setCellValue('C1', 'ALU_ESP');
        $sheet->setCellValue('D1', 'ALU_PLA');
        $sheet->setCellValue('E1', 'ALU_SEM');
        $sheet->setCellValue('F1', 'ELE_CRE');
        $sheet->setCellValue('G1', 'ALU_PAS');

        $model = $this->estudianteRepository->listadoAlumnosCiclo($idciclo);

        $i = 2;
        foreach($model as $row)
        {
            $idestudiante = $row['idestudiante'];
            $nombre_estudiante = $row['nombre_estudiante'];
            $idcarrera = $row['idcarrera'];
            $plan_estudios = $row['plan_estudios'];
            $num_semestre = $row['num_semestre'];

            $sheet->setCellValue('A'.$i, $idestudiante);
            $sheet->setCellValue('B'.$i, $nombre_estudiante);
            $sheet->setCellValue('C'.$i, $idcarrera);
            $sheet->setCellValue('D'.$i, $plan_estudios);
            $sheet->setCellValue('E'.$i, $num_semestre);
            $sheet->setCellValue('F'.$i, 0);
            $sheet->setCellValue('G'.$i, md5($idestudiante));

            $i++;
        }

        $fileName = 'DALU.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function actionDcat($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'CAT_CVE');
        $sheet->setCellValue('B1', 'CAT_DEP');
        $sheet->setCellValue('C1', 'CAT_NOM');

        $model = $this->profesorRepository->listaRegistros(['CONCAT(nombre_profesor," ",apaterno," ",amaterno)' => SORT_ASC]);

        $i = 2;
        foreach($model as $row)
        {
            $idprofesor = $row['idprofesor'];
            $nombre_profesor = $row['nombre_profesor'].' '.$row['apaterno'].' '.$row['amaterno'];
            $cat_dep = $row['cat_dep'];

            $sheet->setCellValue('A'.$i, $idprofesor);
            $sheet->setCellValue('B'.$i, $cat_dep);
            $sheet->setCellValue('C'.$i, $nombre_profesor);

            $i++;
        }

        $fileName = 'DCAT.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function actionDdep($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'DEP_CVE');
        $sheet->setCellValue('B1', 'DEP_NOM');
        $sheet->setCellValue('C1', 'DEP_NCO');

        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'CIENCIAS BASICAS');
        $sheet->setCellValue('C2', 'CIENCIAS BASICAS');

        $sheet->setCellValue('A3', '2');
        $sheet->setCellValue('B3', 'DEPTO INGENIERIAS');
        $sheet->setCellValue('C3', 'DEPTO INGENIERIAS');

        $fileName = 'DDEP.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function actionDesp($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ESP_CVE');
        $sheet->setCellValue('B1', 'ESP_NOM');
        $sheet->setCellValue('C1', 'ESP_NCO');

        $model = $this->carreraRepository->listaRegistros(['desc_carrera' => SORT_ASC]);

        $i = 2;
        foreach($model as $row)
        {
            $idcarrera = $row['idcarrera'];
            $cve_carrera = $row['cve_carrera'];
            $desc_carrera = $row['desc_carrera'];

            $sheet->setCellValue('A'.$i, $idcarrera);
            $sheet->setCellValue('B'.$i, $desc_carrera);
            $sheet->setCellValue('C'.$i, $desc_carrera);

            $i++;
        }

        $fileName = 'DESP.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function actionDgau($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'GPO_MAT');
        $sheet->setCellValue('B1', 'GPO_GPO');
        $sheet->setCellValue('C1', 'GPO_CAT');
        $sheet->setCellValue('D1', 'GPO_NUM');
        $sheet->setCellValue('E1', 'GPO_LHR');
        $sheet->setCellValue('F1', 'GPO_AUL');

        $model = $this->grupoRepository->listadoGrupo($idciclo);

        $i = 2;
        $j = 1;
        foreach($model as $row)
        {
            $cve_materia = $row['cve_materia'];
            $idgrupo = $row['idgrupo'];
            $idprofesor = $row['idprofesor'];

            $sheet->setCellValue('A'.$i, $cve_materia);
            $sheet->setCellValue('B'.$i, $idgrupo);
            $sheet->setCellValue('C'.$i, $idprofesor);
            $sheet->setCellValue('D'.$i, $j);
            $sheet->setCellValue('E'.$i, '');
            $sheet->setCellValue('F'.$i, '');

            $i++;
            $j++;
        }

        $fileName = 'DGAU.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function actionDlis($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'LIS_CTR');
        $sheet->setCellValue('B1', 'LIS_MAT');
        $sheet->setCellValue('C1', 'LIS_GPO');

        $model = $this->estudianteRepository->listadoAlumnosGrupoCiclo($idciclo);

        $i = 2;
        foreach($model as $row)
        {
            $idestudiante = $row['idestudiante'];
            $cve_materia = $row['cve_materia'];
            $idgrupo = $row['idgrupo'];

            $sheet->setCellValue('A'.$i, $idestudiante);
            $sheet->setCellValue('B'.$i, $cve_materia);
            $sheet->setCellValue('C'.$i, $idgrupo);

            $i++;
        }

        $fileName = 'DLIS.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function actionDret($idciclo)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'RET_CVE');
        $sheet->setCellValue('B1', 'RET_NOM');
        $sheet->setCellValue('C1', 'RET_NCO');

        $model = $this->materiaRepository->listadoMateriaCiclo($idciclo);

        $i = 2;
        foreach($model as $row)
        {
            $cve_materia = $row['cve_materia'];
            $desc_materia = $row['desc_materia'];

            $sheet->setCellValue('A'.$i, $cve_materia);
            $sheet->setCellValue('B'.$i, $desc_materia);
            $sheet->setCellValue('C'.$i, $desc_materia);

            $i++;
        }

        $fileName = 'DRET.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$fileName.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}