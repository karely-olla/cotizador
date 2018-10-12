<?php

try {
    $con = new PDO('mysql:host=localhost; dbname=cotizador; charset=utf8', 'root', '');
	// $con = new PDO('mysql:host=localhost; dbname=db_cotizador_rm; charset=utf8', 'root', '');
} catch (PDOException $e) {
    echo "ERROR " . $e->getMessage();
    die();
}
if (!function_exists('ejecutarConsulta')) {
    function ejecutarConsulta($sql)
    {
        global $con;
        $query = $con->prepare($sql);
        $query->execute();
        return $query;
    }

    function ejecutarConsultaSimpleFila($sql)
    {
        global $con;
        $query = $con->query($sql);
        $row = $query->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    function retornarID($sql)
    {
        global $con;
        $query = $con->prepare($sql);
        $query->execute();
        $id = $con->lastInsertId();
        return $id;
    }

    function limpiarCadena($str)
    {
        $str = ucwords(mb_strtolower($str, 'UTF-8'));
        $str_simple = str_replace("'", "", $str);
        $str_doble = str_replace('"', "", $str_simple);
        $str_final = htmlspecialchars($str_doble);
        return trim(filter_var($str_final, FILTER_SANITIZE_STRING));
    }

    function validarEmail($email)
    {
        $str_final = htmlspecialchars($email);
        return trim(filter_var($str_final, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL));
    }
}

    

if($_POST){
    function insertDpto($dpto, $posicion)
    {
        $n = 0;
        $arregloNotas = array();
        $departamento = $dpto;
        foreach ($_POST['note_' . $departamento] as $nota) {
            $arregloNotas[$departamento][$n] = [
                'nota' => $nota
            ];
            $n++;
            if ($nota == "") {

            } else {
            }
        }
        $sqlDptos = "INSERT INTO `departamentos`(`id_empresa`, `departamento`,  `descripcion`, `notas`) 
                            VALUES ('".$_POST['id_empresa']."','" . $_POST['areas'][$posicion]."',
                            '".$_POST['description'][$posicion] . "','" . json_encode($arregloNotas) . "')";
        ejecutarConsulta($sqlDptos);
    }
    // var_dump($_POST);
    echo count($_POST['areas']) ."<br>";
    // die();

    for ($i=0; $i <count($_POST['areas']) ; $i++) { 
        switch ($_POST['areas'][$i]) {
            case 'reception':                
            case 'support':                
            case 'buy':                
            case 'mrs_keys':                
            case 'golf':                
            case 'garden':                            
            case 'sell':
                insertDpto($_POST['areas'][$i], $i);
            break;    
            case 'food':
                $sqlDptos = "INSERT INTO `departamentos`(`id_empresa`, `departamento`,  `descripcion`, `notas`) 
                        VALUES ('".$_POST['id_empresa']."','".$_POST['areas'][$i]."','','')";
                $id_departamento = retornarID($sqlDptos);
                for ($j=0; $j <count($_POST['id_servicio']) ; $j++) { 
                    $sql = "INSERT INTO `ayb`(`id_departamento`, `id_servicio`, `lugar`, `hora`, `menu`) VALUES 
                            ('$id_departamento', '".$_POST['id_servicio'][$j]."', '".$_POST['place'][$j]."', 
                             '".$_POST['hour'][$j]."', '".$_POST['menu'][$j]."')";
                    $result = ejecutarConsulta($sql);    
                }
                if($result){
                    $n =0;
                    $arregloNotas = array();
                    foreach ($_POST['note_food'] as $id => $value) {
                        // echo $id."<br>";
                        foreach ($value as $nota) {
                            $arregloNotas['notas'][] = [
                                'nota' => $nota
                            ];                
                            $n++;
                        }
                        if ($nota =="") {                            
                        }else{
                            $sqlUpd = "UPDATE `ayb` SET `notas`= '".json_encode($arregloNotas)."' WHERE id_servicio = '$id' ";
                            $result2 = ejecutarConsulta($sqlUpd);
                            $arregloNotas = array();
                        }
                    }
                    // echo"<pre>";
                    //     var_dump($arregloNotas);
                    // echo"</pre>";
                    // echo  "se inserto con exito <br>";
                }else {
                    // echo "no se inserto ni madres <br>";
                }
            break;
        }
    }

    // for ($i=0; $i <count($_POST['id_servicio']) ; $i++) { 
    //     $sql = "INSERT INTO `ayb`(`id_empresa`, `id_servicio`, `lugar`, `hora`, `menu`) VALUES 
    //             ('".$_POST['id_empresa']."', '".$_POST['id_servicio'][$i]."', '".$_POST['place'][$i]."', '".$_POST['hour'][$i]."', '".$_POST['menu'][$i]."')";
    //         $result = ejecutarConsulta($sql);    
    // }
    // if($result){
    //     $n =0;
    //     $arregloNotas = array();
    //     foreach ($_POST['note_food'] as $id => $value) {
    //         echo $id."<br>";
    //         foreach ($value as $nota) {
    //             $arregloNotas['notas'][$n] = [
    //                 'id' => $id,
    //                 'nota' => $nota
    //             ];                
    //             $n++;
    //         }
    //         if ($nota =="") {
                
    //         }else{
    //             $sqlUpd = "UPDATE `ayb` SET `notas`= '".json_encode($arregloNotas)."' WHERE id_servicio = '$id' ";
    //             // echo $sqlUpd;
    //             // die();
    //             $result2 = ejecutarConsulta($sqlUpd);
    //             $arregloNotas = [];
    //         }
    //     }
    //     echo"<pre>";
    //         var_dump($arregloNotas);
    //     echo"</pre>";
    //     echo  "se inserto con exito <br>";
    // }else {
    //     echo "no se inserto ni madres <br>";
    // }

}


?>