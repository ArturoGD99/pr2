<?php
include_once('../registro.php');
require_once ('PHPExcel/Classes/PHPExcel.php');

$query = new Registro();
$tp = $_GET['tp'];//tipo de consulta
$clicod = $_GET['clicod'];//codigo del cliente
$ped = $_GET['ped'];//Pedido Q del cliente
$id_ficha = $_GET['id_ficha'];//Id de la ficha en el sistema de diseno

$objRichText = new PHPExcel_RichText();
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("")
							 ->setLastModifiedBy("")
							 ->setTitle("")
							 ->setSubject("")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");
 
if($clicod == 'CWALMA'){//Etiquetas para Walmart
	if($tp == 'precio'){//Si es etiqueta de precio
		$xlsnombre = "Precio_Walmart ".$ped.".xlsx";
		$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A1', 'PEDIDO')
	            ->setCellValue('B1', 'MODELO')
	            ->setCellValue('C1', 'CODIGOS')
	            ->setCellValue('D1', 'DESCRIPCION')
	            ->setCellValue('E1', 'SECCION')
	            ->setCellValue('F1', 'SEMANA')
	            ->setCellValue('G1', 'MES')
	            ->setCellValue('H1', 'PRECIO')
	            ->setCellValue('I1', 'TALLAS')
	            ->setCellValue('J1', 'CANTIDAD');
	    //Estilos para los encabezados        
		$headerStyle = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'4F81BD'),),'font' => array('bold' => true,'color' => array('rgb'=>'FFFFFF')));
		//Se añaden los estilos para los encabezados
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($headerStyle);

		$campos = "FC.CLICOD, FP.PENUM, FP.PENUMELLOS, SUBSTRING(FP.PEHIJOS,2,2)AS SEMANA, CONCAT(SUBSTRING(FP.PEHIJOS,4,2),'-',SUBSTRING(FP.PEHIJOS,6,4))AS FECHA, FI.ICODPRV AS MODELO_CTE, FI.ICOLOREXT AS COLOR_CTE, FI.IRAIZ, FL.PLCOLOR, CASE WHEN FL.PLTALLA = 'XG' THEN 'EG' ELSE FL.PLTALLA END AS TALLA, FI.IEAN, ROUND((FL.PLCANT * 1.05))AS CANTIDAD, FM1.FAMNUM AS DEPTO, FM2.FAMDESCR AS PRODUCTO, ROUND(FI.ILISTA16,2) AS PV";
		$tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FCLI FC ON FC.CLISEQ = FP.CLISEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ LEFT JOIN FFAM FM1 ON FM1.FAMTNUM = FI.IFAM1 LEFT JOIN FFAM FM2 ON FM2.FAMTNUM = FI.IFAM2";
		$criterios = "FP.PENUM LIKE 'Q%' AND FL.PLTIPMV = 'Q' AND FI.ICODPRV <> '' AND FP.PEHIJOS <> 0 AND FC.CLICOD = '".$clicod."' AND FP.PENUM = '".$ped."' ORDER BY FP.PENUM";

		$rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
	    if($rs->RecordCount()>0){
	    	$cont = 1;
	        while(!$rs->EOF){
	        	$cont++;
	        	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$cont, $rs->fields['PENUM'])
				->setCellValue('B'.$cont, $rs->fields['IRAIZ'])
				->setCellValue('C'.$cont, $rs->fields['IEAN'])
				->setCellValue('D'.$cont, $rs->fields['PRODUCTO'])
				->setCellValue('E'.$cont, $rs->fields['DEPTO'])
				->setCellValue('F'.$cont, $rs->fields['SEMANA'])
				->setCellValue('G'.$cont, $rs->fields['FECHA'])
				->setCellValue('I'.$cont, $rs->fields['TALLA'])
				->setCellValue('J'.$cont, $rs->fields['CANTIDAD']);
				$objRichText = new PHPExcel_RichText();//Utilizamos estas 3 lineas para darle formato de moneda al precio de venta del cliente
				$objRichText->createText($rs->fields['PV']);
				$objPHPExcel->getActiveSheet()->getCell('H'.$cont)->setValue($objRichText);
	            $rs->MoveNext();
	        }
	    }else echo 0;
	}else{//Si es etiqueta de monarch :)
		$xlsnombre = "Monarch_Walmart ".$ped.".xlsx";
		$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A1', 'PEDIDO')
	            ->setCellValue('B1', 'MODELO')
	            ->setCellValue('C1', 'MODELO_CTE')
	            ->setCellValue('D1', 'CODIGOS')
	            ->setCellValue('E1', 'TIPO')
	            ->setCellValue('F1', 'COMP1')
	            ->setCellValue('G1', 'COMP2')
	            ->setCellValue('H1', 'COMP3')
	            ->setCellValue('I1', 'COMP4')
	            ->setCellValue('J1', 'TALLAS')
	            ->setCellValue('K1', 'CANTIDAD')
	            ->setCellValue('L1', 'SECADO')
	            ->setCellValue('M1', 'PLANCHADO');

	    //Estilos para los encabezados        
		$headerStyle = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'4F81BD'),),'font' => array('bold' => true,'color' => array('rgb'=>'FFFFFF')));
		//Se añaden los estilos para los encabezados
		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($headerStyle);

		$campos = "FC.CLICOD, FP.PENUM, FP.PENUMELLOS, FI.ICODPRV AS MODELO_CTE, FI.ICOLOREXT AS COLOR_CTE, FI.IRAIZ, FL.PLCOLOR, CASE WHEN FL.PLTALLA = 'XG' THEN 'EG' ELSE FL.PLTALLA END AS TALLA, FI.IEAN, ROUND((FL.PLCANT * 1.05))AS CANTIDAD";
		$tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FCLI FC ON FC.CLISEQ = FP.CLISEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ";
		$criterios = "FP.PENUM LIKE 'Q%' AND FL.PLTIPMV = 'Q' AND FI.ICODPRV <> '' AND FP.PEHIJOS <> 0 AND FC.CLICOD = '".$clicod."' AND FP.PENUM = '".$ped."' ORDER BY FP.PENUM";

		$rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
	    if($rs->RecordCount()>0){
	    	$cont = 1;
	        while(!$rs->EOF){
	        	$cont++;
	        	$campos = "FC.ID_COMBINACION, FC.ID_FICHA, FC.ID_CAT_COMBINACION, FC.DESCRIPCION, LCASE(FC.COMPOSICION)AS COMPOSICION, FT.COMBINACION, FT.CORTA, FL.ID_LABORATORIO, FL.ID_VARIANTE, FL.COMP1, FL.COMP2, FL.COMP3, FL.COMP4, FL.COMP5, FL.COMP6";
				$tablas = "FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION FT ON FT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION LEFT JOIN FLABORATORIO FL ON FL.ID_FICHA = FC.ID_FICHA AND FL.ID_COMBINACION = FC.ID_COMBINACION";
				$criterios = "FC.ID_FICHA = ".$id_ficha." AND FT.ID_CAT_COMBINACION NOT IN(7,9,10,11,12,13);";//7-ENTRETELA, 9-FORRO, 10-ELASTICO, 11-JARETA, 12-SMOCK, 13-CINTURON
				$r1 = $query->Consultar($campos,$tablas,$criterios,"");
				if($r1->RecordCount()>0){
					$comp1 = $r1->fields['COMP1'];//composicion 1
					$comp2 = $r1->fields['COMP2'];//composicion 2
					$comp3 = $r1->fields['COMP3'];//composicion 3
					$comp4 = $r1->fields['COMP4'];//composicion 4
					$tipo = $r1->fields['CORTA'];//Tipo de combinacion
					if($r1->fields['INDICACION2'] == 'TEJIDO DE PUNTO')
						$secado = 'HORIZONTAL A LA SOMBRA';
					else
						$secado = 'EN LINEA A LA SOMBRA';
					if($r1->fields['PLANCHADO'] == '')
						$planchado = 'PLANCHAR A TEMPERATURA BAJA 110°C';
					else
						$planchado = $r1->fields['PLANCHADO'];

				}

	        	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$cont, $rs->fields['PENUM'])
				->setCellValue('B'.$cont, $rs->fields['IRAIZ'])
				->setCellValue('C'.$cont, $rs->fields['MODELO_CTE'])
				->setCellValue('D'.$cont, $rs->fields['IEAN'])
				->setCellValue('E'.$cont, $tipo)
				->setCellValue('F'.$cont, $comp1)
				->setCellValue('G'.$cont, $comp2)
				->setCellValue('H'.$cont, $comp3)
				->setCellValue('I'.$cont, $comp4)
				->setCellValue('J'.$cont, $rs->fields['TALLA'])
				->setCellValue('K'.$cont, $rs->fields['CANTIDAD'])
				->setCellValue('L'.$cont, $secado)
				->setCellValue('M'.$cont, $planchado);
	            $rs->MoveNext();
	        }

	    }else echo 0;
	    //Consultamos si tiene composiciones adicionales a las telas
	    $campos = "FC.ID_COMBINACION, FC.ID_FICHA, FC.ID_CAT_COMBINACION, FC.DESCRIPCION, LCASE(FC.COMPOSICION)AS COMPOSICION, FT.COMBINACION, FT.CORTA";
		$tablas = "FCOMBINACIONES FC INNER JOIN FCAT_COMBINACION FT ON FT.ID_CAT_COMBINACION = FC.ID_CAT_COMBINACION LEFT JOIN FLABORATORIO FL ON FL.ID_FICHA = FC.ID_FICHA AND FL.ID_COMBINACION = FC.ID_COMBINACION";
		$criterios = "FC.ID_FICHA = ".$id_ficha." AND FT.ID_CAT_COMBINACION NOT IN(1,2,3,4,5,6,7);";//7-ENTRETELA y BASE y COMBINACIONES DEL 1 AL 5
		$r1 = $query->Consultar($campos,$tablas,$criterios,"");
		if($r1->RecordCount()>0){
			$cont = $cont+1;
			$comp1 = $r1->fields['COMPOSICION'];//composicion 1
			$comp2 = $r1->fields['COMPOSICION'];//composicion 2
			$tipo = $r1->fields['CORTA'];//Tipo de combinacion

			$campos = "FC.CLICOD, FP.PENUM, FP.PENUMELLOS, FI.ICODPRV AS MODELO_CTE, FI.ICOLOREXT AS COLOR_CTE, FI.IRAIZ, FL.PLCOLOR, CASE WHEN FL.PLTALLA = 'XG' THEN 'EG' ELSE FL.PLTALLA END AS TALLA, FI.IEAN, ROUND((FL.PLCANT * 1.05))AS CANTIDAD";
			$tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FCLI FC ON FC.CLISEQ = FP.CLISEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ";
			$criterios = "FP.PENUM LIKE 'Q%' AND FL.PLTIPMV = 'Q' AND FI.ICODPRV <> '' AND FP.PEHIJOS <> 0 AND FC.CLICOD = '".$clicod."' AND FP.PENUM = '".$ped."' ORDER BY FP.PENUM";

			$rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
		    if($rs->RecordCount()>0){
		        while(!$rs->EOF){
		        	$cont++;
		        	$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$cont, $rs->fields['PENUM'])
					->setCellValue('B'.$cont, $rs->fields['IRAIZ'])
					->setCellValue('C'.$cont, $rs->fields['MODELO_CTE'])
					->setCellValue('D'.$cont, $rs->fields['IEAN'])
					->setCellValue('E'.$cont, $tipo)
					->setCellValue('F'.$cont, $comp1)
					->setCellValue('G'.$cont, $comp2)
					->setCellValue('H'.$cont, '')
					->setCellValue('I'.$cont, '')
					->setCellValue('J'.$cont, $rs->fields['TALLA'])
					->setCellValue('K'.$cont, $rs->fields['CANTIDAD']);
		        	$rs->MoveNext();
		    	}
		    }

		}

	}

	#Estas lineas permiten autodimensionar las columnas para que se vean completas.
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);

	#Definimos el nombre del archivo
	$objPHPExcel->getActiveSheet()->setTitle('Detalle');//Nombre de la hoja
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header("Content-Disposition: attachment;filename=".$xlsnombre."");
	header('Cache-Control: max-age=0');
	header('Cache-Control: max-age=1');
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//Se genera el excel al ingresar al script, podemos definir una ruta y guardar el excel ahí, debes tener permisos para escribir en esa ruta
	$objWriter->save('php://output');
	exit;
}
?>