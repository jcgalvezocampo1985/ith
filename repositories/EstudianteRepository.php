<?php

namespace app\repositories;

use app\models\Estudiante;

class EstudianteRepository
{
    public function all()
    {
        return Estudiante::find()->all();
    }
}