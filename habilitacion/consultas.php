<?php
include_once('../registro.php');
$query = new Registro();
$tp = $_POST['tp'];//tipo de consulta

if($tp == 'pedidos'){
	$clicod = $_POST['clicod'];//codigo del cliente a consultar en proscai

	$campos = "FC.CLICOD, FP.PENUM, FP.PENUMELLOS, SUBSTRING(FP.PEHIJOS,2,2)AS SEMANA, CONCAT(SUBSTRING(FP.PEHIJOS,4,2),'-',SUBSTRING(FP.PEHIJOS,6,4))AS FECHA, FI.ICODPRV AS MODELO_CTE, FI.ICOLOREXT AS COLOR_CTE, FP.PEFECHA, FP.PEVENCE, FI.IRAIZ, FL.PLCOLOR, FM1.FAMNUM, FM1.FAMDESCR AS DEPTO, FM2.FAMDESCR AS PRODUCTO, FM3.FAMDESCR AS MARCA, ROUND(FI.ILISTA16,2) AS PV";
	$tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FCLI FC ON FC.CLISEQ = FP.CLISEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ LEFT JOIN FFAM FM1 ON FM1.FAMTNUM = FI.IFAM1 LEFT JOIN FFAM FM2 ON FM2.FAMTNUM = FI.IFAM2 LEFT JOIN FFAM FM3 ON FM3.FAMTNUM = FI.IFAM3";
	$criterios = "FP.PENUM LIKE 'Q%' AND FL.PLTIPMV = 'Q' AND FI.ICODPRV <> '' AND FP.PEHIJOS <> 0 AND FC.CLICOD = '".$clicod."' GROUP BY FC.CLICOD, FP.PENUM, FI.IRAIZ ORDER BY FP.PENUM;";

	$rs = $query->Consultar_Proscai($campos,$tablas,$criterios,"");
	if($rs->RecordCount()>0){
        echo "<table id='tbl_pedidos' class='table table-striped table-bordered nowrap table-hover' style='width:100%'><thead><tr>";
        echo "<th style='text-align: center'>CLIENTE</th>";
        echo "<th style='text-align: center'>PEDIDO</th>";
        echo "<th style='text-align: center'>ORDEN</th>";
        echo "<th style='text-align: center'>SEMANA</th>";
        echo "<th style='text-align: center'>FECHA</th>";
        echo "<th style='text-align: center'>MODELO_CTE</th>";
        echo "<th style='text-align: center'>COLOR_CTE</th>";
        echo "<th style='text-align: center'>PEFECHA</th>";
        echo "<th style='text-align: center'>PEVENCE</th>";
        echo "<th style='text-align: center'>MODELO</th>";
        echo "<th style='text-align: center'>MARCA</th>";
        echo "<th style='text-align: center'>DEPTO</th>";
        echo "<th style='text-align: center'>PRODUCTO</th>";
        echo "<th style='text-align: center'>PV</th>";
        echo "<th style='width:5px'></th>";
        echo "<th style='width:5px'></th>";
        echo "<th style='width:5px'></th>";
        echo "</tr></thead><tbody>";
        while(!$rs->EOF){
        	$r1 = $query->Consultar("F.ID_FICHA, F.ORDEN, F.PEDIDO, FL.ID_LABORATORIO, FL.ID_FICHA AS FICHA_LAB, FL.ID_VARIANTE","FFICHA F LEFT JOIN FLABORATORIO FL ON FL.ID_FICHA = F.ID_FICHA","F.PEDIDO LIKE '".$rs->fields['PENUM']."'","");//
            if($r1->RecordCount()>0){
              $id_f = $r1->fields['ID_FICHA'];
              $ficha = "<a href='#' id='id_".$r1->fields['ID_FICHA']."' style='color:black;' onclick=\"Abrir_Modal(".$r1->fields['ID_FICHA'].")\"><i class='fas fa-file-pdf'></i>&nbsp;PDF</a>";
              if($r1->fields['ID_LABORATORIO'] != '')
                $monarch = "<a href='habilitacion\bases.php?clicod=".$rs->fields['CLICOD']."&ped=".$rs->fields['PENUM']."&id_ficha=".$r1->fields['ID_FICHA']."&tp=monarch' target='_blank' id='id_".$rs->fields['PENUM']."' style='color:black;' ><i class='far fa-file-excel'></i>&nbsp;Monarch</a>";
              else
                $monarch = "";  
            }else{
              $ficha = "";
              $monarch = "";    
            }
            echo "<tr>";
            echo "<td>".$rs->fields['CLICOD']."</td>";
            echo "<td>".$rs->fields['PENUM']."</td>";
            echo "<td>".$rs->fields['PENUMELLOS']."</td>";
            echo "<td>".$rs->fields['SEMANA']."</td>";
            echo "<td>".$rs->fields['FECHA']."</td>";
            echo "<td>".$rs->fields['MODELO_CTE']."</td>";
            echo "<td>".$rs->fields['COLOR_CTE']."</td>";
            echo "<td>".$rs->fields['PEFECHA']."</td>";
            echo "<td>".$rs->fields['PEVENCE']."</td>";
            echo "<td>".$rs->fields['IRAIZ']."</td>";
            echo "<td>".$rs->fields['MARCA']."</td>";
            echo "<td>".$rs->fields['DEPTO']."</td>";
            echo "<td>".$rs->fields['PRODUCTO']."</td>";
            echo "<td>".$rs->fields['PV']."</td>";
            echo "<td>".$ficha."</td>";
            echo "<td><a href='habilitacion\bases.php?clicod=".$rs->fields['CLICOD']."&ped=".$rs->fields['PENUM']."&tp=precio' target='_blank' id='id_".$rs->fields['PENUM']."' style='color:black;' ><i class='far fa-file-excel'></i>&nbsp;Precio</a></td>";
            echo "<td>".$monarch."</td>";
            echo "</tr>";
            $rs->MoveNext();
        }
        echo "</tbody></table>";
    }else echo "<h5>Sin resultados</h5>";
}
?>