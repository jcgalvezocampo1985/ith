<?php
use yii\helpers\ArrayHelper;

class MyGlobalFunctions
{
    public static function quitarAcentos($cadenaTexto)
    {
        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadenaTexto = utf8_encode($cadenaTexto);

        //Ahora reemplazamos las letras
        $cadenaTexto = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadenaTexto
        );

        $cadenaTexto = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadenaTexto
        );

        $cadenaTexto = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadenaTexto
        );

        $cadenaTexto = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadenaTexto
        );

        $cadenaTexto = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadenaTexto
        );

        $cadenaTexto = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadenaTexto
        );

        return $cadenaTexto;
    }

    public static function dropDownList($query, $id, array $value)
    {
        $datos = ArrayHelper::map($query, $id, $value[0]);

        if(count($value) > 1)
        {
            $datos = ArrayHelper::map($query, 'idprofesor', function($model) use ($value){
                $size = count($value);
                if($size == 2)
                {
                    $valor = $model[$value[0]].' '.$model[$value[1]];
                }
                else if($size == 3)
                {
                    $valor = $model[$value[0]].' '.$model[$value[1]].' '.$model[$value[2]];
                }
                return $valor;
            });
        }

        return $datos;
    }
}