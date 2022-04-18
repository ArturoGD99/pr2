<?php
set_time_limit(0);
ini_set("memory_limit", "-1");
include_once('../registro.php');
$query = new Registro();

$id = $_GET['id'];

$campos = "CL.CLIENTE, CM.MARCA, LI.LINEA, PR.PRENDA, TA.TALLA, FT.FOTO, FD.INDICACION5, FF.*";
$tablas = "FFICHA FF INNER JOIN FCAT_CLIENTE CL ON CL.ID_CLIENTE = FF.ID_CLIENTE INNER JOIN FCAT_MARCA CM ON CM.ID_MARCA = FF.ID_MARCA INNER JOIN FCAT_LINEA LI ON LI.ID_LINEA = FF.ID_LINEA INNER JOIN FCAT_PRENDA PR ON PR.ID_PRENDA = FF.ID_PRENDA INNER JOIN FCAT_TALLA TA ON TA.ID_TALLA = FF.ID_TALLA INNER JOIN FFOTO FT ON FT.ID_FICHA = FF.ID_FICHA LEFT JOIN FINDICACIONES FD ON FD.ID_FICHA = FF.ID_FICHA";

$rs = $query->Consultar($campos,$tablas,"FF.ID_FICHA=".$id,"");
if($rs->RecordCount()>0){
    $md = $rs->fields['MODELO'];
    $foto = $rs->fields['FOTO'];
    $ft = explode('|', trim($rs->fields['CORRIDA'],'|'));
    $ft2 = count($ft)-1;
    $cor = $ft[0]." - ".$ft[$ft2];
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>html{margin:15px 50px}body{margin-left:-20px; margin-right:-20px; color:#000; font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; font-size:11px;}</style>
</head>
<body>
<div style="text-align: center;"><!-- position: fixed; left:0;-->
    <table style="width:100%; font-size:11px;">
        <tr>
            <td style="width:35%" align="left"><img style="width: 104px; height: 50px;" src='../dist/img/Logo.png'></td>
            <td style="width:30%;" align="center;"><b>FICHA DE CONFECCION</b></td>
            <td style="width:35%" align="right"><?php echo "Fecha:   " . date("d") . "/" . date("m") . "/" . date("Y"); ?></td>
        </tr>
    </table>
</div><br><hr><br>
<div style="width: 100%; height: 53%; border:solid 0px red; display: inline-block"><!--1er contenedor modelo, foto, composiciones, indicaciones, piezas-->
    <div style="display: inline-block; width: 58%; height: 540px; border: solid 0px green;"><!--Contenedor tabla modelo y foto-->
        <div style="width: 100%; height: 200px; border: solid 0px yellow">
            <table cellpadding="0" cellspacing="0" style="border:1px black solid; width: 100%; font-size: 10px;">
                <tr><td width="10%" align="left"><b>MODELO:</b></td><td width="15%" align="left"><?php echo $rs->fields['MODELO']; ?></td><td width="10%" align="left"><b>DISE&Ntilde;ADORA:</b></td><td width="35%" align="left"><?php echo $rs->fields['DISENADORA']; ?></td></tr>
                <tr><td align="left"><b>ORDEN:</b></td><td align="left"><?php echo $rs->fields['ORDEN']; ?></td><td><b>LINEA:</b></td><td align="left"><?php echo utf8_decode($rs->fields['LINEA']); ?></td></tr>
                <tr><td align="left"><b>PEDIDO:</b></td><td align="left"><?php echo $rs->fields['PEDIDO']; ?></td><td align="left"><b>TALLA:</b></td><td align="left"><?php echo $rs->fields['TALLA']; ?></td></tr>
                <tr><td align="left"><b>SEMANA:</b></td><td align="left"><?php echo $rs->fields['SEMANA']; ?></td><td align="left"><b>CORRIDA:</b></td><td align="left"><?php echo $cor; ?></td></tr>
                <tr><td align="left"><b>TEMPORADA:</b></td><td align="left"><?php echo $rs->fields['TEMPORADA']; ?></td><td align="left"><b>PATRONISTA:</b></td><td align="left"><?php echo $rs->fields['PATRONISTA']; ?></td></tr>
                <tr><td align="left"><b>CLIENTE:</b></td><td align="left"><?php echo $rs->fields['CLIENTE']; ?></td><td align="left"><b>MUESTRISTA:</b></td><td align="left"><?php echo $rs->fields['MUESTRISTA']; ?></td></tr>
                <tr><td align="left"><b>MARCA:</b></td><td align="left"><?php echo utf8_decode($rs->fields['MARCA']); ?></td><td align="left"><b>GRADUADORA:</b></td><td align="left"><?php echo $rs->fields['GRADUADORA']; ?></td></tr>
                <tr><td align="left"><b>PRENDA:</b></td><td align="left"><?php echo $rs->fields['PRENDA']; ?></td><td align="left"><b>CANTIDAD:</b></td><td align="left"><?php echo $rs->fields['CANTIDAD']; ?></td></tr>
            </table>
            <table cellpadding="0" cellspacing="0" style="border:1px black solid; width: 100%; font-size: 10px">
                <tr colspan="2"><td colspan="3" ><b>DESCRIPCION: </b><?php echo utf8_decode($rs->fields['DESCRIPCION']) ?></td></tr>
            </table>
            <table cellpadding="0" cellspacing="0" style="border:1px black solid; width: 100%; font-size: 10px">
                <tr align="left">
                    <td><b>IGUAL/PARECIDO: </b><?php echo $rs->fields['IGUAL'] ?></td>
                    <td><b>REFERENCIA: </b><?php echo utf8_decode($rs->fields['INDICACION5']); ?></td>
                </tr>
            </table>
        </div>
        <div style="width: 100%; height: 340px; border: solid 1px black;"><img src="../<?php echo $foto; ?>" style="width: 380px; height: 338px"></div>
    </div>
    <div style="display: inline-block; width: 41%; height: 540px; border: solid 0px blue;"><!--Contenedor composiciones, indicaciones, piezas-->
        <!--<div style="width: 100%; height: 180px; border: solid 0px yellow">-->
            <?php
            $campos = "CT.COMBINACION, CT.CORTA, FC.ID_COMBINACION, CT.ID_CAT_COMBINACION, FC.DESCRIPCION, FC.COMPOSICION";
            $tablas = "FCOMBINACIONES FC LEFT JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION";
            $r0 = $query->Consultar($campos,$tablas,"ID_FICHA=".$id."  AND CT.ID_CAT_COMBINACION <> 7","CT.ID_CAT_COMBINACION");
            if($r0->RecordCount()>0){
                echo "<table cellpadding='0' cellspacing='0' style='border:1px black solid; width: 100%; font-size: 10px'><tr><th align='left' colspan='2' style='background-color: lightgrey'><b>COMPOSICION (ES):</b></th></tr>";
                while(!$r0->EOF){
                    echo "<tr style='text-align: justify;'><td width='16%' align='left'><b>".$r0->fields['CORTA']."</b></td>";
                    if($r0->fields['ID_CAT_COMBINACION']=='8' || $r0->fields['ID_CAT_COMBINACION']=='10' || $r0->fields['ID_CAT_COMBINACION']=='11' || $r0->fields['ID_CAT_COMBINACION']=='12' || $r0->fields['ID_CAT_COMBINACION']=='13'){
                        $lin = ($r0->fields['DESCRIPCION']!=''?'<b>'.utf8_decode($r0->fields['DESCRIPCION']).'</b><br>'.utf8_decode($r0->fields['COMPOSICION']):utf8_decode($r0->fields['COMPOSICION']));
                        echo "<td width='84%' align='left'>".$lin."</td>";
                        //echo "<td width='84%' align='left'><b>".utf8_decode($r0->fields['DESCRIPCION'])."</b><br>".utf8_decode($r0->fields['COMPOSICION'])."</td>";
                    }else{
                        $campos1 = "CT.COMBINACION, CT.CORTA, FC.ID_COMBINACION, CT.ID_CAT_COMBINACION, CO.DESCRIPCION AS DESC_COMP, FV.COMPOSICION";
                        $tablas2 = "FCOMBINACIONES FC LEFT JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION LEFT JOIN FVARIANTES FV ON FV.ID_COMBINACION = FC.ID_COMBINACION LEFT JOIN FCOMPOSICIONES CO ON CO.ID_COMBINACION = FC.ID_COMBINACION";
                        $rc = $query->Consultar($campos1,$tablas2,"FC.ID_COMBINACION=".$r0->fields['ID_COMBINACION']."","CT.ID_CAT_COMBINACION");
                        if($rc->RecordCount()>0){
                            $comp = "";
                            echo "<td width='84%' align='left'>";
                            if($rc->fields['DESC_COMP']!='')
                                echo "<b>".utf8_decode($rc->fields['DESC_COMP'])."</b><br>";
                            while(!$rc->EOF){
                                $comp .= $rc->fields['COMPOSICION']."|";
                            $rc->MoveNext();
                            }
                            $finc  = explode("|",$comp);
                            $finc = array_unique($finc);
                            $variable = implode($finc,"<br>");
                            echo $variable;
                            echo "</td>";
                        }
                    }
                    echo "</tr>";
                    $r0->MoveNext();
                }
                echo "</table><br><br>";
            }
            ?>
        <!--</div>
        <div style="width: 100%; height: 140px; border: solid 0px yellow"><!--INDICACIONES-->
            <?php $r1 = $query->Consultar("*","FINDICACIONES","ID_FICHA=".$id,"");
            if($r1->RecordCount()>0){
                echo "<table cellpadding='0' cellspacing='0' border='1px' style='border:1px black solid; width: 100%; font-size: 9px; text-align: justify'><tr><th align='left' style='background-color: lightgrey'><b>INDICACIONES:</b></th></tr>";
                while(!$r1->EOF){
                    if($r1->fields['INDICACION2']!= '')//Indicaciones de tejido
                        echo "<tr style='text-align: justify'><td width='20%' align='justify' style='text-align: justify;'>".$r1->fields['INDICACION2']."</td></tr>";//tejido
                    if(($r1->fields['PLANCHADO']!= '') || ($r1->fields['INDICACION4']!= '')){//Indicaciones de cuidado
                        $cuidado = "";
                        if($r1->fields['PLANCHADO']!= '')
                            $cuidado .= strtoupper($r1->fields['PLANCHADO']).($r1->fields['INDICACION4'] != ''?' - ':'');
                        if($r1->fields['INDICACION4']!= '')
                            $cuidado .= $r1->fields['INDICACION4'];
                        echo "<tr style='text-align: justify'><td width='20%' align='justify' style='text-align: justify;'>".$cuidado."</td></tr>";//cuidado
                    }
                    if($r1->fields['INDICACION']!= '')//Indicaciones grls
                        echo "<tr style='text-align: justify'><td width='20%' align='justify' style='text-align: justify;'>".$r1->fields['INDICACION']."</td></tr>";//grls
                    if($r1->fields['INDICACION3']!= '')//Indicaciones de corte
                        echo "<tr style='text-align: justify'><td width='20%' align='justify' style='text-align: justify;'>".$r1->fields['INDICACION3']."</td></tr>";//corte
                    $r1->MoveNext();
                }
                echo "</table><br><br>";
            }
            ?>
        <!--</div>
        <div style="width: 100%; height: 200px; border: solid 0px yellow"><!--PIEZAS-->
            <?php $r0 = $query->Consultar("CT.COMBINACION, CT.CORTA, FP.*","FPIEZAS FP INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FP.ID_CAT_COMBINACION","ID_FICHA=".$id,"CT.ID_CAT_COMBINACION");
            if($r0->RecordCount()>0){
                echo "<table cellpadding='0' cellspacing='0' style='border:1px black solid; width: 100%; border-collapse: collapse; font-size: 8.5px'><tr><th align='left' colspan='3' style='background-color: lightgrey; border: 1px solid black;'><b>NUMERO DE PIEZAS:</b></th></tr>";
                while(!$r0->EOF){
                    echo "<tr style='text-align: justify;'><td width='50%' align='left' style='border: 1px solid black;'>".utf8_decode($r0->fields['DESCRIPCION'])."</td><td width='10%' align='center' style='border: 1px solid black;'>".$r0->fields['CANTIDAD']."</td><td width='40%' align='center' style='border: 1px solid black;'>".$r0->fields['CORTA']."</td></tr>";
                    $r0->MoveNext();
                }
                echo "</table>";
            }
            ?>
        <!--</div>-->
    </div>
</div><br>
<div style="width: 100%; height: 39%; border:solid 0px red; display: inline-block;"><!--2do Contenedor medidas, combinaciones-->
    <?php
    $rvar = $query->Consultar("FC.ID_COMBINACION, FT.COMBINACION, FT.CORTA, COUNT(FV.ID_COMBINACION) AS VARIANTES","FCOMBINACIONES FC INNER JOIN FVARIANTES FV ON FV.ID_COMBINACION = FC.ID_COMBINACION INNER JOIN FCAT_COMBINACION FT ON FT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION","FC.ID_FICHA =".$id." AND FT.ID_CAT_COMBINACION NOT IN (8,10,12,13) GROUP BY FC.ID_COMBINACION","");
    $var = $rvar->fields['VARIANTES'];
    if($var <= 7){
        echo "<div style='width: 47%; height: 400px; border: solid 0px green; display: inline-block;'>";
    }
    ?>
    <!--<div style='width: 34%; height: 400px; border: solid 0px green; display: inline-block;'>-->
        <?php
        $rm = $query->Consultar('*','FMEDIDAS','ID_FICHA = '.$id.' GROUP BY TALLA','ID_MEDIDA');
        if($rm->RecordCount()>0){
            $ct = $rm->RecordCount();
            $ct = $ct+3;
            echo "<table style='border:1px black solid; width: 100%; border-collapse: collapse;'><thead><tr><th colspan='".$ct."' style='background-color: lightgrey; border: 1px solid black; font-size: 8px;'>LA MUESTRA ES SOLO PARA CONFECCION, NO COINCIDE CON LA TABLA DE MEDIDAS</th></tr>";
            echo "<tr><th width='2%' style='border: 1px solid black;'></th><th width='38%'>MEDIDAS</th>";
            while(!$rm->EOF){
                echo "<th align='center' style='align-content: center; text-align: center; border: 1px solid black;' width='auto'>".$rm->fields['TALLA']."</th>";
                $rm->MoveNext();
            }
            echo "<th align='center' style='align-content: center; text-align: center' width='auto'>TOL</th></tr></thead>";
            echo "<tbody>";
        $r1 = $query->Consultar('FM.ID_MEDIDA, FM.ID_CAT_MED, FC.DESCRIPCION, FM.TOLERANCIA, FM.TALLA','FMEDIDAS FM INNER JOIN FCAT_MEDIDA FC ON FC.ID_CAT_MED = FM.ID_CAT_MED','FM.ID_FICHA = '.$id.' GROUP BY FM.ID_CAT_MED','FM.ID_MEDIDA');//SACAR FILAS
        if($r1->RecordCount()>0){
            $char = 64;
            while(!$r1->EOF){
                $char = $char +1;
                echo "<tr><td style='border: 1px solid black;'><b>".chr($char)."</b></td><td style='border: 1px solid black; font-size: 9px'>".utf8_decode($r1->fields['DESCRIPCION'])."</td>";
                $r2 = $query->Consultar("*", 'FMEDIDAS', 'ID_FICHA = '.$id.' GROUP BY TALLA','ID_MEDIDA');
                if($r2->RecordCount()>0){
                    while (!$r2->EOF) {
                        echo "<td align='center' style='align-content: center; border: 1px solid black; font-size: 9px'>";
                        $r3 = $query->Consultar('*','FMEDIDAS','ID_CAT_MED = '.$r1->fields['ID_CAT_MED'].' AND TALLA = "'.$r2->fields['TALLA'].'" AND ID_FICHA = '.$id.' ','');
                        if($r3->RecordCount()>0){
                            while (!$r3->EOF) {
                                echo $r3->fields['MEDIDA'];
                                $r3->MoveNext();
                            }
                        }
                        echo "</td>";
                        $r2->MoveNext();
                    }
                }
                echo "<td align='center' style='align-content: center; border: 1px solid black;'>".$r1->fields['TOLERANCIA']."</td></tr>";
                $r1->MoveNext();
            }
        }
            echo "</tbody></table>";
        }
        if($var <= 7){
            echo "</div><div style='width: 52%; height: 400px; border: solid 0px blue; display: inline-block;'>";
        }else{
            echo "<br><br>";
        }
        ?>
    <!--</div>
    <div style="width: 65%; height: 400px; border: solid 0px blue; display: inline-block;">-->
            <?php
            $rm = $query->Consultar("FC.ID_COMBINACION, FT.COMBINACION, FT.CORTA, FC.ICOD, FC.DESCRIPCION, COUNT(FV.ID_COMBINACION) AS VARIANTES","FCOMBINACIONES FC INNER JOIN FVARIANTES FV ON FV.ID_COMBINACION = FC.ID_COMBINACION INNER JOIN FCAT_COMBINACION FT ON FT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION","FC.ID_FICHA =".$id." AND FT.ID_CAT_COMBINACION NOT IN (8,10,12,13) GROUP BY FC.ID_COMBINACION","");
            if($rm->RecordCount()>0){
                $ct = $rm->fields['VARIANTES']+1;
                echo "<table cellpadding='0' cellspacing='0' style='font-size: 9px;  border:1px black solid; width: 100%; border-collapse: collapse;'><thead><tr><th colspan='".$ct."'  style='background-color: lightgrey; border: 1px solid black;'>COMBINACIONES</th></tr>";
                echo "<tr><th style='align-content: center; text-align: center; border: 1px solid black;'>TIPO</th>";
                for($i=1; $i<=$rm->fields['VARIANTES']; $i++){
                    echo "<th style='align-content: center; text-align: center; border: 1px solid black;'>".$i."</th>";
                }
                echo "</tr></thead><tbody>";
                while(!$rm->EOF){
                    $comb = $rm->fields['ID_COMBINACION'];
                    echo "<tr><td style='align-content: left; text-align: left; border: 1px solid black; width: 14%'>".$rm->fields['CORTA']."</td>";
                    $rv = $query->Consultar("*","FVARIANTES","ID_COMBINACION =".$comb,"");
                    if($rv->RecordCount()>0){
                        while(!$rv->EOF){
                            echo "<td style='align-content: center; text-align: center; border: 1px solid black; width: auto'>";
                            echo $rv->fields['ICOD']."<br>".$rv->fields['COLOR']."<br><label style='font-size: 8px'>".str_replace('@','<br>',$rv->fields['PRV_FACT'])."</label>";
                            if($rv->fields['ICOD2']!= ''){
								echo "<br>".$rv->fields['ICOD2']."<br><label style='font-size: 8px'>".str_replace('@','<br>',$rv->fields['PRV_FACT2'])."</label>";
							}
                            echo "</td>";
                            $rv->MoveNext();
                        }
                    }
                    echo "</tr>";
                    $rm->MoveNext();
                }
                echo "</tbody></table>";
            }
            if($var <= 7){
                echo "</div>";
            }
            ?>
    <!--</div>-->
</div>
<div style="text-align: center;"><!-- position: fixed; left:0;-->
    <table style="width:100%; font-size:11px;">
        <tr>
            <td style="width:35%" align="left"><img style="width: 104px; height: 50px;" src='../dist/img/Logo.png'></td>
            <td style="width:30%;" align="center;"><b>FICHA DE CONFECCION</b></td>
            <td style="width:35%" align="right"><?php echo "Fecha:   " . date("d") . "/" . date("m") . "/" . date("Y"); ?></td>
        </tr>
    </table>
</div><br><hr><br>
<div style="width: 70%; height: 40%; border:solid 0px blue;"><!--3er contenedor habilitaciones-->
    <div style="width: 100%; height: 290px; border: solid 0px green">
        <?php $rs = $query->Consultar("FH.VARIANTE","FHABILITACION FM INNER JOIN FHABIL_VARIANTE FH ON FH.ID_HABIL = FM.ID_HABILITACION","ID_FICHA=".$id." GROUP BY FH.VARIANTE","");
        if($rs->RecordCount()>0){
            $ct = $rs->RecordCount();
            $rm = $query->Consultar("FT.TALLA","FHABILITACION FH INNER JOIN FHABIL_TALLAS FT ON FT.ID_HABIL = FH.ID_HABILITACION","FH.ID_FICHA = ".$id." GROUP BY FT.TALLA","FT.ID_HABIL_TALLA");
            $ct = $ct + $rm->RecordCount()+1;
            echo "<table style='font-size: 9px; border:1px black solid; width: 100%; border-collapse: collapse;'><thead><tr><th colspan='".$ct."' style='background-color: lightgrey; border: 1px solid black;'><b>HABILITACION</b></th></tr>";
            echo "<tr><th style='align-content: center; text-align: center; border: 1px solid black;'>Descripci&oacute;n</th>";
            while(!$rs->EOF){
                echo "<th style='align-content: center; text-align: center; border: 1px solid black;'>".$rs->fields['VARIANTE']."</th>";
                $rs->MoveNext();
            }
            $r0 = $query->Consultar("FT.TALLA","FHABILITACION FH INNER JOIN FHABIL_TALLAS FT ON FT.ID_HABIL = FH.ID_HABILITACION","FH.ID_FICHA = ".$id." GROUP BY FT.TALLA","FT.ID_HABIL_TALLA");
            if($r0->RecordCount()>0){
                while(!$r0->EOF){
                    echo "<th style='align-content: center; text-align: center; border: 1px solid black;'>".$r0->fields['TALLA']."</th>";
                    $r0->MoveNext();
                }
            }
            echo "</tr></thead><tbody>";
            $r1 = $query->Consultar("*","FHABILITACION","ID_FICHA = ".$id,"ID_HABILITACION");
            if($r1->RecordCount()>0){
                while(!$r1->EOF){
                    echo "<tr><td style='align-content: left; text-align: left; border: 1px solid black;'>".$r1->fields['DESCRIPCION']."</td>";
                    $r2 = $query->Consultar("*","FHABIL_VARIANTE","ID_HABIL = ".$r1->fields['ID_HABILITACION'],"ID_HABIL_VAR");
                    if($r2->RecordCount()>0){
                        while(!$r2->EOF){
                            echo "<td style='align-content: center; text-align: center; border: 1px solid black;'>".utf8_decode($r2->fields['HABIL'])."</td>";
                            $r2->MoveNext();
                        }
                    }
                    $r3 = $query->Consultar("*","FHABIL_TALLAS","ID_HABIL = ".$r1->fields['ID_HABILITACION'],"ID_HABIL_TALLA");
                    if($r3->RecordCount()>0){
                        while(!$r3->EOF){
                            echo "<td style='align-content: center; text-align: center; border: 1px solid black;'>".utf8_decode($r3->fields['HABIL'])."</td>";
                            $r3->MoveNext();
                        }
                    }
                    echo "</tr>";
                    $r1->MoveNext();
                }
            }
            echo "</tbody></table>";
        }
        ?>
    </div>
</div>
</body>
</html>