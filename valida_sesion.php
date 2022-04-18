<?php
include_once('registro.php');
$query = new Registro();
$user = $_POST['user'];
$pass = trim($_POST['pwd']);

$campos = "*";
$tablas = "FUSUARIOS";
$criterios = "USUARIO = '".trim($user)."' AND CONTRASENA ='".md5(trim($pass))."'";
$rs = $query->Consultar("*","FUSUARIOS",$criterios,"");
if($rs->RecordCount()>0){
    if($rs->fields['STATUS']>0){
        echo $rs->fields['ID_USUARIO']."|".$rs->fields['ID_PERFIL']."|".$rs->fields['NOMBRE']." ".$rs->fields['PATERNO']." ".$rs->fields['MATERNO']."|Ingreso";
    }else echo "Usuario Inactivo";
}else echo "Incorrecto"
?>