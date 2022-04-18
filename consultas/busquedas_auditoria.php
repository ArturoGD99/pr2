<?php
include_once('../registro.php');
$query = new Registro();
$tp = $_POST['tp'];//tipo de consulta

if($tp == 'orden'){
    $orden = $_POST['orden'];
    $rs = $query->Consultar("*","FFICHA","ORDEN LIKE '".$orden."' ","");
    if($rs->RecordCount()>0){
        $datos = $rs->fields['ORDEN']."@".$rs->fields['MODELO']."@".$rs->fields['ID_PRENDA']."@".$rs->fields['ID_CLIENTE']."@".$rs->fields['ID_MARCA']."@".$rs->fields['GRADUADORA']."@".$rs->fields['ID_FICHA'];
        $cor = explode('|', $rs->fields['CORRIDA']);
        $talla = "";
        $talla .= "<select class='custom-select' id='cmbtalla' name='ncmbtalla' tabindex='8' onchange=\"Buscar_Medidas($('#cmbtalla').val())\"><option value='0'>Seleccione la talla</option><optgroup>";
        for($i=0; $i<=count($cor)-2; $i++){
            $talla.= "<option value=".$cor[$i].">".$cor[$i]."</option>";
        }
        $talla .= "</optgroup></select>";
        echo $datos."|".$talla;
    }else echo 0;
}else if($tp == 'medidas'){
    $id = $_POST['id'];
    $talla = $_POST['talla'];

    $rs = $query->Consultar("FM.ID_CAT_MED, FC.DESCRIPCION, FM.TALLA, FM.MEDIDA, FM.TOLERANCIA","FMEDIDAS FM INNER JOIN FCAT_MEDIDA FC ON FC.ID_CAT_MED = FM.ID_CAT_MED","FM.ID_FICHA = ".$id." AND FM.TALLA = '".$talla."'","");
    if($rs->RecordCount()>0){
        $tbl = "<table class='table'><thead><tr><th>PUNTO DE MEDICION</th><th>TOL</th><th>ESP TALLA ".$talla."</th><th>MED</th></tr></thead><tbody>";
        while(!$rs->EOF){
            $tbl .= "<tr><td>".$rs->fields['DESCRIPCION']."</td><td>".$rs->fields['TOLERANCIA']."</td><td>".$rs->fields['MEDIDA']."</td><td><input type='text'></td></tr>";
            $rs->MoveNext();
        }
        $tbl .= "</tbody></table>";
    }
    echo $tbl;
}
?>