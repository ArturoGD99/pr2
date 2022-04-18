<?php
if(strstr($ruta,'/')) $ruta = "C:\\wamp64\\www\\DisenoPammy\\".$ruta.'/log/error.log';
else $ruta = "C:\\wamp64\\www\\DisenoPammy\\".$ruta.'\log\error.log';

define('ADODB_ERROR_LOG_TYPE', 3);
define('ADODB_ERROR_LOG_DEST', $ruta);

class Sentencias
{
	public function Conectar(){
        $db = newADOConnection('mysqli');
        //$db->debug = true;
        $conectado = $db->Connect('localhost', 'root', '', 'lpammy');
		return $db;
	}

	public function Insertar($obj, $campos, $tabla, $datos, $secuencia){
		$nuevo=0;
		$db = $obj->Conectar();
		//$db->execute("SET NAMES utf8");
		if($campos!="")
			$campos = "(" .$campos. ")";

		if($secuencia=="")
			$sql = "Insert into " .$tabla. " " .$campos. " values (" .$datos. ")";
		else{
			$sql = "SELECT MAX(".$secuencia.")+1 FROM " . $tabla;
			$rs = $db->_Execute($sql);
			if ($rs){
				if($rs->fields[0]!="")
					$nuevo = $rs->fields[0];
				else
					$nuevo = 1;
			}
			$sql = "Insert into " .$tabla. " " .$campos. " values (".$nuevo.",".$datos.")";
		}
		$resultado = $db->_query($sql);

		if($resultado=="")
			return 0;
		else if($secuencia!="")
			return $nuevo;
		else
			return $resultado;
	}

	public function Consultar($obj, $campos, $tabla, $criterios, $orden){
		if($criterios!="")
			$criterios=" where ".$criterios;

		if($orden!="")
			$orden=" order by ".$orden;

		$ADODB_COUNTRECS = true;
		$ADODB_LANG='es';
		$sql = "select " .$campos. " from " .$tabla. " " .$criterios. " " .$orden;
		$db = $obj->Conectar();
		$rs = $db->Execute($sql);
		return $rs;
	}

	public function Actualizar($obj, $datos, $tabla, $criterios){
		if($criterios!="") $criterios=" where ".$criterios;
		$sql = "UPDATE " .$tabla. " SET " .$datos. " " .$criterios;
		$db = $obj->Conectar();
		return $db->_query($sql);
	}

	public function Delete($obj, $datos, $tabla, $criterios){
		if($criterios!="") $criterios=" where ".$criterios;
		$sql = "DELETE " .$tabla. " SET " .$datos. " " .$criterios;
		$db = $obj->Conectar();
		return $db->_query($sql);
	}

	public function Paginado($obj, $campos, $tabla, $criterios, $orden, $col, $inicio){
		if($criterios!="") $criterios=" where ".$criterios;
		if($orden!="") $orden=" order by ".$orden;

		$sql = "SELECT " .$campos. " FROM " .$tabla. " " .$criterios. " " .$orden;
		$db = $obj->Conectar();
		return $db->SelectLimit($sql, $col, $inicio);
	}

	public function Iniciar_Transaccion($obj){
		$db = $obj->Conectar();
		$db->StartTrans();
		return $db;
	}

	public function Finalizar_Transaccion($obj){
		return $obj->CompleteTrans();
		}
}
class Proscai{
    public function Conectar_Proscai(){
        $db = newADOConnection('mysqli');
        $conectado = $db->Connect('209.50.53.47', 'consultas', 'consultas', 'leticia');
        return $db;
    }
    public function Consultar($obj, $campos, $tabla, $criterios, $orden){
        if($criterios!="")
            $criterios=" where ".$criterios;

        if($orden!="")
            $orden=" order by ".$orden;

        $ADODB_COUNTRECS = true;
        $ADODB_LANG='es';
        $sql = "select " .$campos. " from " .$tabla. " " .$criterios. " " .$orden;
        $db = $obj->Conectar_Proscai();
        $rs = $db->Execute($sql);
        /*$db->Close();
        $rs->Close();*/
        return $rs;
    }
    public function Iniciar_Transaccion($obj){
        $db = $obj->Conectar_Proscai();
        //$db->execute("SET NAMES utf8");
        $db->StartTrans();
        return $db;
    }
    public function Finalizar_Transaccion($obj){
        return $obj->CompleteTrans();
    }
}
?>
