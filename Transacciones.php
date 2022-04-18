<?php
include_once('funciones.php');
include_once('registro.php');
$query = new Registro();

$acc = $_POST['accion'];

if($acc == 'Registrar_Modelo' || $acc == 'Modificar_Modelo') {
    $ficha = $_POST['ficha'];
    $cte = $_POST['ncmbcliente'];
    $marca = $_POST['ncmbmarca'];
    $lin = $_POST['ncmblinea'];
    $pren = $_POST['ncmbprenda'];
    $ord = Limpiar_Cadena($_POST['norden']);
    $mod = $_POST['nmodelo'];
    $ped = $_POST['npedido'];
    $sem = $_POST['nsemana'];
    $temp = Limpiar_Cadena($_POST['ntemporada']);
    $talla = $_POST['ncmbtalla'];
    $corrida = $_POST['corrida'];
    $dis = $_POST['ncmbdisenadora'];
    $pat = $_POST['ncmbpatronista'];
    $mues = $_POST['ncmbmuestrista'];
    $grad = $_POST['ncmbgraduadora'];
    $desc = strtoupper($_POST['ndescripcion']);
    $igual = Limpiar_Cadena($_POST['nigual']);
    //$modcte = Limpiar_Cadena($_POST['nmodcliente']);
    $foto = $_POST['foto'];
    $cant = $_POST['ncantidad'];

    if($acc == 'Registrar_Modelo'){
    	$r1 = $query->Consultar("*","FFICHA","PEDIDO = '".$ped."' ","");
	        if($r1->RecordCount()>0){//existe la foto -> enviar solo resultado de Modificar_Modelo
	            echo "Existe|".$r1->fields['ORDEN'];
	        }else{
	           $rs = $query->Registrar_Modelo($cte, $marca, $lin, $pren, $talla, $ord, $mod, $ped, $sem, $temp, $corrida, $dis, $pat, $mues, $grad, $desc, $igual, $cant);
	            if ($rs > 0) {
	                if($foto == '1'){//Hacer insert en FFOTO
	                    $rf = $query->Registrar_Foto($rs,$mod);
	                    if ($rf > 0) {
	                        echo $rs;
	                    }else{
	                        echo "Error";
	                    }
	                }else{//Enviar solo el resultado del insert del modelo
	                    echo $rs;
	                }
	            }else
	                echo "Error";
        }
        /*$r1 = $query->Consultar("*","FFICHA","PEDIDO = '".$ped."' ","");
        if($r1->RecordCount()>0){//existe la foto -> enviar solo resultado de Modificar_Modelo
            echo "Existe|".$r1->fields['ORDEN'];
        }else{
           $rs = $query->Registrar_Modelo($cte, $marca, $lin, $pren, $talla, $ord, $mod, $ped, $sem, $temp, $corrida, $dis, $pat, $mues, $grad, $desc, $igual, $cant);
            if ($rs > 0) {
                if($foto == '1'){//Hacer insert en FFOTO
                    $rf = $query->Registrar_Foto($rs,$mod);
                    if ($rf > 0) {
                        echo $rs;
                    }else{
                        echo "Error";
                    }
                }else{//Enviar solo el resultado del insert del modelo
                    echo $rs;
                }
            }else
                echo "Error";
        }*/
    }else{
        $rs = $query->Modificar_Modelo($ord, $ficha, $cte, $marca, $lin, $pren, $temp, $talla, $dis, $pat, $mues, $grad, $igual, $cant, $desc);
        if ($rs > 0) {
            if($foto == '1'){
                $rf = $query->Consultar("*","FFOTO","ID_FICHA=".$ficha,"");
                if($rf->RecordCount()>0){//existe la foto -> enviar solo resultado de Modificar_Modelo
                    echo $rs;
                }else{
                    $r0 = $query->Registrar_Foto($ficha,$mod);
                    if ($r0 > 0) {
                        echo $rs;
                    }else{
                        echo "Error";
                    }
                }
            }else{
                echo $rs;
            }
        }else
            echo "Error";
    }
}else if($acc == 'Registrar_Laboratorio'){//Funciones laboratorio
    $id_ficha = $_POST['id_ficha'];//id de la ficha
    $id_comb = $_POST['ncomb'];//id de la combinacion
    $id_variante = $_POST['nvar'];//id de la variante
    $ntela = $_POST['ntela'];//tela 1 o 2
    $comp1 = $_POST['nporcentaje1']."|".$_POST['ncmbcomposicion1'];

    if($_POST['nporcentaje2']){
        $comp2=$_POST['nporcentaje2']."|".$_POST['ncmbcomposicion2'];
    }else{
        $comp2="";
    }
    if($_POST['nporcentaje3']){
        $comp3=$_POST['nporcentaje3']."|".$_POST['ncmbcomposicion3'];
    }else{
        $comp3="";
    }
    $rt = $query->Consultar("*","FLABORATORIO","ID_FICHA=".$id_ficha." AND ID_COMBINACION = ".$id_comb." AND ID_VARIANTE=".$id_variante,"");
    $id_lab = $rt->fields['ID_LABORATORIO'];
    if($rt->fields['ID_LABORATORIO']){
        $rs = $query->Update_Lab($id_lab,$comp1,$comp2,$comp3,$ntela);
    }else{
        $rs = $query->Registrar_Lab($id_ficha,$id_variante,$id_comb,$comp1,$comp2,$comp3,$ntela);
    }

    if($rs != 0){
        echo 1;
    }else{
        echo 0;
    }
}else if($acc == 'Duplicar_Modelo') {
    $ficha = $_POST['ficha'];
    $cte = $_POST['ncmbcliente'];
    $marca = $_POST['ncmbmarca'];
    $lin = $_POST['ncmblinea'];
    $pren = $_POST['ncmbprenda'];
    $ord = Limpiar_Cadena($_POST['norden']);
    //$mod = $_POST['nmodelo'];
    $temp = Limpiar_Cadena($_POST['ntemporada']);
    $talla = $_POST['ncmbtalla'];
    $dis = $_POST['ncmbdisenadora'];
    $pat = $_POST['ncmbpatronista'];
    $mues = $_POST['ncmbmuestrista'];
    $grad = $_POST['ncmbgraduadora'];
    $igual = Limpiar_Cadena($_POST['nigual']);
    $foto = $_POST['foto'];
    //$ped = Limpiar_Cadena($_POST['npedido']);
    //$sem = $_POST['nsemana'];
    //$corrida = $_POST['corrida'];
    //$desc = strtoupper($_POST['ndescripcion']);
    //$cant = $_POST['ncantidad'];

    $r1 = $query->Consultar("*","FFICHA","ORDEN='".$ord."'","");
    if($r1->RecordCount()>0){//existe la orden
        echo "Existe";
    }else{
        $campos = "FP.PENUM, FP.PENUMELLOS, FP.PEPZAS, SUBSTRING(FI.ICOD,1,7) AS MODELO, FI.ICOD, SUBSTRING(FI.ICOD, 11,3) AS TALLAS, FC.COML5, FC.COMCAJA";
        $tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ INNER JOIN FCOMENT FC ON FC.COMSEQFACT = FP.PESEQ + 1000000000";
        $rp = $query->Consultar_Proscai($campos,$tablas,"FP.PENUMELLOS LIKE '".$ord."' GROUP BY TALLAS","FL.PLSEQ");
        if($rp->RecordCount()>0){
            $corrida = "";
            $id_ficha = $rp->fields['ID_FICHA'];
            $ped = $rp->fields['PENUM'];
            $sem = $rp->fields['COMCAJA'];
            $desc = utf8_encode($rp->fields['COML5']);
            $cant = intval($rp->fields['PEPZAS']);
            $mod = $rp->fields['MODELO'];
            while(!$rp->EOF){
                $corrida.= $rp->fields['TALLAS']."|";
                $rp->MoveNext();
            }
            $rs = $query->Registrar_Modelo($cte, $marca, $lin, $pren, $talla, $ord, $mod, $ped, $sem, $temp, $corrida, $dis, $pat, $mues, $grad, $desc, $igual, $cant);//REGISTRO DE LOS DATOS DEL MODELO EN LA TABLA FFICHA
            if($rs>0){
                $rf = $query->Registrar_Foto($rs,$mod);//REGISTRAMOS LA FOTO DE LA NUEVA FICHA
                /*REGISTRO DE COMBINACIONES, VARIANTES Y COMPOSICIONES*/
                $r5 = $query->Consultar("*","FCOMBINACIONES","ID_FICHA=".$ficha,"");//Consultar combinaciones
                if($r5->RecordCount()>0){
                    while(!$r5->EOF){
                        $rc = $query->Registrar_Combinacion($rs, $r5->fields['ID_CAT_COMBINACION'], $r5->fields['DESCRIPCION'], $r5->fields['COMPOSICION']);//Registrar combinaciones
                        $r6 = $query->Consultar("*","FVARIANTES","ID_COMBINACION=".$r5->fields['ID_COMBINACION'],"");//Consultar variantes
                        if($r6->RecordCount()>0) {
                            while (!$r6->EOF) {//Registrar todas las variantes de cada combinacion
                                $rt = $query->Registrar_VarianteN($rc, $r6->fields['VARIANTE'], $r6->fields['COLOR'], $r6->fields['ICOD'], $r6->fields['IDESCR'], $r6->fields['COMPOSICION'], $r6->fields['PRV_FACT'], $r6->fields['ICOD2'], $r6->fields['IDESCR2'], $r6->fields['COMPOSICION2'], $r6->fields['PRV_FACT2']);
                                $r6->MoveNext();
                            }
                        }
                        $r7 = $query->Consultar("*","FCOMPOSICIONES","ID_COMBINACION=".$r5->fields['ID_COMBINACION'],"");//Consultar descripciones de las combinaciones
                        if($r7->RecordCount()>0) {
                            while (!$r7->EOF) {//Registrar todas las descripciones de las combinaciones
                                $rm = $query->Registrar_Composicion($rc,$r7->fields['DESCRIPCION']);
                                $r7->MoveNext();
                            }
                        }
                        $r5->MoveNext();
                    }
                }
                /*REGISTRO DE HABILITACIONES, HABIL POR TALLA Y HABIL POR VARIANTE*/
                $r8 = $query->Consultar("*","FHABILITACION","ID_FICHA=".$ficha,"");//Consultar HABILITACIONES
                if($r8->RecordCount()>0){
                    while(!$r8->EOF){
                        $rh = $query->Registrar_Habilitacion($rs,$r8->fields['ICOD'],$r8->fields['DESCRIPCION']);
                        $ft = explode('|', $corrida);
                        for($i=0; $i<=count($ft)-2; $i++){
                            $r9 = $query->Consultar("*","FHABIL_TALLAS","ID_HABIL=".$r8->fields['ID_HABILITACION']." AND TALLA = '".$ft[$i]."'" ,"");//Consultar HABILITACION POR TALLA
                            if($r9->RecordCount()>0) {
                                while (!$r9->EOF) {
                                    $rt = $query->Registrar_HabilTalla($rh, $r9->fields['TALLA'],$r9->fields['HABIL']);//Registro de habilitaciones encontradas
                                    $r9->MoveNext();
                                }
                            }else{
                                $rt = $query->Registrar_HabilTalla($rh, $ft[$i], '');//Registro de habilitaciones no encontradas
                            }
                        }
                        //$cor = trim(str_replace('|',',',$corrida),',');//XL,1X,2X,3X
                        /*$r9 = $query->Consultar("*","FHABIL_TALLAS","ID_HABIL=".$r8->fields['ID_HABILITACION'],"");//Consultar HABILITACION POR TALLA
                        if($r9->RecordCount()>0) {
                            while (!$r9->EOF) {
                                $rt = $query->Registrar_HabilTalla($rh, $r9->fields['TALLA'],$r9->fields['HABIL']);
                            $r9->MoveNext();
                            }
                        }*/
                        $r10 = $query->Consultar("*","FHABIL_VARIANTE","ID_HABIL=".$r8->fields['ID_HABILITACION'],"");//Consultar HABILITACION para ingresar habilitaciones por variantes
                        if($r10->RecordCount()>0) {
                            while (!$r10->EOF) {
                                $rv = $query->Registrar_HabilVariante($rh, $r10->fields['VARIANTE'],$r10->fields['HABIL']);
                            $r10->MoveNext();
                            }
                        }
                        $r8->MoveNext();
                    }
                }

                /*CONSULTA DE LAS PIEZAS A DUPLICAR Y REGISTRO DE LAS MISMAS PARA LA FICHA NUEVA*/
                $r2 = $query->Consultar("*","FPIEZAS","ID_FICHA=".$ficha,"ID_PIEZA");//CONSULTAR PIEZAS
                if($r2->RecordCount()>0){
                    while(!$r2->EOF){
                        $rp = $query->Registrar_Piezas($rs, $r2->fields['ID_CAT_COMBINACION'], $r2->fields['DESCRIPCION'], $r2->fields['CANTIDAD']);//INSERT EN TABLA FPIEZAS
                        $r2->MoveNext();
                    }
                }
                /*CONSULTA DE LAS INDICACIONES A DUPLICAR Y REGISTRO DE LAS MISMAS PARA LA FICHA NUEVA*/
                $r3 = $query->Consultar("*","FINDICACIONES","ID_FICHA=".$ficha,"");//Consultar indicaciones
                if($r3->RecordCount()>0){
                    $ri = $query->Registrar_Indicacion($rs, $r3->fields['INDICACION'], $r3->fields['INDICACION2'], $r3->fields['INDICACION3'], $r3->fields['INDICACION4'], $r3->fields['INDICACION5']);//Registrar indicaciones
                }
                /*RECORREMOS LA CORRIDA DE LA NUEVA ORDEN*/
                $ft = explode('|', $corrida);
                for($i=0; $i<=count($ft)-2; $i++){
                    $r4 = $query->Consultar("*","FMEDIDAS","ID_FICHA=".$ficha." AND TALLA = '".$ft[$i]."'","");//CONSULTAMOS LAS MEDIDAS EXISTENTES EN LA ORDEN ANTERIOR CON LA TALLA DE LA NUEVA ORDEN PARA REGISTRAR SOLO LAS TALLAS EXISTENTES EN LA ORDEN NUEVA
                    if($r4->RecordCount()>0){
                        while(!$r4->EOF){
                            $rm = $query->Registrar_Medida($rs,$r4->fields['ID_CAT_MED'],$r4->fields['TALLA'],$r4->fields['MEDIDA'],$r4->fields['TOLERANCIA']);//Registrar medidas encontradas en la orden anterior
                        $r4->MoveNext();
                        }
                    }else{//Consultamos las medidas anteriores y agrupamos para registrar en la nueva medida
                        $new = $query->Consultar("FF.ID_FICHA, FF.ORDEN, FM.*"," FFICHA FF INNER JOIN FMEDIDAS FM ON FM.ID_FICHA = FF.ID_FICHA","FF.ID_FICHA = ".$ficha." GROUP BY FM.ID_CAT_MED","FM.ID_MEDIDA");
                        if($new->RecordCount()>0){
                            while(!$new->EOF){
                                $rm = $query->Registrar_Medida($rs,$new->fields['ID_CAT_MED'],$ft[$i],'',$new->fields['TOLERANCIA']);//Registrar medidas nuevas NO ENCONTRADAS EN LA ORDEN ANTERIOR
                            $new->MoveNext();
                            }
                        }
                    }

                }
                echo "Exito";
            }else
                echo "Error";
        }else{
            echo "No_Proscai";
        }
    }
}else if($acc == 'Ingresar_CombN' || $acc == 'Modificar_CombN'){
    $ficha = $_POST['ficha'];//id de la ficha
    $tipo = $_POST['tipo'];//tipo de combinacion
    $var = $_POST['var'];//variante
    $color = $_POST['color'];
    $tela1 = $_POST['tela1'];//string tela1
    $tela2 = $_POST['tela2'];//string tela2
    $comb = $_POST['comb'];//id de la combinacion -> Agregar solo variante
    $idvar = $_POST['idvar'];
    if($acc == 'Ingresar_CombN'){
        if($comb == '')
            $rs = $query->Registrar_Combinacion($ficha, $tipo, '', '');

        $tela1 = explode('|', $tela1);
        $icod = explode('_', $tela1[0]);//Separamos icod y descripcion
        if($tela2 != ''){
            $tela2 = explode('|', $tela2);
            $icod2 = explode('_', $tela2[0]);//Separamos icod y descripcion
        }
        if($icod[0]!=''){
            $rc = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod[0]."'","");
            $compos = $rc->fields['ICOMPOS'];
        }else
            $compos = '';

        $rt = $query->Registrar_VarianteN(($comb != ''?$comb:$rs), $var, $color, $icod[0], $icod[1], $compos, $tela1[1], $icod2[0], $icod2[1], '', $tela2[1]);
        if($rt>0){
            $r2 = $query->Consultar("*","FHABILITACION FH INNER JOIN FHABIL_VARIANTE FV ON FV.ID_HABIL = FH.ID_HABILITACION","FH.ID_FICHA = ".$ficha." AND FV.VARIANTE =  '".$var."' GROUP BY VARIANTE","");
            if(!$r2->RecordCount()>0){
                $rh = $query->Consultar("*","FHABILITACION","ID_FICHA =".$ficha,"");//validamos si ya tiene registradas habilitaciones
                if($rh->RecordCount()>0){
                    while(!$rh->EOF){
                        $rv = $query->Registrar_HabilVariante($rh->fields['ID_HABILITACION'], $var, $rh->fields['ICOD']);
                        $rh->MoveNext();
                    }
                }
            }
            echo 1;
        }else echo "Error";
    }else{
        $tela1 = explode('|', $tela1);
        $icod = explode('_', $tela1[0]);//Separamos icod y descripcion
        if($tela2 != ''){
            $tela2 = explode('|', $tela2);
            $icod2 = explode('_', $tela2[0]);//Separamos icod y descripcion
        }
        if($icod[0]!=''){
            $rc = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod[0]."'","");
            $compos = $rc->fields['ICOMPOS'];
        }else
            $compos = '';
        $rt = $query->Modificar_VarianteN($idvar, $color, $icod[0], $icod[1], $compos, $tela1[1], $icod2[0], $icod2[1], '', $tela2[1]);
        if($rt>0){
            echo 1;
        }else echo "Error";
    }
}else if($acc == 'Ingresar_Otro'){// || $acc == 'Modificar_Otro'
    $id = $_POST['id'];
    $comp = $_POST['otro'];
    $str = $_POST['str'];

    $ft = explode('_',$str);
    for($i=0; $i<=count($ft)-2; $i++){
        $fin = explode('|',$ft[$i]);
        //$comb = explode('@', $fin[2]);
        $rs = $query->Registrar_Combinacion($id, $fin[0], $fin[2], $fin[3]);
        if($rs>0){
            echo 1;
        }else{
            echo 'Error';
        }
    }

    /*if($acc == 'Ingresar_Otro'){
        $ft = explode('|', $comp);
        for($i=0; $i<=count($ft)-2; $i++){
            $fin = explode('@',$ft[$i]);
            $rs = $query->Registrar_Combinacion($id, 8, '', '', $fin[0]);
            if($rs>0){
                $r1 = $query->Registrar_Composicion($rs,Limpiar_Cadena($fin[1]));
                if($r1>0){
                    echo 1;
                }else echo "Error";
            }else echo "Error";
        }
    }else{
    $nvo = $_POST['nvo'];

    $ft = explode('|', $comp);
        for($i=0; $i<=count($ft)-2; $i++){
            $fin = explode('@',$ft[$i]);
            $rs = $query->Actualizar_Combinacion($fin[0],$fin[1]);
            if($rs>0){
                $r1 = $query->Actualizar_Composicion($fin[2],Limpiar_Cadena($fin[3]));
                if($r1>0){
                    echo 1;
                }else echo "Error";
            }else echo "Error";
        }
    }
    if($nvo != ''){

    }*/
}else if($acc == 'Eliminar_Otro'){
    $id = $_POST['id'];

    $rs = $query->Eliminar_Otro($id);
    if($rs>0){
        echo 1;
    }else{
        echo "Error";
    }

}else if($acc == 'Ingresar_Composicion' || $acc == 'Modificar_Composicion'){
    $str = $_POST['str'];
    $comp = $_POST['comp'];

    if($str != ''){
        $ft = explode('@',$str);
        for($i=0; $i<=count($ft)-2; $i++){
            $fin = explode('|',$ft[$i]);
            if($acc == 'Ingresar_Composicion'){
                $rs = $query->Registrar_Composicion($fin[0],strtoupper($fin[1]));
            }else{
                $rs = $query->Actualizar_Composicion($fin[0],strtoupper($fin[1]));
            }
        }
    }
    $compo = explode('@',$comp);
    for($j=0; $j<=count($compo)-2; $j++){
        $com = explode('|',$compo[$j]);
        $r1 = $query->Actualizar_Variante($com[0],Limpiar_Cadena($com[1]));
        if($r1>0){
            echo 1;
        }else{
            echo "Error";
        }
    }
}else if($acc == 'Ingresar_Piezas'){
    $id = $_POST['id'];
    $str = $_POST['str'];

    $ft = explode('_',$str);
    for($i=0; $i<=count($ft)-2; $i++){
        $fin = explode('|',$ft[$i]);
        $comb = explode('@', $fin[2]);
        $rs = $query->Registrar_Piezas($id, $comb[0], $fin[0], $fin[1]);
        if($rs>0){
            echo 1;
        }else{
            echo 'Error';
        }
    }
}else if($acc == 'Eliminar_Pieza'){
    $id = $_POST['id'];

    $rs = $query->Eliminar_Pieza($id);
    if($rs>0){
        echo 1;
    }else{
        echo 'Error';
    }

}else if($acc == 'Registrar_Indicacion' || $acc == 'Modificar_Indicacion'){
    $ind = Limpiar_Cadena($_POST['ind']);//generales
    $ind2 = Limpiar_Cadena($_POST['ind2']);//tejido
    $ind3 = Limpiar_Cadena($_POST['ind3']);//corte
    $ind4 = Limpiar_Cadena($_POST['ind4']);//cuidado
    $ind5 = Limpiar_Cadena($_POST['ind5']);//referencia
    $planchado = Limpiar_Cadena($_POST['planchado']);//Indicaciones de planchado

    if($acc == 'Registrar_Indicacion'){
        $ficha = $_POST['ficha'];
        $rs = $query->Registrar_Indicacion($ficha, $ind, $ind2, $ind3, $ind4, $ind5, $planchado);
        if($rs>0){
            echo 1;
        }else{
            echo 'Error';
        }
    }else{
        $id = $_POST['id'];
        $rs = $query->Modificar_Indicacion($id, $ind, $ind2, $ind3, $ind4, $ind5, $planchado);
        if($rs>0){
            echo 1;
        }else{
            echo 'Error';
        }
    }
}else if($acc == 'Registrar_Medidas' || $acc == 'Modificar_Medidas'){
    $med = $_POST['med'];
    $id = $_POST['ficha'];

    if($acc == 'Registrar_Medidas'){
        $ft = explode('-',$med);//Separamos el string por medidas
        for($i=0;$i<count($ft)-1;$i++){
            $talla = explode('@',$ft[$i]);
            for($j=0;$j<count($talla)-1;$j++){
                $md = explode('|', $talla[$j]);
                $rs = $query->Registrar_Medida($id,$md[0],$md[1],($md[2]!='0'?$md[2]:''),($md[3]!='0'?$md[3]:''));
                if ($rs > 0) {
                    echo $rs;
                }else
                    echo "Error";
            }
        }
    }else{
        $ft = explode('@',$med);//Separamos el string por medidas
        for($i=0;$i<count($ft)-1;$i++){
            $talla = explode('|',$ft[$i]);
            $rs = $query->Actualizar_Medida($talla[0],Limpiar_Cadena($talla[1]),$talla[2],Limpiar_Cadena($talla[3]));
            if ($rs > 0) {
                echo $rs;
            }else
                echo "Error";
        }
    }
}else if($acc == 'Ingresar_Combinacion'){
    $str = $_POST['str'];
    $id = $_POST['id'];

    $ft = explode(',',$str);//Separamos el string por combinacion
    for($i=0; $i<count($ft)-1; $i++){
        $comb = $ft[$i];
        $res = explode('|',$comb);//Separamos la combinacion
        $t0 = explode('-',$res[0]);//Separamos tipo de combinacion y descripcion del tipo
        $tipo = $t0[0];//guardamos tipo
        //$entretela = $t0[2];//guardamos entretela o forro

        $rs = $query->Registrar_Combinacion($id, $tipo, '', '');
        if($rs>0){
            for($j=1; $j<=count($res); $j++){
                if($res[$j]!=''){
                    $var = explode('@', $res[$j]);
                    $tela = explode('_',$var[0]);
                    $icod = $tela[0];
                    $idescr = $tela[1];
                    $color = $var[1];
                    $fact = $var[2]."@".($var[3]!=''?$var[3]:"");
                    $rt = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod."'","");
                    $rv = $query->Registrar_Variante($rs, $icod, $idescr, $rt->fields['ICOMPOS'], $color, $fact);
                    if($rv>0){
                        echo $rv;
                    }else echo 'Error';
                }
            }
        }

        /*if($tipo == '7'){//Ingresar entretela
            $rs = $query->Registrar_Combinacion($id, $tipo, Limpiar_Cadena($entretela),'');
            if($rs>0){
                for($j=1; $j<=count($res); $j++){
                    if($res[$j]!=''){
                        $color = explode('@',$res[$j]);
                        //$fact = $color[1]."@".($color[2]!=''?$color[2]:"");
                        $rv = $query->Registrar_Variante($rs, '', '', '',$color[1], '');
                        if($rv>0){
                            echo $rv;
                        }else echo 'Error';
                    }
                }
            }else echo 'Error';
        }else if($tipo=='9'){//Ingresar forro
            $rs = $query->Registrar_Combinacion($id, $tipo, Limpiar_Cadena($entretela), '');//id_ficha, id_cat_comb,
            if($rs>0){
                for($j=1; $j<=count($res); $j++){
                    if($res[$j]!=''){
                        $var = explode('@', $res[$j]);
                        $tela = explode('_',$var[0]);
                        $tela2 = explode('/',$var[0]);//sacar forro para ingresar solo icod
                        $icod = $tela2[1];
                        $idescr = $tela[1];
                        $color = $var[1];
                        $fact = $var[2]."@".($var[3]!=''?$var[3]:"");
                        $rt = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod."'","");
                        $rv = $query->Registrar_Variante($rs, $icod, $idescr, '', $color, $fact);
                        if($rv>0){
                            echo $rv;
                        }else echo 'Error';
                    }
                }
            }
        }else{
            $rs = $query->Registrar_Combinacion($id, $tipo, '', '');
            if($rs>0){
                for($j=1; $j<=count($res); $j++){
                    if($res[$j]!=''){
                        $var = explode('@', $res[$j]);
                        $tela = explode('_',$var[0]);
                        $icod = $tela[0];
                        $idescr = $tela[1];
                        $color = $var[1];
                        $fact = $var[2]."@".($var[3]!=''?$var[3]:"");
                        $rt = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod."'","");
                        $rv = $query->Registrar_Variante($rs, $icod, $idescr, $rt->fields['ICOMPOS'], $color, $fact);
                        if($rv>0){
                            echo $rv;
                        }else echo 'Error';
                    }
                }
            }
            $t1 = explode('_',$res[1]);//Separamos icod y descripcion de la tela
            $icod = $t1[0];//guardamos icod
            $descr = $t1[1];//guardamos descripcion
            $rt = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod."'","");
            if($rt->RecordCount()>0){
                if($rt->fields['ICOMPOS']!=''){
                    $rs = $query->Registrar_Combinacion($id, $tipo, $icod, $descr, $rt->fields['ICOMPOS']);
                    if($rs>0){
                        for($j=2; $j<=count($res); $j++){
                            if($res[$j]!=''){
                                $color = explode('@',$res[$j]);
                                $fact = $color[1]."@".($color[2]!=''?$color[2]:"");
                                $rv = $query->Registrar_Variante($rs, $color[0], $fact);
                                if($rv>0){
                                    echo $rv;
                                }else echo 'Error';
                            }
                        }
                    }else echo 'Error';
                }else echo 'Error_Comp';
            }
        }*/
    }
}else if($acc == 'Actualizar_Combinacion'){
    $str = $_POST['str'];
    $id = $_POST['id'];//id de la ficha
    $comb = $_POST['comb'];//id de la combinacion

    $ft = explode('|',$str);
    $idcat = $ft[0];//tipo de combinacion

    $rs = $query->Actualizar_Combinacion($comb,$idcat);
    if($rs>0){
        for($i=1; $i<count($ft)-1; $i++){
            if($ft[$i]!=''){
                $var = explode('@',$ft[$i]);
                $icod = explode('_',$var[0]);//separamos icod y tela
                $idv = $var[1];
                $color = $var[2];
                $fact = $var[3]."@".($var[4]!=''?$var[4]:"");
                $rt = $query->Consultar_Proscai("ICOD, ICOMPOS","FINV","ICOD = '".$icod[0]."'","");
                $rv = $query->Update_Variante($idv, $icod[0], $icod[1], $rt->fields['ICOMPOS'], $color, $fact);
            }
        }
        echo 1;
    }else echo "Error";
}else if($acc == 'Eliminar_Combinacion'){
    $id = $_POST['id'];

    $rs = $query->Eliminar_Combinacion($id);//tambien se eliminan los registros relacionados a esta en combinacion en la tabla composiciones
    if($rs>0){
        $rsf = $query->Eliminar_Variante($id);
        if($rsf>0){
            echo 1;
        }else
            echo "Error";
    }else
        echo "Error";
}else if($acc == 'Delete_Habil'){
    $id = $_POST['id'];

    $rs = $query->Eliminar_Habil($id);
    if($rs>0){
        echo 1;
    }else
        echo "Error";
}else if($acc == 'Delete_Medidas'){
    $id = $_POST['id'];

    $rs = $query->Eliminar_Medidas($id);
    if($rs>0){
        echo 1;
    }else
        echo "Error";
}else if($acc == 'Delete_Variante'){
    $id = $_POST['id_var'];
    $var = $_POST['var'];
    $ficha = $_POST['ficha'];

    $rs = $query->Delete_Variante($id, $var, $ficha);
    if($rs>0){
        echo 1;
    }else
        echo "Error";
}else if($acc == 'Nueva_Medida'){
    $med = $_POST['medida'];

    $rs = $query->Nueva_Medida($med);
    if($rs>0){
        echo 1;
    }else
        echo "Error";
}else if($acc == 'Agregar_Habil'){
    $id = $_POST['id'];
    $icod = $_POST['icod'];
    $idescr = $_POST['idescr'];
    $var = $_POST['var'];
    $cor = $_POST['cor'];

    $rs = $query->Registrar_Habilitacion($id, $icod, $idescr);
    if($rs>0){
        for($i=1; $i<=$var; $i++){
            $rv = $query->Registrar_HabilVariante($rs, $i, $icod);
        }
        $ht = explode('|',$cor);//habilitacion por talla
        for($j=0; $j<=count($ht)-2; $j++){
            $rt = $query->Registrar_HabilTalla($rs, $ht[$j], "");
        }
        echo 1;
    }else
        echo "Error";
}else if($acc == 'Registrar_Habilitacion' || $acc = 'Modificar_Habilitacion'){
    $id = $_POST['ficha'];
    $str = $_POST['str'];

    if($acc == 'Registrar_Habilitacion'){
        $ft = explode('>', $str);
        for($i=0; $i<count($ft)-1; $i++){
            $hb = explode('|', $ft[$i]);
            $descr = $hb[0];
            $icod = $hb[1];
            $rs = $query->Registrar_Habilitacion($id,$icod,$descr);
            if($rs>0){
                $cont = 1;
                $hv = explode('@',$hb[2]);//habilitacion por variante
                for($j=0;$j<=count($hv)-2;$j++){
                    $a = explode('_', $hv[$j]);
                    $rv = $query->Registrar_HabilVariante($rs, $cont, $hv[$j]);
                    $cont++;
                }
                $ht = explode('@',$hb[3]);//habilitacion por talla
                for($k=0;$k<=count($ht)-2;$k++){
                    $b = explode('_', $ht[$k]);
                    $talla = $b[0];
                    $habilt = $b[1];
                    $rt = $query->Registrar_HabilTalla($rs, $talla, $habilt);
                }
                echo 1;
            }else{
                echo "Error";
            }
        }
    }else{
        $ft = explode('_',$str);//Separamos variantes y tallas
        $hv = explode('@',$ft[0]);//Separamos el string de las variantes
        for($i=0; $i<=count($hv)-2; $i++) {
            $var = explode('|', $hv[$i]);
            $rs = $query->Actualizar_Habil_Variante($var[0], $var[1]);
            if ($rs > 0) {
                echo 1;
            } else {
                echo "Error";
            }
        }
        $ht = explode('@',$ft[1]);//Separamos el string de las tallas
        for($j=0; $j<=count($ht)-2; $j++){
            $talla = explode('|',$ht[$j]);
            $rt = $query->Actualizar_Habil_Talla($talla[0], $talla[1]);
            if ($rs > 0) {
                echo 1;
            } else {
                echo "Error";
            }
        }
    }
}
?>