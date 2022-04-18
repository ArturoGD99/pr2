<?php
include_once("adodb/adodb.inc.php");
include_once("adodb/adodb-errorhandler.inc.php");
include_once("conn.php");
$ruta="DisenoPammy/log";

class Registro
{
	public function Consultar($campos,$tablas,$criterios,$orden)
	{
		$query = new Sentencias();
		$rs = $query->Consultar($query, $campos,$tablas, $criterios, $orden);
		return $rs;
	}
    public function Consultar_Proscai($campos,$tablas,$criterios,$orden)
    {
        $query = new Proscai();
        $rs = $query->Consultar($query, $campos,$tablas, $criterios, $orden);
        return $rs;
    }
	public function Registrar_Modelo($cte, $marca, $lin, $pren, $talla, $ord, $mod, $ped, $sem, $temp, $corrida, $dis, $pat, $mues, $grad, $desc, $igual, $cant){
			$query = new Sentencias();
			$db = $query->Iniciar_Transaccion($query);

			$sql = "INSERT INTO FFICHA(ID_CLIENTE, ID_MARCA, ID_LINEA, ID_PRENDA, ID_TALLA, ORDEN, MODELO, PEDIDO, SEMANA, TEMPORADA, CORRIDA, DISENADORA, PATRONISTA, MUESTRISTA, GRADUADORA, DESCRIPCION, IGUAL, FECHA, CANTIDAD, STATUS) ";
			$sql.= "VALUES(".$cte.", ".$marca.", ".$lin.", ".$pren.", ".$talla.", '".$ord."', '".$mod."', '".$ped."', '".$sem."', '".$temp."', '".$corrida."', '".$dis."', '".$pat."', '".$mues."','".$grad."','".$desc."','".$igual."', CURDATE(), '".$cant."', 1)";
			$sql = $this->InjectSQL_registro($sql,1);
			$rs = $db->Execute($sql);
            $id = $db->Insert_ID();

			if($query->Finalizar_Transaccion($db)){
				return $id;
			}else
				return 0;
	}
    public function Modificar_Modelo($ord, $ficha, $cte, $marca, $lin, $pren, $temp, $talla, $dis, $pat, $mues, $grad, $igual, $cant, $desc){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FFICHA SET ID_CLIENTE = ".$cte.", ID_MARCA = ".$marca.", ID_LINEA = ".$lin.", ID_PRENDA = ".$pren.", ID_TALLA = ".$talla.", ORDEN = '".$ord."', TEMPORADA = '".$temp."', DISENADORA = '".$dis."', PATRONISTA = '".$pat."', ";
        $sql.= "MUESTRISTA = '".$mues."', GRADUADORA = '".$grad."', IGUAL = '".$igual."', CANTIDAD = '".$cant."', DESCRIPCION = '".$desc."' WHERE ID_FICHA =".$ficha;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_Foto($id, $foto){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FFOTO(ID_FICHA, FOTO, STATUS) ";
        $sql.= "VALUES(".$id.", 'fotos/".$foto.".jpg', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_Medida($id, $ct_med, $talla, $med, $tol){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FMEDIDAS(ID_FICHA, ID_CAT_MED, TALLA, MEDIDA, TOLERANCIA, STATUS) ";
        $sql.= "VALUES(".$id.", ".$ct_med.", '".$talla."', '".$med."', '".$tol."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Actualizar_Medida($id, $med, $tipo, $tol){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FMEDIDAS ";
        $sql.= " SET MEDIDA = '".$med."', ID_CAT_MED = ".$tipo.", TOLERANCIA = '".$tol."' WHERE ID_MEDIDA = ".$id." ";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    /*public function Registrar_Combinacion($id, $tipo, $icod, $descr, $compos){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FCOMBINACIONES(ID_FICHA, ID_CAT_COMBINACION, ICOD, DESCRIPCION, COMPOSICION, STATUS) ";
        $sql.= "VALUES(".$id.", ".$tipo.", '".$icod."', '".$descr."', '".$compos."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);
        $id = $db->Insert_ID();

        if($query->Finalizar_Transaccion($db)){
            return $id;
        }else
            return 0;
    }*/
    public function Registrar_Combinacion($id, $tipo, $descr, $comp){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FCOMBINACIONES(ID_FICHA, ID_CAT_COMBINACION, DESCRIPCION, COMPOSICION, STATUS) ";
        $sql.= "VALUES(".$id.", ".$tipo.", '".$descr."', '".$comp."',  1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);
        $id = $db->Insert_ID();

        if($query->Finalizar_Transaccion($db)){
            return $id;
        }else
            return 0;
    }
    public function Actualizar_Combinacion($id, $comb){//$id, $comp
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FCOMBINACIONES";
        $sql.= " SET ID_CAT_COMBINACION = ".$comb." WHERE ID_COMBINACION = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    /*public function Registrar_Variante($id, $color, $fact){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FVARIANTES(ID_COMBINACION, COLOR, PRV_FACT, STATUS) ";
        $sql.= "VALUES(".$id.", '".$color."', '".$fact."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }*/
    public function Registrar_Variante($id, $icod, $idescr, $compos, $color, $fact){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FVARIANTES(ID_COMBINACION, ICOD, IDESCR, COMPOSICION, COLOR, PRV_FACT, STATUS) ";
        $sql.= "VALUES(".$id.", '".$icod."', '".$idescr."','".$compos."', '".$color."', '".$fact."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_VarianteN($id, $var, $color, $icod1, $idescr1, $comp1, $fact1, $icod2, $idescr2, $comp2, $fact2){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FVARIANTES(ID_COMBINACION, VARIANTE, COLOR, ICOD, IDESCR, COMPOSICION, PRV_FACT, ICOD2, IDESCR2, COMPOSICION2, PRV_FACT2, STATUS) ";
        $sql.= "VALUES(".$id.", ".$var.", '".$color."', '".$icod1."', '".$idescr1."', '".$comp1."', '".$fact1."', '".$icod2."', '".$idescr2."', '".$comp2."', '".$fact2."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Modificar_VarianteN($id, $color, $icod1, $idescr1, $comp1, $fact1, $icod2, $idescr2, $comp2, $fact2){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FVARIANTES ";
        $sql.= "SET COLOR = '".$color."', ICOD = '".$icod1."', IDESCR = '".$idescr1."', COMPOSICION = '".$comp1."', PRV_FACT = '".$fact1."', ICOD2 = '".$icod2."', IDESCR2 = '".$idescr2."', COMPOSICION2 = '".$comp2."', PRV_FACT2 = '".$fact2."' WHERE ID_VARIANTE =".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Actualizar_Variante($id, $comp){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FVARIANTES ";
        $sql.= " SET COMPOSICION = '".$comp."' WHERE ID_VARIANTE = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Update_Variante($id, $icod, $idescr, $comp, $color, $fact){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FVARIANTES ";
        $sql.= " SET ICOD = '".$icod."', IDESCR = '".$idescr."', COMPOSICION = '".$comp."', COLOR = '".$color."', PRV_FACT = '".$fact."' WHERE ID_VARIANTE = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Eliminar_Otro($id){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FCOMBINACIONES WHERE ID_COMBINACION =".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Eliminar_Combinacion($id){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FCOMBINACIONES WHERE ID_COMBINACION =".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            $sql = "DELETE FROM FCOMPOSICIONES WHERE ID_COMBINACION =".$id;
            $sql = $this->InjectSQL_registro($sql,1);
            $rs = $db->Execute($sql);
            return 1;
        }else
            return 0;
    }
    public function Eliminar_Variante($id){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FVARIANTES WHERE ID_COMBINACION = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Delete_Variante($id, $var, $ficha){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FVARIANTES WHERE ID_VARIANTE = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            $sql2 = "SELECT FC.ID_FICHA, FV.VARIANTE, COUNT(FV.VARIANTE)AS CONT FROM FCOMBINACIONES FC INNER JOIN FVARIANTES FV ON FV.ID_COMBINACION = FC.ID_COMBINACION WHERE FC.ID_FICHA = ".$ficha." AND VARIANTE = '".$var."' GROUP BY FV.VARIANTE";
            $r2 = $db->Execute($sql2);
            if(!$r2->RecordCount()>0){
                $sql3 = "DELETE FROM FHABIL_VARIANTE WHERE ID_HABIL_VAR IN (SELECT * FROM(SELECT FV.ID_HABIL_VAR FROM FHABILITACION FH INNER JOIN FHABIL_VARIANTE FV ON FV.ID_HABIL = FH.ID_HABILITACION WHERE FH.ID_FICHA = ".$ficha." AND FV.VARIANTE = ".$var.")AS T)";
                $sql3 = $this->InjectSQL_registro($sql3,1);
                $r3 = $db->Execute($sql3);
            }
            return 1;
        }else
            return 0;
    }
    public function Registrar_Habilitacion($id, $icod, $descr){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FHABILITACION(ID_FICHA, ICOD, DESCRIPCION, STATUS) ";
        $sql.= "VALUES(".$id.", '".$icod."', '".$descr."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);
        $id = $db->Insert_ID();

        if($query->Finalizar_Transaccion($db)){
            return $id;
        }else
            return 0;
    }
    public function Eliminar_Habil($id){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FHABILITACION WHERE ID_HABILITACION =".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            $sql = "DELETE FROM FHABIL_VARIANTE WHERE ID_HABIL =".$id;
            $sql = $this->InjectSQL_registro($sql,1);
            $rs = $db->Execute($sql);

            $sql = "DELETE FROM FHABIL_TALLAS WHERE ID_HABIL =".$id;
            $sql = $this->InjectSQL_registro($sql,1);
            $rs = $db->Execute($sql);
            return 1;
        }else
            return 0;
    }
    public function Eliminar_Medidas($id){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FMEDIDAS WHERE ID_FICHA =".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Nueva_Medida($med){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FCAT_MEDIDA(DESCRIPCION, STATUS) ";
        $sql.= "VALUES('".$med."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_HabilVariante($id, $var, $habil){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FHABIL_VARIANTE(ID_HABIL, VARIANTE, HABIL, STATUS) ";
        $sql.= "VALUES(".$id.", '".$var."', '".$habil."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);
        $id = $db->Insert_ID();

        if($query->Finalizar_Transaccion($db)){
            return $id;
        }else
            return 0;
    }
    public function Actualizar_Habil_Variante($id, $habil){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FHABIL_VARIANTE ";
        $sql.= " SET HABIL = '".$habil."' WHERE ID_HABIL_VAR = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_HabilTalla($id, $talla, $habil){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FHABIL_TALLAS(ID_HABIL, TALLA, HABIL, STATUS) ";
        $sql.= "VALUES(".$id.", '".$talla."', '".$habil."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);
        $id = $db->Insert_ID();

        if($query->Finalizar_Transaccion($db)){
            return $id;
        }else
            return 0;
    }
    public function Actualizar_Habil_Talla($id, $habil){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FHABIL_TALLAS ";
        $sql.= " SET HABIL = '".$habil."' WHERE ID_HABIL_TALLA = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_Composicion($id, $comp){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FCOMPOSICIONES(ID_COMBINACION, DESCRIPCION, STATUS) ";
        $sql.= "VALUES(".$id.", '".$comp."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Actualizar_Composicion($id, $comp){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FCOMPOSICIONES ";
        $sql.= "SET DESCRIPCION = '".$comp."' WHERE ID_COMPOSICION = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_Piezas($id, $comb, $desc, $cant){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FPIEZAS(ID_FICHA, ID_CAT_COMBINACION, DESCRIPCION, CANTIDAD, STATUS) ";
        $sql.= "VALUES(".$id.", ".$comb.", '".$desc."', '".$cant."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Eliminar_Pieza($id){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "DELETE FROM FPIEZAS WHERE ID_PIEZA = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Registrar_Indicacion($id, $ind, $ind2, $ind3, $ind4, $ind5, $planchado){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "INSERT INTO FINDICACIONES(ID_FICHA, INDICACION, INDICACION2, INDICACION3, INDICACION4, INDICACION5, PLANCHADO, STATUS) ";
        $sql.= "VALUES(".$id.", '".$ind."', '".$ind2."', '".$ind3."', '".$ind4."', '".$ind5."', '".$planchado."', 1)";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Modificar_Indicacion($id, $ind, $ind2, $ind3, $ind4, $ind5, $planchado){
        $query = new Sentencias();
        $db = $query->Iniciar_Transaccion($query);

        $sql = "UPDATE FINDICACIONES ";
        $sql.= "SET INDICACION = '".$ind."', INDICACION2 = '".$ind2."', INDICACION3 = '".$ind3."', INDICACION4 = '".$ind4."', INDICACION5 = '".$ind5."', PLANCHADO = '".$planchado."' WHERE ID_INDICACION = ".$id;
        $sql = $this->InjectSQL_registro($sql,1);
        $rs = $db->Execute($sql);

        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
	/*funciones laboratorio*/
    public function Registrar_Lab($id_ficha,$id_variante,$id_combinacion,$comp1,$comp2,$comp3,$ntela){
        $query=new sentencias();
        $db = $query->Iniciar_transaccion($query);

        if($ntela == '1')
            $sql = "INSERT INTO FLABORATORIO(ID_FICHA, ID_VARIANTE,ID_COMBINACION, COMP1, COMP2, COMP3, FECHA1, STATUS)";
        else
            $sql = "INSERT INTO FLABORATORIO(ID_FICHA, ID_VARIANTE,ID_COMBINACION, COMP4, COMP5, COMP6, FECHA2, STATUS)";

        $sql.= "VALUES(".$id_ficha." ,".$id_variante.",".$id_combinacion.", '".$comp1."', '".$comp2."', '".$comp3."',NOW(),1);";
        $sql = $this->InjectSQL_registro($sql,1);
        $rs= $db->Execute($sql);
        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
    public function Update_Lab($id_lab,$comp1,$comp2,$comp3,$ntela){
        $query=new sentencias();
        $db = $query->Iniciar_transaccion($query);

        if($ntela == '1')
            $sql = "UPDATE FLABORATORIO SET COMP1='".$comp1."', COMP2='".$comp2."', COMP3='".$comp3."', FECHA1 = NOW() WHERE ID_LABORATORIO=".$id_lab."";
        else
            $sql = "UPDATE FLABORATORIO SET COMP4='".$comp1."', COMP5='".$comp2."', COMP6='".$comp3."', FECHA2 = NOW() WHERE ID_LABORATORIO=".$id_lab."";

        $sql = $this->InjectSQL_registro($sql,1);
        $rs= $db->Execute($sql);
        if($query->Finalizar_Transaccion($db)){
            return 1;
        }else
            return 0;
    }
	private function InjectSQL_registro($valor, $tipo){
		if($tipo==0){
			$palabras = array('"',"EXEC","LIKE","\x00","\n","\r","\’","\x1a","“","‘","#",
			"UPDATE","SELECT","DELETE","INSERT","VALUES","inner","HTML","\x00","\x0a","\x0d","\x1a","\x09","xp_","--");
		}else{
			$palabras = array("EXEC","LIKE","\x00","\n","\r","\’","\x1a","“","#","inner",
			"HTML","\x00","\x0a","\x0d","\x1a","\x09","xp_","--");//,"‘"
		}

		for ($i=0; $i<count($palabras);$i++){$valor = str_replace($palabras[$i],"",$valor);}
		return $valor;
	}
}
?>