<?php
include_once('../registro.php');
$query = new Registro();
$tp = $_POST['tp'];//tipo de consulta
$cliente = $_POST['cliente'];
$marca = $_POST['marca'];
$linea = $_POST['linea'];
$id_prenda = $_POST['id_prenda'];
$orden = $_POST['orden'];
$prv = $_POST['prv'];
$idl = $_POST['id'];//ID_LINEA
//$idt = $_POST['idt'];//ID_TALLA

if($tp == 'cte'){
    $mc = $_POST['mc'];
    $rs = $query->Consultar("*","FCAT_MARCA","ID_CLIENTE=".$cliente,"");
    echo "<select class='custom-select' id='cmbmarca' name='ncmbmarca' tabindex='4'><option value='0'></option>";//onchange='Buscar_Linea();'
    echo "<optgroup>";
    while(!$rs->EOF){
        echo "<option value='".$rs->fields['ID_MARCA']."' ".($mc==$rs->fields['ID_MARCA']?"selected":"").">".$rs->fields['MARCA']."</option>";
        $rs->MoveNext();
    }
    echo "</optgroup>";
    echo "</select>";
}else if($tp == 'linea'){
    $mc = $_POST['mc'];
    $rs = $query->Consultar("FM.ID_LINEA, P.LINEA","FCAT_MARCA M INNER JOIN FMARCA_LINEA FM ON FM.ID_MARCA = M.ID_MARCA INNER JOIN FCAT_LINEA P ON P.ID_LINEA = FM.ID_LINEA INNER JOIN FCAT_CLIENTE C ON C.ID_CLIENTE = M.ID_CLIENTE","M.ID_CLIENTE = '".$cliente."' AND M.ID_MARCA =".$marca,"");
    echo "<select class='custom-select' id='cmblinea' name='ncmblinea' tabindex='4'><option value='0'></option>";//onchange='Buscar_Prendas()'
    echo "<optgroup>";
    while(!$rs->EOF){
        echo "<option value='".$rs->fields['ID_LINEA']."' ".($mc==$rs->fields['ID_LINEA']?"selected":"").">".$rs->fields['LINEA']."</option>";
        $rs->MoveNext();
    }
    echo "</optgroup>";
    echo "</select>";
}/*else if($tp == 'talla'){
    $rs = $query->Consultar("*","FCAT_TALLA","ID_LINEA=".$idl,"");
    echo "<select class='custom-select' id='cmbtalla' name='ncmbtalla' tabindex='4'><option value='0'>Seleccione la talla</option>";//onchange='Buscar_Corrida();'
    echo "<optgroup>";
    while(!$rs->EOF){
        echo "<option value='".$rs->fields['ID_TALLA']."' ".($cd==$rs->fields['ID_TALLA']?"selected":"").">".$rs->fields['TALLA']."</option>";
        $rs->MoveNext();
    }
    echo "</optgroup>";
    echo "</select>";
}*/else if($tp == 'prenda'){
    $mc = $_POST['mc'];
    $campos = "CC.CLIENTE, CM.MARCA, CT.LINEA, CP.PRENDA, PL.ID_PRENDA_LINEA";
    $tablas = "FPRENDA_LINEA PL INNER JOIN FCAT_PRENDA CP ON CP.ID_PRENDA = PL.ID_PRENDA INNER JOIN FCAT_MARCA CM ON CM.ID_MARCA = PL.ID_MARCA INNER JOIN FCAT_CLIENTE CC ON CC.ID_CLIENTE = CM.ID_CLIENTE INNER JOIN FCAT_LINEA CT ON CT.ID_LINEA = PL.ID_LINEA";
    $criterios = "PL.ID_MARCA = ".$marca." AND PL.ID_LINEA = ".$linea;
    $rs = $query->Consultar($campos,$tablas,$criterios,"");
    echo "<select class='custom-select' id='cmbprenda' name='ncmbprenda' tabindex='4'><option value='0'></option>";//onchange='Cargar_Habil();'
    echo "<optgroup>";
    while(!$rs->EOF){
        echo "<option value='".$rs->fields['ID_PRENDA_LINEA']."' ".($mc==$rs->fields['ID_PRENDA_LINEA']?"selected":"").">".$rs->fields['PRENDA']."</option>";
        $rs->MoveNext();
    }
    echo "</optgroup>";
    echo "</select>";
}else if($tp == 'orden'){
    $rs = $query->Consultar("*","FFICHA","ORDEN LIKE '".$orden."'","");
    if($rs->RecordCount()>0){
        $corrida = "";
        $cor = explode('|',$rs->fields['CORRIDA']);
        for($j=0;$j<count($cor)-1;$j++){
            $corrida.= "<input id='corrida' type='text' style='width: 15%' value='".$cor[$j]."' style='text-align:right;' disabled>";
        }
        $datos = $rs->fields['MODELO']."@".$rs->fields['ORDEN']."@".$rs->fields['PEDIDO']."@".$rs->fields['ID_CLIENTE']."@".$rs->fields['ID_MARCA']."@".$rs->fields['ID_LINEA']."@".$rs->fields['SEMANA']."@".$rs->fields['TEMPORADA']."@";
        $datos.= $rs->fields['DISENADORA']."@".$rs->fields['ID_PRENDA']."@".$rs->fields['ID_TALLA']."@".$rs->fields['PATRONISTA']."@".$rs->fields['MUESTRISTA']."@".$rs->fields['GRADUADORA']."@".$rs->fields['DESCRIPCION']."@".$rs->fields['IGUAL']."@";
        $datos.= $rs->fields['MOD_CLIENTE']."@".$corrida."@Ficha@".$rs->fields['ID_FICHA']."@".$rs->fields['CANTIDAD'];
        echo $datos;
    }else{
        $r1 = $query->Consultar_Proscai("*","FPENC","PENUMELLOS LIKE '".$orden."' ","");//validamos si la orden solo tiene una Q asignada
		if($r1->RecordCount()>1){
			$ord = "";
			while(!$r1->EOF){
					$ord.= $r1->fields['PENUM'].', ';
					$r1->MoveNext();
				}
				$ord = trim($ord,', ');
			echo "Repetidos|".$ord;//Envíamos las Q que estan repetidas en Proscai
		}else{
			$campos = "FL.PLSEQ, FP.PENUM, FP.PENUMELLOS, FP.PEPZAS, SUBSTRING(FI.ICOD,1,7) AS MODELO, FI.ICOD, SUBSTRING(FI.ICOD, 11,3) AS TALLAS, FP.CLISEQ, FC.COML5, FC.COMCAJA";
			$tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ INNER JOIN FCOMENT FC ON FC.COMSEQFACT = FP.PESEQ + 1000000000";
			$rs = $query->Consultar_Proscai($campos,$tablas,"FP.PENUMELLOS LIKE '".$orden."' GROUP BY TALLAS","FL.PLSEQ");
			if($rs->RecordCount()>0){
				$cont = 1;
				$cor = "";
				$datos = $rs->fields['PENUM']."|".$rs->fields['PENUMELLOS']."|".$rs->fields['MODELO']."|".utf8_encode($rs->fields['COML5'])."|".utf8_encode($rs->fields['COMCAJA'])."|".$rs->fields['PEPZAS'];
				while(!$rs->EOF){
					$cor.= "<input id='cor".$cont."' type='text' style='width: 15%' value='".$rs->fields['TALLAS']."' style='text-align:right;' disabled>";
					$rs->MoveNext();
					$cont++;
				}
				echo $datos."@".$cor.'@'.$cont.'@Proscai';
			}else echo 0;//No existe la orden
        }
    }
}else if($tp == 'habil'){
    $tbl = "";
    $ficha = $_POST['ficha'];
    $campos = "FC.ID_COMBINACION, FC.ID_FICHA, FF.MODELO, FC.ID_CAT_COMBINACION, FC.ICOD, FC.DESCRIPCION, COUNT(FV.ID_COMBINACION) AS VARIANTES, FV.COLOR";
    $tablas = "FCOMBINACIONES FC INNER JOIN FVARIANTES FV ON FV.ID_COMBINACION = FC.ID_COMBINACION INNER JOIN FFICHA FF ON FF.ID_FICHA = FC.ID_FICHA";
    $rs = $query->Consultar($campos,$tablas,"FC.ID_FICHA = ".$ficha." GROUP BY FC.ID_COMBINACION","VARIANTES DESC");//validamos que tenga combinaciones registradas
    if($rs->RecordCount()>0){
        $var = $rs->fields['VARIANTES'];//cuantas filas vamos a crear en la tabla
        $md = $rs->fields['MODELO'];//Lo usamos para consultar los componentes del modelo en Proscai
        $rs = $query->Consultar("*","FHABILITACION","ID_FICHA = ".$ficha,"");//validamos que tenga habilitaciones registradas, si no va a buscar a Proscai
        if($rs->RecordCount()>0){
            $tbl .= "<h3>Ficha</h3><br><div class='table-responsive'><table id='tbl_habil' class='table table-hover table-sm' style='font-size: 14px; '><thead><tr><th></th><th>Descripción</th><th>Codigo</th>";//
            for($i=1; $i<=$var; $i++){//Creamos los encabezados para las variantes
                $tbl .= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$i."</th>";
            }
            $rm = $query->Consultar("CORRIDA","FFICHA","ID_FICHA = ".$ficha,"");
            $ft = explode('|',$rm->fields['CORRIDA']);//Separamos la corrida por tallas
            for($j=0;$j<count($ft)-1;$j++){//creamos los encabezados para las tallas
                $tbl.= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$ft[$j]."</th>";
            }
            $tbl .= "</tr></thead><tbody>";
            /*******Crea tabla de habilitaciones de Proscai para compararlas con las habilitaciones de la ficha********/
            $r3 = $query->Consultar("FH.*, FF.MODELO","FHABILITACION FH INNER JOIN FFICHA FF ON FF.ID_FICHA = FH.ID_FICHA","FH.ID_FICHA =".$ficha,"");
            if($r3->RecordCount()>0){
                $model = $r3->fields['MODELO'];
                $icod = "";
                while(!$r3->EOF){
                    $icod .= "'".$r3->fields['ICOD']."',";//creamos un string para filtrar las habilitaciones que estan en la ficha para compararlas con proscai
                    $r3->MoveNext();
                }
            }
            $icod = trim($icod,',');
            $tblP = "";
            $r4 = $query->Consultar_Proscai("FE.EART, REPLACE(FE.EART, '\"', '') AS FIN, FI2.IDESCR","FINV FI INNER JOIN FENS FE ON FE.EPRO = FI.ICOD INNER JOIN FINV FI2 ON FI2.ICOD = FE.EART","FI.ICOD LIKE '".$model."' AND EART NOT IN (".$icod.") AND EART LIKE 'H%'","");//EART LIKE 'H%' # AND EART NOT IN (".$icod.")
            if($r4->RecordCount()>0){
                $habilP = "";
                $tblP .= "<h3>Proscai</h3><br><div class='table-responsive'><table id='tblP' class='table table-hover table-sm' style='font-size: 14px; width: 100%'><thead><tr><th></th><th>Descripción</th><th>Codigo</th></tr></thead>";
                while(!$r4->EOF){
                    $des = str_replace('"','',$r4->fields['IDESCR']);
                    $hb = $r4->fields['FIN']."|".$des;
                    $tblP .= "<tr><td><a href='#' id='hp_".$r4->fields['FIN']."' onclick=\"Agregar_Habil('".stripslashes($hb)."');\"><i style='color: green' class='fas fa-plus-circle'></i></a></td><td>".$r4->fields['FIN']."</td><td>".$r4->fields['IDESCR']."</td></tr>";
                    $r4->MoveNext();
                }
                $tblP .= "</tbody></table></div>";
            }
            /********Termina tabla de habilitaciones Proscai*******/
            $r1 = $query->Consultar("*","FHABIL_VARIANTE","ID_HABIL=".$rs->fields['ID_HABILITACION'],"");
            $idv = "";
            $idt = "";
            $r2 = $query->Consultar("*","FHABIL_TALLAS","ID_HABIL=".$rs->fields['ID_HABILITACION'],"");
            $idt1 = $r2->fields['ID_HABIL_TALLA'];
            while(!$rs->EOF){
                $id_habil = $rs->fields['ID_HABILITACION'];
                $tbl.= "<tr><td><a href='#' id='h_".$id_habil."' onclick='Eliminar_Habil(".$id_habil.");'><i style='color: red' class='fas fa-times'></i></a></td><td>".$rs->fields['DESCRIPCION']."</td><td>".$rs->fields['ICOD']."</td>";
                $rv = $query->Consultar("*","FHABIL_VARIANTE","ID_HABIL=".$id_habil,"");
                if($rv->RecordCount()>0){
                    while(!$rv->EOF){
                        $idv .= $rv->fields['ID_HABIL_VAR']."-";
                        $tbl .= "<td align='center' style='align-content: center'><input id='v".$rv->fields['ID_HABIL_VAR']."' value='".$rv->fields['HABIL']."' type='text' style='width: 75%'></td>";
                    $rv->MoveNext();
                    }
                }
                $rango = $idv;
                $rt = $query->Consultar("*","FHABIL_TALLAS","ID_HABIL=".$id_habil,"");
                if($rt->RecordCount()>0){
                    while(!$rt->EOF){
                        $idt .= $rt->fields['ID_HABIL_TALLA']."-";
                        $tbl .= "<td align='center' style='align-content: center'><input id='t".$rt->fields['ID_HABIL_TALLA']."' value='".$rt->fields['HABIL']."' type='text' style='width: 75%'></td>";
                    $rt->MoveNext();
                    }
                }
                //$rango .= "|".$idt1."-".$idt2;//rango para modificar habilitaciones de las tallas
                $rango .= "|".$idt;
            $rs->MoveNext();
            }
        }else{//busca en Proscai los componentes del producto
            $rango = "";
            $tbl .= "<br><div class='table-responsive'><table id='tbl_habil' class='table table-hover table-sm' style='font-size: 14px; '><thead><tr><th></th><th>Descripción</th><th>Codigo</th>";//<h3>Ficha</h3><br>
            for($i=1; $i<=$var; $i++){//Creamos los encabezados para las variantes
                $tbl .= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$i."</th>";
            }
            $rm = $query->Consultar("CORRIDA","FFICHA","ID_FICHA = ".$ficha,"");
            $ft = explode('|',$rm->fields['CORRIDA']);//Separamos la corrida por tallas
            for($j=0;$j<count($ft)-1;$j++){//creamos los encabezados para las tallas
                $tbl.= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$ft[$j]."</th>";
            }
            $tbl .= "</tr></thead><tbody>";
            $rp = $query->Consultar_Proscai(" FE.EART, REPLACE(FE.EART, '\"', '') AS FIN, FI2.IDESCR","FINV FI INNER JOIN FENS FE ON FE.EPRO = FI.ICOD INNER JOIN FINV FI2 ON FI2.ICOD = FE.EART","FI.ICOD LIKE '".$md."' AND EART LIKE 'H%'","");
            if($rp->RecordCount()>0){
                while(!$rp->EOF){
                    $habilP = $rp->fields['FIN'];
                    $desP = str_replace('"','',$rp->fields['IDESCR']);
                    /*$desP = str_replace('(','',$desP);
                    $desP = str_replace(')','',$desP);*/
                    //$desP = strval($desP);
                    $tbl.= "<tr id='".$rp->fields['FIN']."'><td><a href='#' id='".$rp->fields['FIN']."' onclick=\"Eliminar_HabilP('".$habilP."');\"><i style='color: red' class='fas fa-times'></i></a></td><td>".$desP."</td><td>".$rp->fields['FIN']."</td>";
                    for($i=1; $i<=$var; $i++){//Creamos los td de las variantes
                        $tbl .= "<td align='center' style='align-content: center'><input id='".$i."_".$rp->fields['FIN']."' value='".$rp->fields['FIN']."' type='text' style='width: 75%'></td>";//value='".$i."_".$rs->fields['FIN']."'
                    }
                    for($j=0;$j<count($ft)-1;$j++){//creamos los td de las tallas
                        $tbl .= "<td align='center' style='align-content: center'><input id='".$ft[$j]."_".$rp->fields['FIN']."' type='text' style='width: 75%'></td>";//value='".$ft[$j]."/".$rp->fields['FIN']."'
                    }
                    $tbl .= "</tr>";
                    $rp->MoveNext();
                }
            }
        }
        $tbl.= "</tbody></table></div>";
    }
    echo $tbl."@".$var."@".$rm->fields['CORRIDA']."@".$rango."@".$tblP;
}else if($tp=='composicion'){
    $ficha = $_POST['ficha'];
    $comp = "";
    $campos = "FC.ID_FICHA, FC.ID_COMBINACION, FF.MODELO, FC.ID_CAT_COMBINACION, COUNT(FV.ID_COMBINACION) AS VARIANTES";
    $tablas = "FCOMBINACIONES FC LEFT JOIN FVARIANTES FV ON FV.ID_COMBINACION = FC.ID_COMBINACION INNER JOIN FFICHA FF ON FF.ID_FICHA = FC.ID_FICHA";
    $rs = $query->Consultar($campos,$tablas,"FC.ID_FICHA = ".$ficha." GROUP BY FC.ID_COMBINACION","VARIANTES DESC");
    if($rs->RecordCount()>0){//Tiene combinaciones registradas
        $var = $rs->fields['VARIANTES'];
        $comp.= "<div class='table-responsive' style='width: 90%'><table class='table table-bordered table-sm' style='font-size: 13px'><thead><tr><th width='8%'>COMBINACION(ES)</th>";
        for($i=1; $i<=$var; $i++){//Creamos los encabezados para las variantes
            $comp .= "<th align='center' style='align-content: center; text-align: center' width='auto'>COMPOSICION</th>";
        }
        $comp .= "<th align='center' style='align-content: center; text-align: center' width='auto'>DESCRIPCION</th>";
        $comp .= "</tr></thead><tbody>";
        $campos1 = "FC.ID_COMPOSICION, FC.ID_COMBINACION, FC.DESCRIPCION, CB.ID_COMBINACION, CB.ID_FICHA, CB.ID_CAT_COMBINACION, CT.COMBINACION";
        $tablas1 = "FCOMPOSICIONES FC INNER JOIN FCOMBINACIONES CB ON CB.ID_COMBINACION = FC.ID_COMBINACION INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = CB.ID_CAT_COMBINACION";
        $r0 = $query->Consultar($campos1,$tablas1,"CB.ID_FICHA = ".$ficha." AND CB.ID_CAT_COMBINACION NOT IN (7,8,10,11,12)","");
        if($r0->RecordCount()>0){
            while(!$r0->EOF){
                $comp .= "<tr><td>".$r0->fields['COMBINACION']."</td>";
                $id .= $r0->fields['ID_COMPOSICION']."|";
                $r2 = $query->Consultar("*","FVARIANTES","ID_COMBINACION =".$r0->fields['ID_COMBINACION'],"");
                if($r2->RecordCount()>0){
                    while(!$r2->EOF){
                        $idv .= $r2->fields['ID_VARIANTE']."|";
                        $comp .= "<td>".$r2->fields['ICOD']."-<input style='width:70%' id='cp_".$r2->fields['ID_VARIANTE']."' value='".$r2->fields['COMPOSICION']."' type='text'></td>";
                        $r2->MoveNext();
                    }
                    if($r2->RecordCount()<$var){
                        for($i=$r2->RecordCount(); $i<$var; $i++){
                            $comp .= "<td></td>";
                        }
                    }
                }
                $comp .= "<td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='ct_".$r0->fields['ID_COMPOSICION']."' value='".$r0->fields['DESCRIPCION']."'></td>";
                $comp .= "</tr>";
            $r0->MoveNext();
            }
            $comp .= "</tbody></table>";
            echo $comp."@".$id."-".$idv."@1";//Tipo es igual a 1->tiene composiciones registradas y hay que hacer update
        }else{
            $campos = "FC.ID_COMBINACION, FC.ID_FICHA, FC.ID_CAT_COMBINACION, CB.COMBINACION";
            $tablas = "FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION CB ON CB.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION";
            $criterios = "ID_FICHA=".$ficha." AND FC.ID_CAT_COMBINACION NOT IN (7,8,10,11,12)";
            $r1 = $query->Consultar($campos,$tablas, $criterios, "");
            if($r1->RecordCount()>0){
                $id = "";
                $idv = "";
                while(!$r1->EOF){
                    $id .= $r1->fields['ID_COMBINACION']."|";
                    $comp .= "<tr><td>".$r1->fields['COMBINACION']."</td>";
                    $r2 = $query->Consultar("*","FVARIANTES","ID_COMBINACION =".$r1->fields['ID_COMBINACION'],"");
                    if($r2->RecordCount()>0){
                        while(!$r2->EOF){
                            $idv .= $r2->fields['ID_VARIANTE']."|";
                            $comp .= "<td>".$r2->fields['ICOD']."-<input style='width:70%' id='cp_".$r2->fields['ID_VARIANTE']."' value='".$r2->fields['COMPOSICION']."' type='text'></td>";
                            $r2->MoveNext();
                        }
                        if($r2->RecordCount()<$var){
                            for($i=$r2->RecordCount(); $i<$var; $i++){
                                $comp .= "<td></td>";
                            }
                        }
                    }
                    $comp .= "<td align='center' style='align-content: center; text-align: center'><input style='width: 90%' id='ct_".$r1->fields['ID_COMBINACION']."' type='text'></td>";
                    $comp .= "</tr>";
                    $r1->MoveNext();
                }
            }
            $comp .= "</tbody></table>";
            echo $comp."@".$id."-".$idv."@2";//Tipo es igual a 2->cuando no tiene composiciones registradas y hay que hacer insert
        }
    }//else echo 0;
    /*$r0 = $query->Consultar("*","FCOMBINACIONES","ID_FICHA=".$ficha,"");//Se busca primero en combinaciones por que las composiciones dependen de la combinacion
    if($r0->RecordCount()>0){
        $comp.= "<div class='table-responsive' style='width: 70%'><table class='table table-bordered table-sm'><thead><tr><th width='30%'>COMBINACION(ES)</th>";
        //while(!$r0->EOF){
            $r01 = $query->Consultar("*","FVARIANTES", "ID_COMBINACION =".$r0->fields['ID_COMBINACION'],"");
            while(!$r01->EOF){
                $comp.= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$r01->fields['ICOD']."-".$r01->fields['COMPOSICION']."</th>";
                $r01->MoveNext();
            }
        //$r0->MoveNext();
       // }
        $comp.= "<th align='center' style='align-content: center; text-align: center' width='auto'>DESCRIPCION</th></tr>";
        $comp.= "</thead><tbody>";

        $campos = "FC.ID_CAT_COMBINACION, CB.COMBINACION, CP.ID_COMPOSICION, FC.COMPOSICION, CP.ID_COMBINACION, FC.ID_COMBINACION AS COMB, FC.ICOD, CP.DESCRIPCION";
        $tablas = "FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION CB ON CB.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION LEFT JOIN FCOMPOSICIONES CP ON CP.ID_COMBINACION = FC.ID_COMBINACION";
        $r1 = $query->Consultar($campos,$tablas,"FC.ID_FICHA=".$ficha,"CB.ID_CAT_COMBINACION");#CB.ID_CAT_COMBINACION <> 7 AND
        if($r1->RecordCount()>0){
            $id = "";
            $cont = '';
            $otro = 0;
            $idotr = "";
            while(!$r1->EOF){
                if($r1->fields['ID_COMPOSICION']==''){//Utilizamos el contador para darle un Id a aquellas combinaciones que no tengan composicion (Composiciones agregadas despues)
                    $cont .= $r1->fields['COMB'].'|';
                }
                $id .= ($r1->fields['ID_COMPOSICION']==''?'':$r1->fields['ID_COMPOSICION']."|");//$r1->fields['ID_COMPOSICION']."|";
                $comp .= "<tr>";
                $comp .= "<td>".$r1->fields['COMBINACION']." - ".$r1->fields['ICOD']."</td>";
                if($r1->fields['ID_CAT_COMBINACION']=='8'){
                    $otro++;
                    $idotr .= $r1->fields['COMB']."_".$r1->fields['ID_COMPOSICION']."|";
                    $comp .= "<td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='otro_".$r1->fields['COMB']."' value='".$r1->fields['COMPOSICION']."'></td>";//otro_".$r1->fields['COMB']."_
                }else{
                    $comp .= "<td>".$r1->fields['COMPOSICION']."</td>";
                }
                $idc = ($r1->fields['ID_COMPOSICION']==''?$r1->fields['COMB']:$r1->fields['ID_COMPOSICION']);
                $comp .= "<td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='ct_".$idc."' value='ct_".$idc."_".$r1->fields['DESCRIPCION']."'></td>";
                $comp .= "</tr>";
                $r1->MoveNext();
            }
            for($i=$otro+1; $i<=3; $i++){
                $comp .= "<tr><td>OTRO</td>";
                $comp .= "<td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tcomp".$i."'></td>";// value='tcomp".$i."'
                $comp .= "<td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tdesc".$i."'></td></tr>";// value='tdesc".$i."'
            }

            $comp .= "</tbody></table></div>";
            echo $comp."@".$id."@1@".$cont."@".$idotr;//Tipo es igual a 1->cuando ya tiene composiciones registradas y hay que hacer update
        }else{
            $rs = $query->Consultar("FC.ID_COMBINACION, FC.ID_CAT_COMBINACION, CT.COMBINACION, FC.ICOD, FC.DESCRIPCION, FC.COMPOSICION","FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION","ID_FICHA=".$ficha,"");
            if($rs->RecordCount()>0){
                $id = "";
                while(!$rs->EOF){
                    //$id2 = $rs->fields['ID_COMBINACION'];
                    $id .= $rs->fields['ID_COMBINACION']."|";
                    $comp .= "<tr>";
                    $comp .= "<td>".$rs->fields['COMBINACION']." - ".$rs->fields['ICOD']."</td>";
                    $comp .= "<td>".$rs->fields['COMPOSICION']."</td>";
                    $comp .= "<td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='ct_".$rs->fields['ID_COMBINACION']."'></td>";
                    $comp .= "</tr>";
                    $rs->MoveNext();
                }
                $comp .= "<tr><td>OTRO</td><td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tcomp1'></td><td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tdesc1'></td></tr>";
                $comp .= "<tr><td>OTRO</td><td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tcomp2'></td><td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tdesc2'></td></tr>";
                $comp .= "<tr><td>OTRO</td><td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tcomp3'></td><td align='center' style='align-content: center; text-align: center'><input type='text' style='width: 90%' id='tdesc3'></td></tr>";
                $comp .= "</tbody></table></div>";
                echo $comp."@".$id."@2";//Tipo es igual a 2->cuando no tiene composiciones registradas y hay que hacer insert
            }
        }
    }else 0;*/
}else if($tp == 'piezas'){
    $ficha = $_POST['ficha'];
    $tbl = "";
    $rs = $query->Consultar("ID_PIEZA, ID_FICHA, FP.ID_CAT_COMBINACION, COMBINACION, DESCRIPCION, CANTIDAD","FPIEZAS FP INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FP.ID_CAT_COMBINACION","ID_FICHA=".$ficha,"CT.ID_CAT_COMBINACION");
    if($rs->RecordCount()>0){
        $tbl .= "<table  id='tbl_pzas' class='table table-bordered table-hover' style='display: block; font-size: 15px'>";
        $tbl .= "<thead><tr><th>Nombre</th><th>Cantidad</th><th>Tipo</th><th></th></tr></thead><tbody>";
        while(!$rs->EOF){
            $tbl .= "<tr class='filas' id='row".$rs->fields['ID_PIEZA']."'><td>".utf8_encode($rs->fields['DESCRIPCION'])."</td><td>".$rs->fields['CANTIDAD']."</td><td>".$rs->fields['COMBINACION']."</td><td><button type='button' name='remove' id='".$rs->fields['ID_PIEZA']."' class='btn btn-danger btn-xs btn_rmv_pzs'>Quitar</button></td></tr>";
            $rs->MoveNext();
        }
        $tbl .= "</tbody></table>";
        echo $tbl;
    }else echo 0;
}else if($tp == 'tipo_p'){
    $ficha = $_POST['ficha'];
    $select = "";
    $rs = $query->Consultar("FC.ID_CAT_COMBINACION, CB.COMBINACION","FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION CB ON CB.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION","ID_FICHA=".$ficha." AND FC.ID_CAT_COMBINACION NOT IN (8,10,11,12,13)","FC.ID_CAT_COMBINACION");
    if($rs->RecordCount()>0){
        $select .= "<select class='custom-select' id='cmbtipoc' tabindex='9'><option value='0'></option><optgroup>";
        while(!$rs->EOF){
            $select .= "<option value='".$rs->fields['ID_CAT_COMBINACION']."'>".$rs->fields['COMBINACION']."</option>";
            $rs->MoveNext();
        }
        $select .= "</optgroup></select>";
        echo $select;
    }else echo 0;
}else if($tp == 'otro'){//busca otro tipo de composiciones (2da tabla en pestaña composicion)
    $ficha = $_POST['ficha'];
    $tbl = "";
    $rs = $query->Consultar("FB.ID_COMBINACION, CT.COMBINACION, FB.DESCRIPCION, FB.COMPOSICION","FCOMBINACIONES FB INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FB.ID_CAT_COMBINACION","ID_FICHA=".$ficha." AND FB.ID_CAT_COMBINACION IN (8,10,11,12,13)","");
    if($rs->RecordCount()>0){
        $tbl .= "<table  id='tbl_otro' class='table table-bordered table-hover' style='display: block; font-size: 15px'>";
        $tbl .= "<thead><tr><th>Tipo</th><th>Descripcion</th><th>Composicion</th><th></th></tr></thead><tbody>";
        while(!$rs->EOF){
            $tbl .= "<tr id='row".$rs->fields['ID_COMBINACION']."'><td>".$rs->fields['COMBINACION']."</td><td>".utf8_encode($rs->fields['DESCRIPCION'])."</td><td>".$rs->fields['COMPOSICION']."</td><td><button type='button' name='remove' id='".$rs->fields['ID_COMBINACION']."' class='btn btn-danger btn-xs btn_rmv_otro'>Quitar</button></td></tr>";
            $rs->MoveNext();
        }
        $tbl .= "</tbody></table>";
        echo $tbl;
    }else echo 0;
}else if($tp == 'indicaciones'){
    $ficha = $_POST['ficha'];
	$str = "";
	$rs = $query->Consultar("*","FINDICACIONES","ID_FICHA=".$ficha,"");
	if($rs->RecordCount()>0){
		$id = $rs->fields['ID_INDICACION'];
		$ind = $rs->fields['INDICACION'];
		$ind2 = $rs->fields['INDICACION2'];
		$ind3 = $rs->fields['INDICACION3'];
		$ind4 = $rs->fields['INDICACION4'];
		$ind5 = $rs->fields['INDICACION5'];
		$planchado = $rs->fields['PLANCHADO'];
		echo $id."@".$ind."@".$ind2."@".$ind3."@".$ind4."@".$ind5."@".$planchado;
	}else echo 0;
}else if($tp == 'corrida'){
    $tbl = "";
    $ficha = $_POST['ficha'];
    $rs = $query->Consultar("ID_FICHA,CORRIDA,MODELO","FFICHA","ID_FICHA=".$ficha,"");
    if($rs->RecordCount()>0){//Revisamos si ya tiene ficha registrada
        $rm = $query->Consultar('*','FMEDIDAS','ID_FICHA = '.$rs->fields['ID_FICHA'].' GROUP BY TALLA','ID_MEDIDA');
        if($rm->RecordCount()>0){//Revisamos que tenga medidas registradas
            $tbl.= "<div class='table-responsive'><table id='tbl_med' class='table table-bordered'><thead><tr><th width='3%'><a href='#' id='".$ficha."' onclick='Limpiar_Medidas(".$ficha.")'><i style='color: red' class='fas fa-eraser'></i></a></th><th width='42%'>MEDIDAS</th>";
            $ft = explode('|',$rs->fields['CORRIDA']);//Separamos la corrida por tallas
            while(!$rm->EOF){
                $tbl.= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$rm->fields['TALLA']."</th>";
                $rm->MoveNext();
            }
            $tbl.= "<th align='center' style='align-content: center; text-align: center' width='auto'>TOLERANCIA</th></tr></thead>";
            $tbl.= "<tbody>";

            $r1 = $query->Consultar('ID_MEDIDA, ID_CAT_MED, TOLERANCIA, TALLA','FMEDIDAS','ID_FICHA = '.$rs->fields['ID_FICHA'].' GROUP BY ID_CAT_MED','ID_MEDIDA');//SACAR FILAS
            if($r1->RecordCount()>0){//creamos la tabla con las medidas registradas en la bd
                $chr = 64;//Iniciamos las letras
                $med = 0;
                $pr = "";
                while(!$r1->EOF){
                    $med++;
                    $chr = $chr +1;//Incrementamos una letra para iniciar en A
                    $tbl.= "<tr><td><b>".chr($chr)."</b></td><td>";
                        $rsm = $query->Consultar('*','FCAT_MEDIDA','','DESCRIPCION');//LLENAR SELECT CON MEDIDA
                        $tbl.= "<select style='width: 100%' class='form-control select2' id='med_".$med."'><option value='0'></option>";//Medidas
                        $tbl.= "<optgroup>";
                        while(!$rsm->EOF){
                            $tbl.= "<option value='".$rsm->fields['ID_CAT_MED']."' ".($r1->fields['ID_CAT_MED']==$rsm->fields['ID_CAT_MED']?"selected":"").">".utf8_encode($rsm->fields['DESCRIPCION'])."</option>";
                            $rsm->MoveNext();
                        }
                        $tbl.= "</optgroup>";
                        $tbl.= "</select></td>";
                    $r2 = $query->Consultar("*", 'FMEDIDAS', 'ID_FICHA = '.$rs->fields['ID_FICHA'].' GROUP BY TALLA','ID_MEDIDA');
                    if($r2->RecordCount()>0){
                        $idm1 = "";
                        $idm2 = "";
                        while (!$r2->EOF) {
                            $idm1 .= $r2->fields['ID_MEDIDA']."|";
                            $tbl.= "<td align='center' style='align-content: center'>";
                                $r3 = $query->Consultar('ID_MEDIDA, MEDIDA','FMEDIDAS','ID_CAT_MED = '.$r1->fields['ID_CAT_MED'].' AND TALLA = "'.$r2->fields['TALLA'].'" AND ID_FICHA = '.$rs->fields['ID_FICHA'].' ','');
                                if($r3->RecordCount()>0){
                                    $idm2 .= $r3->fields['ID_MEDIDA']."|";
                                    $pr .= $med."_".$r3->fields['ID_MEDIDA']."|";
                                    while (!$r3->EOF) {
                                        $tbl.= "<input id='m_".$r3->fields['ID_MEDIDA']."' type='text' style='width: 70%' value='".$r3->fields['MEDIDA']."' onkeypress='return Numerico(event)'>";//".($r3->fields['MEDIDA'] == ''?"":"disabled")."//_".$r3->fields['MEDIDA']."
                                    $r3->MoveNext();
                                    }
                                }
                            $tbl.= "</td>";
                        $r2->MoveNext();
                        }
                    }
                    $rsm2 = $query->Consultar("*","FCAT_TOL","","");//LLENAR SELECT CON MEDIDA
                    $tbl.= "<td><select style='width: 100%' class='form-control select2' id='tol_".$med."'><option value='0'></option>";//Medidas//disabled
                    $tbl.= "<optgroup>";
                    while(!$rsm2->EOF){
                        $tbl.= "<option value='".$rsm2->fields['TOLERANCIA']."' ".($r1->fields['TOLERANCIA']==$rsm2->fields['TOLERANCIA']?"selected":"").">".$rsm2->fields['TOLERANCIA']."</option>";
                        $rsm2->MoveNext();
                    }
                    $tbl.= "</optgroup>";
                    $tbl.= "</select></td>";
                    //$tbl.= "<td align='center' style='align-content: center'><input id='tol_".$med."' value='".$r1->fields['TOLERANCIA']."' type='text' style='width: 80%'></td>";// disabled//*/
                    $r1->MoveNext();
                    $tbl.= "</tr>";
                }

               $chr = $chr+1;//sumamos 1 al caracter para imprimir consecutivos, despues del for incrementamos 1 mas
                $med = $med +1;
                for($i=$r1->RecordCount(); $i<=20; $i++){//creamos filas restantes despues de haber creado la tabla con las medidas registradas en la bd -> se construye para registrar nuevas medidas
                    $tbl.= "<tr><td><b>".chr($chr)."</b></td><td>";
                    $rsm = $query->Consultar('*','FCAT_MEDIDA','','DESCRIPCION');
                    $tbl.= "<select style='width: 100%' class='form-control select2' id='md_".$med."'><option value='0'></option>";//Medidas
                    $tbl.= "<optgroup>";
                    while(!$rsm->EOF){
                        $tbl.= "<option value='".$rsm->fields['ID_CAT_MED']."'>".utf8_encode($rsm->fields['DESCRIPCION'])."</option>";
                        $rsm->MoveNext();
                    }
                    $tbl.= "</optgroup>";
                    $tbl.= "</select>";
                    $tbl.="</td>";
                    for($j=0; $j<=$r2->RecordCount()-1; $j++){//creamos las columnas
                        $tbl.= "<td align='center' style='align-content: center'><input type='text' style='width: 70%' id='".$ft[$j]."".$med."' onkeypress='return Numerico(event)'></td>";//Tallas//value='".$ft[$j]."".$med."'
                    }
                    $rsm3 = $query->Consultar("*","FCAT_TOL","","");//LLENAR SELECT CON MEDIDA
                    $tbl.= "<td><select style='width: 100%' class='form-control select2' id='t_".$med."'><option value='0'></option>";//Medidas//disabled
                    $tbl.= "<optgroup>";
                    while(!$rsm3->EOF){
                        $tbl.= "<option value='".$rsm3->fields['TOLERANCIA']."'>".$rsm3->fields['TOLERANCIA']."</option>";
                        $rsm3->MoveNext();
                    }
                    $tbl.= "</optgroup>";
                    $tbl.= "</select></td>";
                    //$tbl.= "<td align='center' style='align-content: center'><input id='t_".$med."' type='text' style='width: 80%'></td>";//Tolerancias// value='".$med."'
                    $tbl.= "</tr>";
                    $chr++;//incrementamos una letra
                    $med++;
                }
            }
            $tbl.= "</tbody>";
            $tbl.= "</table></div>";
            //$idm2 = substr($idm2, strrpos($idm2, '|') - 2);
            //echo $tbl."@".$rs->fields['ID_FICHA']."@1@".$idm."|".$idm2;//ficha registrada con medidas
            //echo $tbl."@".$rs->fields['ID_FICHA']."@1@".$idm1.$idm2;//ficha registrada con medidas
            echo $tbl."@".$rs->fields['ID_FICHA']."@1@".$pr."@".$rs->fields['CORRIDA']."@".$rs->fields['MODELO'];//ficha registrada con medidas
        }else{//se construye la tabla sin medidas -> Registro inicial de medidas
            $tbl.= "<div class='table-responsive'><table class='table table-bordered'><thead><tr><th width='3%'></th><th width='50%'>MEDIDAS</th>";
            $ft = explode('|',$rs->fields['CORRIDA']);//Separamos la corrida por tallas
            for($j=0;$j<count($ft)-1;$j++){//creamos los encabezados
                $tbl.= "<th align='center' style='align-content: center; text-align: center' width='auto'>".$ft[$j]."</th>";
            }
            $tbl.= "<th align='center' style='align-content: center; text-align: center' width='auto'>TOLERANCIA</th></tr></thead><tbody>";
            $chr = 64;
            for($i=1; $i<=21; $i++){//creamos las filas -- Para agregar nuevas medidas se debe incrementar el contador
                $tbl.= "<tr><td><b>".chr($chr+$i)."</b></td><td>";
                    $rsm = $query->Consultar('*','FCAT_MEDIDA','','DESCRIPCION');
                    $tbl.= "<select style='width: 100%' class='form-control select2' id='m".$i."'><option value='0'></option>";//Medidas
                    $tbl.= "<optgroup>";
                    while(!$rsm->EOF){
                        $tbl.= "<option value='".$rsm->fields['ID_CAT_MED']."'>".utf8_encode($rsm->fields['DESCRIPCION'])."</option>";
                        $rsm->MoveNext();
                    }
                    $tbl.= "</optgroup>";
                    $tbl.= "</select>";
                $tbl.="</td>";
                for($j=0;$j<count($ft)-1;$j++){//creamos las columnas
                    $tbl.= "<td align='center' style='align-content: center'><input type='text' style='width: 70%' id='".$ft[$j]."".$i."' onkeypress='return Numerico(event)'></td>";//Tallas//value='".$ft[$j]."".$i."'
                }
                $rsm3 = $query->Consultar("*","FCAT_TOL","","");//LLENAR SELECT CON MEDIDA
                $tbl.= "<td><select style='width: 100%' class='form-control select2' id='t".$i."'><option value='0'></option>";//Medidas//disabled
                $tbl.= "<optgroup>";
                while(!$rsm3->EOF){
                    $tbl.= "<option value='".$rsm3->fields['TOLERANCIA']."'>".$rsm3->fields['TOLERANCIA']."</option>";
                    $rsm3->MoveNext();
                }
                $tbl.= "</optgroup>";
                $tbl.= "</select></td>";
                //$tbl.= "<td align='center' style='align-content: center'><input id='t".$i."' type='text' style='width: 80%'></td>";//Tolerancias//value='t".$i."'
                $tbl.= "</tr>";
            }
            $tbl.= "</tbody></table></div>";
            echo $tbl."@".$rs->fields['CORRIDA']."@2@@@".$rs->fields['MODELO'];//FICHA REGISTRADA SIN MEDIDAS
        }
    }else echo "<h3>Sin resultados.!!</h3>";//SIN FICHA
}else if($tp == 'proveedor'){
    $icod = $_POST['icod'];
    $nm = $_POST['nm'];
    $select = "";
    $campos = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' GROUP BY FP.PRVCOD";#AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $tp = $nm*2;
    for($i=$tp-1; $i<=$tp; $i++){
        $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
        $select.= "<select style='width: 100%' class='form-control' id='cmbproveedor".$i."' name='ncmbproveedor".$i."' onchange='Buscar_Factura(".$i.",".$nm.")' tabindex='4'><option value='0'></option><optgroup>";
        while(!$rs->EOF){
            $select.= "<option value='".$rs->fields['PRVCOD']."'>".$rs->fields['PRVCOD']."</option>";
            $rs->MoveNext();
        }
        $select.= "</optgroup></select>@".$i."@";
    }
    echo $select;
}else if($tp == 'factura'){
    $nm = $_POST['nm'];
    $icod = $_POST['icod'];
    $prv = $_POST['prv'];
    $campos = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' AND PRVCOD LIKE '".$prv."'";// AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
    echo "<select style='width: 100%' class='form-control' id='cmbfactura".$nm."' name='ncmbfactura".$nm."' tabindex='4'><option value='0'></option>";//id='cmbfactura'".$nm." name='ncmbfactura'".$nm."
    echo "<optgroup>";
    while(!$rs->EOF){
        echo "<option value='".$rs->fields['DNUM']."'>".$rs->fields['DNUM']."</option>";
        $rs->MoveNext();
    }
    echo "</optgroup>";
    echo "</select>";
}else if($tp == 'combinacion'){
    $id = $_POST['ficha'];
    $tbl = "";
    $rm = $query->Consultar("FC.ID_COMBINACION, FC.ID_FICHA, FC.ID_CAT_COMBINACION, CT.COMBINACION, FC.ICOD, FC.DESCRIPCION, FC.STATUS","FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION","FC.ID_FICHA =".$id." AND FC.ID_CAT_COMBINACION NOT IN (8,10)","ID_CAT_COMBINACION");
    if($rm->RecordCount()>0){
        $tbl .= "<table  id='mytable' class='table table-bordered table-hover' style='display: block; font-size: 13px'><thead>";
        $tbl .= "<tr><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th><th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th></th><th></th></tr></thead><tbody>";
        $color = "";
        while(!$rm->EOF){
            $comb = $rm->fields['ID_COMBINACION'];
            //$descr = ($rm->fields['ID_CAT_COMBINACION']=='7'?$rm->fields['DESCRIPCION']:$rm->fields['ICOD']."_".$rm->fields['DESCRIPCION']);*/
            $tbl .= "<tr id='row".$comb."'><td>".$rm->fields['COMBINACION']."</td>";//<td>".$descr."</td>
            $rv = $query->Consultar("*","FVARIANTES","ID_COMBINACION =".$comb,"");
            if($rv->RecordCount()>0){
                $str = "";
                $idc = "";
                while(!$rv->EOF){
                    $idc .= $rv->fields['ID_VARIANTE']."|";
                    $str .= $rv->fields['ICOD']."_".$rv->fields['IDESCR']."@".$rv->fields['COLOR']."@".$rv->fields['PRV_FACT']."|";
                    $tbl .= "<td>".$rv->fields['ICOD']."_".$rv->fields['IDESCR']."@".$rv->fields['COLOR']."@".$rv->fields['PRV_FACT']."</td>";
                    //$tbl .= "<td>".($rm->fields['ID_CAT_COMBINACION']=='7'?$rv->fields['COLOR']:$rv->fields['COLOR']."@".$rv->fields['PRV_FACT'])."</td>";
                    //$tbl .= "<td>".($rm->fields['ID_CAT_COMBINACION']=='7'?$rm->fields['DESCRIPCION']."/".$rv->fields['COLOR']:($rm->fields['ID_CAT_COMBINACION']=='9'?$rm->fields['DESCRIPCION']."/".$rv->fields['ICOD']."_".$rv->fields['IDESCR']."@".$rv->fields['COLOR']."@".$rv->fields['PRV_FACT']:$rv->fields['ICOD']."_".$rv->fields['IDESCR']."@".$rv->fields['COLOR']."@".$rv->fields['PRV_FACT']))."</td>";
                $rv->MoveNext();
                }
                for($i=$rv->RecordCount(); $i<5; $i++){
                    $tbl .= "<td></td>";
                }
            }
            $idc = trim($idc,'|');
            $tbl .= "<td><button type='button' id='edit_".$comb."' onclick=\"Cargar_Combinacion(".$comb.",".$rm->fields['ID_CAT_COMBINACION'].",'".$str."','".$idc."')\" class='btn btn-success btn-xs'>Editar</button></td>";
            $tbl .= "<td><button type='button' name='remove' id='".$comb."' class='btn btn-danger btn-xs btn_remove'>Quitar</button></td></tr>";
            $rm->MoveNext();
        }
        $tbl .= "</tbody></table>";
        echo $tbl;
    }else echo 0;
}else if($tp == 'Buscar_Prv'){
    $icod = $_POST['icod'];
    $a = $_POST['a'];//1er proveedor
    $b = $_POST['b'];//2do proveedor
    $prv = explode('|',$_POST['prv']);
    $nm = $_POST['nm'];
    $select = "";
    $campos = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' GROUP BY FP.PRVCOD";#AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
    $select.= "<select style='width: 100%' class='form-control' id='cmbproveedorn".$a."' name='ncmbproveedorn".$a."' onchange='Buscar_FacturaN(".$a.",".$nm.")' tabindex='4'><option value='0'></option><optgroup>";
    while(!$rs->EOF){
        $select.= "<option value='".$rs->fields['PRVCOD']."' ".($prv[0]==$rs->fields['PRVCOD']?"selected":"").">".$rs->fields['PRVCOD']."</option>";
        $rs->MoveNext();
    }
    $select.= "</optgroup></select>@";
    $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
    $select.= "<select style='width: 100%' class='form-control' id='cmbproveedorn".$b."' name='ncmbproveedorn".$b."' onchange='Buscar_FacturaN(".$b.",".$nm.")' tabindex='4'><option value='0'></option><optgroup>";
    while(!$rs->EOF){
        $select.= "<option value='".$rs->fields['PRVCOD']."' ".($prv[1]==$rs->fields['PRVCOD']?"selected":"").">".$rs->fields['PRVCOD']."</option>";
        $rs->MoveNext();
    }
    $select.= "</optgroup></select>";
    echo $select;
}else if($tp == 'Buscar_Ft'){
    $nm = $_POST['nm'];
    $icod = $_POST['icod'];
    $prv1 = $_POST['prv1'];
    $prv2 = $_POST['prv2'];
    $a = $_POST['a'];//factura 1
    $b = $_POST['b'];//factura 2
    $ft = explode('|',$_POST['ft']);//string de facturas
    //echo 'nm='.$nm." icod=".$icod." prv1=".$prv1." prv2=".$prv2." a=".$a." b=".$b." ft=".$ft;
    $select = "";
    $campos = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' AND PRVCOD LIKE '".$prv1."'";// AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
    $select .= "<select style='width: 100%' class='form-control' id='cmbfacturan".$a."' name='ncmbfacturan".$a."' tabindex='4'><option value='0'></option>";//id='cmbfactura'".$nm." name='ncmbfactura'".$nm."
    $select .= "<optgroup>";
    while(!$rs->EOF){
        $select .= "<option value='".$rs->fields['DNUM']."' ".($ft[0]==$rs->fields['DNUM']?"selected":"").">".$rs->fields['DNUM']."</option>";
        $rs->MoveNext();
    }
    $select .= "</optgroup>";
    $select .= "</select>@";
    $campos1 = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas1 = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios1 = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' AND PRVCOD LIKE '".$prv2."'";// AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $rt = $query->Consultar_Proscai($campos1,$tablas1,$criterios1,"");
    $select .= "<select style='width: 100%' class='form-control' id='cmbfacturan".$b."' name='ncmbfacturan".$b."' tabindex='4'><option value='0'></option>";//id='cmbfactura'".$nm." name='ncmbfactura'".$nm."
    $select .= "<optgroup>";
    while(!$rt->EOF){
        $select .= "<option value='".$rt->fields['DNUM']."' ".($ft[1]==$rt->fields['DNUM']?"selected":"").">".$rt->fields['DNUM']."</option>";
        $rt->MoveNext();
    }
    $select .= "</optgroup>";
    $select .= "</select>";
    echo $select;
}else if($tp == 'PrvN'){
    $icod = $_POST['icod'];
    $nm = $_POST['nm'];
    $select = "";
    $campos = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' GROUP BY FP.PRVCOD";#AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $tp = $nm*2;
    for($i=$tp-1; $i<=$tp; $i++){
        $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
        $select.= "<select style='width: 100%' class='form-control' id='cmbproveedorn".$i."' name='ncmbproveedorn".$i."' onchange='Buscar_FacturaN(".$i.",".$nm.")'><option value='0'></option><optgroup>";
        while(!$rs->EOF){
            $select.= "<option value='".$rs->fields['PRVCOD']."'>".$rs->fields['PRVCOD']."</option>";
            $rs->MoveNext();
        }
        $select.= "</optgroup></select>@".$i."@";
    }
    echo $select;
}else if($tp == 'factN'){
    $nm = $_POST['nm'];
    $icod = $_POST['icod'];
    $prv = $_POST['prv'];
    $campos = "FP.PRVCOD, FP.PRVNOM, FI.ICOD, AITIPMV, DNUM, DFECHA";
    $tablas = "FDOC F INNER JOIN FPRV FP ON FP.PRVSEQ = F.PRVSEQ INNER JOIN FAXINV FA ON FA.DSEQ = F.DSEQ INNER JOIN FINV FI ON FI.ISEQ = FA.ISEQ";
    $criterios = "FI.ICOD LIKE '".$icod."' AND F.DNUM LIKE 'R%' AND PRVCOD LIKE '".$prv."'";// AND F.DFECHA >= DATE(DATE_ADD(NOW(), INTERVAL - 1000 DAY))
    $rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
    echo "<select style='width: 100%' class='form-control' id='cmbfacturan".$nm."' name='ncmbfacturan".$nm."' tabindex='4'><option value='0'></option>";//id='cmbfactura'".$nm." name='ncmbfactura'".$nm."
    echo "<optgroup>";
    while(!$rs->EOF){
        echo "<option value='".$rs->fields['DNUM']."'>".$rs->fields['DNUM']."</option>";
        $rs->MoveNext();
    }
    echo "</optgroup>";
    echo "</select>";
}else if($tp == 'Consultar_Comb'){
    $id = $_POST['ficha'];
    $tbl = "";
    $rm = $query->Consultar("CB.ID_COMBINACION, CB.ID_CAT_COMBINACION, CT.CORTA","FCOMBINACIONES CB INNER JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = CB.ID_CAT_COMBINACION","CB.ID_FICHA =".$id." AND CB.ID_CAT_COMBINACION NOT IN (8,10,11,12,13)","CB.ID_COMBINACION");
    if($rm->RecordCount()>0){
        $tbl .= "<div class='table-responsive'><table  id='mytable' class='table table-bordered table-hover' style='display: block; font-size: 13px'><thead>";
        $tbl .= "<tr><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th><th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th>VARIANTE 6</th><th>VARIANTE 7</th><th>VARIANTE 8</th><th>VARIANTE 9</th><th></th><th></th></tr></thead><tbody>";
        $color = "";
        while(!$rm->EOF){
            $tipo = $rm->fields['ID_CAT_COMBINACION'];
            $comb = $rm->fields['ID_COMBINACION'];
            $tbl .= "<tr id='row".$comb."'><td>".$rm->fields['CORTA']."</td>";//<td>".$descr."</td>
            $rv = $query->Consultar("*","FVARIANTES","ID_COMBINACION =".$comb,"");
            if($rv->RecordCount()>0){
                $tela = "";
                while(!$rv->EOF){
                    $tela = $rv->fields['ICOD']."_".$rv->fields['IDESCR']."@".$rv->fields['PRV_FACT']."|";
                    if($rv->fields['ICOD2'] != '')
                        $tela .= $rv->fields['ICOD2']."_".$rv->fields['IDESCR2']."@".$rv->fields['PRV_FACT2'];
                    $tbl .= "<td><a href='#' onclick=\"Editar_Variante(".$rv->fields['ID_VARIANTE'].", ".$tipo.",".$rv->fields['VARIANTE'].",'".$rv->fields['COLOR']."','".$tela."');\"><i style='color: green' class='fas fa-edit'></i></a>";
                    $tbl .= "    <a href='#' id='".$rv->fields['ID_VARIANTE']."' onclick=\"Eliminar_Variante(".$rv->fields['ID_VARIANTE'].", ".$rv->fields['VARIANTE'].", ".$rm->fields['ID_COMBINACION'].");\"><i style='color: red' class='fas fa-times'></i></a>";
                    $tbl .= "    ".$rv->fields['ICOD']."_".$rv->fields['IDESCR']."@".$rv->fields['COLOR']."@".$rv->fields['PRV_FACT']."</td>";
                    $rv->MoveNext();
                }
                for($i=$rv->RecordCount(); $i<9; $i++){
                    $tbl .= "<td></td>";
                }
            }
            $tbl .= "<td><button type='button' id='btn_modal_var_".$comb."' onclick=\"Modal_Variante(".$comb.",".$tipo.",".$rv->RecordCount().")\" class='btn btn-primary btn-xs'>Agregar</button></td>";
            $tbl .= "<td><button type='button' name='remove' id='".$comb."' class='btn btn-danger btn-xs btn_remove'>Quitar</button></td></tr>";
            $rm->MoveNext();
        }
        $tbl .= "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><button type='button' id='btn_modal_var_".$comb."' onclick='Modal_Variante()' class='btn btn-primary btn-xs'>Agregar</button></td><td></td></tr>";
        $tbl .= "</tbody></table></div>";
        echo $tbl;
    }else echo 0;
}else if($tp == 'consultar_laboratorio'){//Funciones Laboratorio
    $id_f=$_POST['id_ficha'];
    $id_var=$_POST['id_var'];
    $id_comb=$_POST['id_comb'];
    $tela = $_POST['tela'];
    $rs=$query->Consultar("*","FLABORATORIO","ID_FICHA = ".$id_f." AND ID_COMBINACION = ".$id_comb." AND ID_VARIANTE=".$id_var,"");
    if($rs->RecordCount()>0){
        if($tela == '1'){
            $com1 = $rs->fields['COMP1'];
            $com2 = $rs->fields['COMP2'];
            $com3 = $rs->fields['COMP3'];
        }else{
            $com1 = $rs->fields['COMP4'];
            $com2 = $rs->fields['COMP5'];
            $com3 = $rs->fields['COMP6'];
        }
        echo $com1."@".$com2."@".$com3;
    }else echo 0;
}else if($tp == 'laboratorio'){
    $ficha = $_POST['ficha'];
    $tbl = "";
    $rm = $query->Consultar("CB.ID_COMBINACION, CB.ID_CAT_COMBINACION, CT.CORTA,MAX(FV.VARIANTE)AS NUM, FV.COLOR","FCOMBINACIONES CB LEFT JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = CB.ID_CAT_COMBINACION LEFT JOIN FVARIANTES FV ON FV.ID_COMBINACION=CB.ID_COMBINACION","CB.ID_FICHA =".$ficha." AND CB.ID_CAT_COMBINACION NOT IN (8,11,12,13) GROUP BY CB.ID_COMBINACION","");
    if($rm->RecordCount()>0){
        $comb = $rm->fields['ID_COMBINACION'];
        $cont=$rm->fields['NUM'];
        $comb = $rm->fields['ID_COMBINACION'];
        $rj=$query->Consultar("*","FVARIANTES","ID_COMBINACION=".$comb."","");
        $tbl .= "<div class='table-responsive'><table  id='mytable' class='table table-bordered table-hover' style='display: block; font-size: 13px'><thead>";
        $tbl .= "<tr><th></th><th colspan='8'>Variantes</th></tr><tr><th>Tipo</th>";
        $i=1;
        while(!$rj->EOF){
            $tbl .= "<th>V".$rj->fields['VARIANTE']." ".$rj->fields['COLOR']."</th>";
            $i=$i+1;
            $rj->MoveNext();
        }
        $tbl .="</tr></thead><tbody>";
        $color = "";
        while(!$rm->EOF){
            $tipo = $rm->fields['ID_CAT_COMBINACION'];
            $comb1 = $rm->fields['ID_COMBINACION'];
            $tbl .= "<tr id='row".$tipo."'><td>".$rm->fields['CORTA']."</td>";
            //<td>".$descr."</td>
            $rv = $query->Consultar("*","FVARIANTES","ID_COMBINACION =".$comb1,"");
            if($rv->RecordCount()>0){
                $tela = "";
                while(!$rv->EOF){
                    $vari=$rv->fields['ID_VARIANTE'];
                    $icod=$rv->fields['ICOD'];
                    $icod2=$rv->fields['ICOD2'];
                    $corta=$rm->fields['CORTA'];
                    $color=$rv->fields['COLOR'];
                    if($rv->fields['ICOD2'] != ''){
                        $tela .= $rv->fields['ICOD2']."_".$rv->fields['IDESCR2']."@".$rv->fields['PRV_FACT2'];
                    }
                        if($rv->fields['ICOD2']){
                            $tbl.="<td>";
                            $tbl.=$rv->fields['ICOD']." "."<a href='#' id='btn_modal_lab".$rv->fields['ID_VARIANTE']."' onclick=\"Modal_Lab(".$comb1.",".$vari.",'".$icod."','".$corta."','".$color."',1)\"><i class='fas fa-file-signature fa-1x'></i></a><br>";
                            $tbl.=$rv->fields['ICOD2']." "."<a href='#' id='btn_modal_lab".$rv->fields['ID_VARIANTE']."' onclick=\"Modal_Lab(".$comb1.",".$vari.",'".$icod2."','".$corta."','".$color."',2)\"><i class='fas fa-file-signature fa-1x'></i></a><br>";
                            $tbl.="</td>";
                        }else{
                            $tbl.="<td>";
                            $tbl.=$rv->fields['ICOD']." "."<a href='#' id='btn_modal_lab".$rv->fields['ID_VARIANTE']."' onclick=\"Modal_Lab(".$comb1.",".$vari.",'".$icod."','".$corta."','".$color."',1)\"><i class='fas fa-file-signature fa-1x'></i></a><br>";
                            $tbl.="</td>";
                        
                        }
                        $tbl.="</td>";
                    $rv->MoveNext();
                }
            }
            $rm->MoveNext();
        }
        $tbl .= "</tbody></table></div>";
        echo $tbl;
    }else echo 0;
}
?>