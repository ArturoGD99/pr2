<?php
include_once('../registro.php');
$query = new Registro();
$tp = $_POST['tp']; //tipo de consulta

if ($tp == 'ordenes') {
    $clicod = $_POST['clicod']; //codigo del cliente a consultar en proscai
    $ordInicio = $_POST['qinicio'];
    $ordFin = $_POST['qfin'];
    $cond=true;
    $campos = "FC.CLICOD, FP.PENUM, FP.PENUMELLOS, SUBSTRING(FP.PEHIJOS,2,2)AS SEMANA, CONCAT(SUBSTRING(FP.PEHIJOS,4,2),'-',SUBSTRING(FP.PEHIJOS,6,4))AS FECHA, FI.ICODPRV AS MODELO_CTE, FI.ICOLOREXT AS COLOR_CTE, FP.PEFECHA, FP.PEVENCE, FI.IRAIZ, FL.PLCOLOR, FM1.FAMNUM, FM1.FAMDESCR AS DEPTO, FM2.FAMDESCR AS PRODUCTO, FM3.FAMDESCR AS MARCA, ROUND(FI.ILISTA16,2) AS PV";
    $tablas = "FPENC FP INNER JOIN FPLIN FL ON FL.PESEQ = FP.PESEQ INNER JOIN FCLI FC ON FC.CLISEQ = FP.CLISEQ INNER JOIN FINV FI ON FI.ISEQ = FL.ISEQ LEFT JOIN FFAM FM1 ON FM1.FAMTNUM = FI.IFAM1 LEFT JOIN FFAM FM2 ON FM2.FAMTNUM = FI.IFAM2 LEFT JOIN FFAM FM3 ON FM3.FAMTNUM = FI.IFAM3";
    if ($ordInicio || $ordFin) {
        $criterios = "FP.PENUM LIKE 'Q%' AND FL.PLTIPMV = 'Q' AND FI.ICODPRV <> '' AND FP.PEHIJOS <> 0 AND FC.CLICOD = '" . $clicod . "' AND FP.PENUM BETWEEN '" . $ordInicio . "' AND '" . $ordFin . "' GROUP BY FC.CLICOD, FP.PENUM, FI.IRAIZ ORDER BY FP.PENUM;";
        $cond=true;
    } else {
        $criterios = "FP.PENUM LIKE 'Q%' AND FL.PLTIPMV = 'Q' AND FI.ICODPRV <> '' AND FP.PEHIJOS <> 0 AND FC.CLICOD = '" . $clicod . "' GROUP BY FC.CLICOD, FP.PENUM, FI.IRAIZ ORDER BY FP.PENUM;";
        $cond=false;
    }
    $tbl = "";
    $rs = $query->Consultar_Proscai($campos, $tablas, $criterios, "");
    if ($rs->RecordCount() > 0) {
        $tbl = "<div class='table-responsive'><table  id='mytable' class='table table-bordered table-hover' style='display: block; font-size: 13px'><thead>";
        $tbl .= "<th style='text-align: center'>CLIENTE</th>";
        $tbl .= "<th style='text-align: center'>PEDIDO</th>";
        $tbl .= "<th style='text-align: center'>ORDEN</th>";
        $tbl .= "<th style='text-align: center'>SEMANA</th>";
        $tbl .= "<th style='text-align: center'>FECHA</th>";
        $tbl .= "<th style='text-align: center'>MODELO_CTE</th>";
        $tbl .= "<th style='text-align: center'>COLOR_CTE</th>";
        $tbl .= "<th style='text-align: center'>PEFECHA</th>";
        $tbl .= "<th style='text-align: center'>PEVENCE</th>";
        $tbl .= "<th style='text-align: center'>MODELO</th>";
        $tbl .= "<th style='text-align: center'>MARCA</th>";
        $tbl .= "<th style='text-align: center'>DEPTO</th>";
        $tbl .= "<th style='text-align: center'>PRODUCTO</th>";
        $tbl .= "<th style='text-align: center'>PV</th>";
        $tbl .= "<th style='width:5px'></th>";
        $tbl .= "<th style='width:5px'></th>";
        $tbl .= "</tr></thead><tbody>";
        while (!$rs->EOF) {
            $r1 = $query->Consultar("F.ID_FICHA, F.ORDEN, F.PEDIDO, FL.ID_LABORATORIO, FL.ID_FICHA AS FICHA_LAB, FL.ID_VARIANTE", "FFICHA F LEFT JOIN FLABORATORIO FL ON FL.ID_FICHA = F.ID_FICHA", "F.PEDIDO LIKE '" . $rs->fields['PENUM'] . "'", ""); //
            
            $tbl .= "<tr>";
            $tbl .= "<td>" . $rs->fields['CLICOD'] . "</td>";
            $tbl .= "<td>" . $rs->fields['PENUM'] . "</td>";
            $tbl .= "<td>" . $rs->fields['PENUMELLOS'] . "</td>";
            $tbl .= "<td>" . $rs->fields['SEMANA'] . "</td>";
            $tbl .= "<td>" . $rs->fields['FECHA'] . "</td>";
            $tbl .= "<td>" . $rs->fields['MODELO_CTE'] . "</td>";
            $tbl .= "<td>" . $rs->fields['COLOR_CTE'] . "</td>";
            $tbl .= "<td>" . $rs->fields['PEFECHA'] . "</td>";
            $tbl .= "<td>" . $rs->fields['PEVENCE'] . "</td>";
            $tbl .= "<td>" . $rs->fields['IRAIZ'] . "</td>";
            $tbl .= "<td>" . $rs->fields['MARCA'] . "</td>";
            $tbl .= "<td>" . $rs->fields['DEPTO'] . "</td>";
            $tbl .= "<td>" . $rs->fields['PRODUCTO'] . "</td>";
            $tbl .= "<td>" . $rs->fields['PV'] . "</td>";
            if ($r1->RecordCount() > 0) {
                $id_f = $r1->fields['ID_FICHA'];
                //   $ficha = "<a href='#' id='id_".$r1->fields['ID_FICHA']."' style='color:black;' onclick=\"Abrir_Modal(".$r1->fields['ID_FICHA'].")\"><i class='fas fa-file-pdf'></i>&nbsp;</a>";
                $ficha = "<div class='' role='group' aria-label='Basic checkbox toggle button group'>";
                $ficha .= "<input type='checkbox' class='btn-check' id=" . $r1->fields['ID_FICHA'] . " 'autocomplete='off'>";
                $ficha .= "<label class='btn btn-outline-primary' for=" . $r1->fields['ID_FICHA'] . "></label></div>";
                $tbl .= "<td>" . $ficha . "</td>";
            }
            if ($r1->fields['ID_FICHA']) {
                $tbl .= "<td><a href='#' id='id_" . $rs->fields['PENUM'] . "' style='color:black;' onclick=\"Abrir_Modal_Lab(" . $r1->fields['ID_FICHA'] . ");\"><i class='fas fa-edit'></i>&nbsp;</a></td>";
                $tbl .= "<td><button type='button' class='btn btn-primary' onclick='Modal_Lab(" . $r1->fields['ID_FICHA'] . ");'><i class='nav-icon fas fa-microscope'></i></button></td>";
            } else {
                $tbl .= "<td></td>";
                $tbl .= "<td></td>";
                
                
            }
            $tbl .= "</tr></div>";
            $rs->MoveNext();
        }
        $tbl .= "</tbody></table>";
        echo $tbl;
    } else echo "<H5>Sin resultados</H5>";
} else if ($tp == 'laboratorio') {
    $ficha = $_POST['ficha'];
    $tbl = "";
    $rm = $query->Consultar("CB.ID_COMBINACION, CB.ID_CAT_COMBINACION, CT.CORTA,MAX(FV.VARIANTE)AS NUM, FV.COLOR", "FCOMBINACIONES CB LEFT JOIN FCAT_COMBINACION CT ON CT.ID_CAT_COMBINACION = CB.ID_CAT_COMBINACION LEFT JOIN FVARIANTES FV ON FV.ID_COMBINACION=CB.ID_COMBINACION", "CB.ID_FICHA =" . $ficha . " AND CB.ID_CAT_COMBINACION NOT IN (7,8,9,10,11,12,13) GROUP BY CB.ID_COMBINACION", "");
    if ($rm->RecordCount() > 0) {
        $comb = $rm->fields['ID_COMBINACION'];
        $cont = $rm->fields['NUM'];
        $comb = $rm->fields['ID_COMBINACION'];
        $rj = $query->Consultar("*", "FVARIANTES", "ID_COMBINACION=" . $comb . "", "");
        $tbl .= "<div class='table-responsive'><table  id='mytable' class='table table-bordered table-hover' style='display: block; font-size: 13px'><thead>";
        $tbl .= "<tr><th></th><th colspan='8'>Variantes</th></tr><tr><th>Tipo</th>";
        $i = 1;
        while (!$rj->EOF) {
            $tbl .= "<th>V" . $rj->fields['VARIANTE'] . " " . $rj->fields['COLOR'] . "</th>";
            $i = $i + 1;
            $rj->MoveNext();
        }
        $tbl .= "</tr></thead><tbody>";
        $color = "";
        while (!$rm->EOF) {
            $tipo = $rm->fields['ID_CAT_COMBINACION'];
            $comb1 = $rm->fields['ID_COMBINACION'];
            $tbl .= "<tr id='row" . $tipo . "'><td>" . $rm->fields['CORTA'] . "</td>";
            $rv = $query->Consultar("*", "FVARIANTES", "ID_COMBINACION =" . $comb1, "");
            if ($rv->RecordCount() > 0) {
                $tela = "";
                while (!$rv->EOF) {
                    $vari = $rv->fields['ID_VARIANTE'];
                    $icod = $rv->fields['ICOD'];
                    $icod2 = $rv->fields['ICOD2'];
                    $corta = $rm->fields['CORTA'];
                    $color = $rv->fields['COLOR'];
                    if ($rv->fields['ICOD2'] != '') {
                        $tela .= $rv->fields['ICOD2'] . "_" . $rv->fields['IDESCR2'] . "@" . $rv->fields['PRV_FACT2'];
                    }
                    if ($rv->fields['ICOD2']) {
                        $tbl .= "<td>";
                        $tbl .= $rv->fields['ICOD'] . " " . "<a href='#' id='btn_modal_lab" . $rv->fields['ID_VARIANTE'] . "' onclick=\"Modal_Lab(" . $comb1 . "," . $vari . ",'" . $icod . "','" . $corta . "','" . $color . "',1)\"><i class='fas fa-file-signature fa-1x'></i></a><br>";
                        $tbl .= $rv->fields['ICOD2'] . " " . "<a href='#' id='btn_modal_lab" . $rv->fields['ID_VARIANTE'] . "' onclick=\"Modal_Lab(" . $comb1 . "," . $vari . ",'" . $icod2 . "','" . $corta . "','" . $color . "',2)\"><i class='fas fa-file-signature fa-1x'></i></a><br>";
                        $tbl .= "</td>";
                    } else {
                        $tbl .= "<td>";
                        $tbl .= $rv->fields['ICOD'] . " " . "<a href='#' id='btn_modal_lab" . $rv->fields['ID_VARIANTE'] . "' onclick=\"Modal_Lab(" . $comb1 . "," . $vari . ",'" . $icod . "','" . $corta . "','" . $color . "',1)\"><i class='fas fa-file-signature fa-1x'></i></a><br>";
                        $tbl .= "</td>";
                    }
                    $tbl .= "</td>";
                    $rv->MoveNext();
                }
            }
            $rm->MoveNext();
        }
        $tbl .= "</tbody></table></div>";
        echo $tbl;
    } else echo 0;
}
