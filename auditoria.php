<?php
include_once('registro.php');
$query = new Registro();
?>
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<br>
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks"></i>  Auditor&iacute;a</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#modelo" data-toggle="tab">Modelo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#medidas" data-toggle="tab">Medidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#visual" data-toggle="tab">Etiquetas/Visual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#resultado" data-toggle="tab">Resultados</a>
                        </li>
                        <li class="nav-item">
                            <div class="input-group">
                                <input style="width: 80px" id="tbuscar" type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" maxlength="6" autofocus="autofocus">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="#" id="btn_buscar" onclick="Buscar_Orden();"><i class="fas fa-search"></i></a></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <form id="fauditoria">
            <div class="card-body">
                <input type="hidden" id="id_ficha">
                <div class="tab-content p-0" style="border: solid 0px blue">
                    <br><br>
                    <div class="chart tab-pane active" id="modelo" style="position: relative; border: solid 0px purple;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Orden</label><input type="text" name="norden" class="form-control" id="torden" tabindex="1" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Modelo</label><input type="text" name="nmodel" class="form-control" id="tmodel" tabindex="2" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Prenda</label>
                                    <select class="custom-select" id="cmbprenda" name="ncmbprenda" tabindex="3" disabled>
                                        <option value="0"></option>
                                        <optgroup>
                                            <?php
                                            $rs = $query->Consultar("*","FCAT_PRENDA","STATUS > 0","ID_PRENDA");
                                            while(!$rs->EOF){
                                                echo "<option value='".$rs->fields['ID_PRENDA']."'>".$rs->fields['PRENDA']."</option>";
                                                $rs->MoveNext();
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Color</label><input type="text" name="ncolor" class="form-control" id="tcolor" tabindex="4">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Maquilero</label>
                                    <select class="custom-select" id="cmbmaquilero" name="ncmbmaquilero" tabindex="5">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">MBONI4</option>
                                            <option value="2">MBREA1</option>
                                            <option value="3">MCANO</option>
                                            <option value="4">MCATAL</option>
                                            <option value="1">MCATEX</option>
                                            <option value="2">MEDGAR</option>
                                            <option value="3">MELVA1</option>
                                            <option value="4">MDOMI</option>
                                            <option value="1">MGLOR2</option>
                                            <option value="2">MKOSME</option>
                                            <option value="3">MKSD</option>
                                            <option value="4">MMAYA</option>
                                            <option value="1">MPOSA1</option>
                                            <option value="2">MTZFAS</option>
                                            <option value="3">MARACE</option>
                                            <option value="4">MYAMI</option>
                                            <option value="4">MOMAR</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <select class="custom-select" id="cmbcliente" name="ncmbcliente" tabindex="6" disabled>
                                        <option value="0"></option>
                                        <optgroup>
                                            <?php
                                            $rs = $query->Consultar("*","FCAT_CLIENTE","STATUS > 0","ID_CLIENTE");
                                            while(!$rs->EOF){
                                                echo "<option value='".$rs->fields['ID_CLIENTE']."'>".$rs->fields['CLIENTE']."</option>";
                                                $rs->MoveNext();
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <select class="custom-select" id="cmbmarca" name="ncmbmarca" tabindex="7" disabled>
                                        <option value="0"></option>
                                        <optgroup>
                                            <?php
                                            $rs = $query->Consultar("*","FCAT_MARCA","STATUS > 0","ID_MARCA");
                                            while(!$rs->EOF){
                                                echo "<option value='".$rs->fields['ID_MARCA']."'>".$rs->fields['MARCA']."</option>";
                                                $rs->MoveNext();
                                            }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Talla</label>
                                    <div id="dv_talla"><select class="custom-select" id="cmbtalla" name="ncmbtalla" tabindex="8">
                                        <option value="0">Seleccione la talla</option>
                                        <optgroup>
                                            <option value="1">XCH</option>
                                            <option value="2">CH</option>
                                            <option value="3">M</option>
                                            <option value="4">G</option>
                                            <option value="5">XG</option>
                                            <option value="6">XXG</option>
                                        </optgroup>
                                    </select></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Graduadora</label><input type="text" name="ngraduadora" class="form-control" id="tgraduadora" tabindex="9" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Composici&oacute;n</label><input type="text" name="ncomposicion" class="form-control" id="tcomposicion" tabindex="10" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Dictamen</label>
                                    <select class="custom-select" id="cmbdictamen" name="ncmbdictamen" tabindex="11">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Aceptado</option>
                                            <option value="2">Aceptado marginal</option>
                                            <option value="3">Aceptado condicionado</option>
                                            <option value="4">Rechazado</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Observaciones grals.</label>
                                    <textarea class="form-control" rows="5" name="nobservaciones" id="tobservaciones" placeholder="Ingrese el texto..." style="resize: none" tabindex="12"></textarea>
                                </div>
                            </div>
                            <div class="border-left d-sm-none d-md-block" style="width: 0px;"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Muestra original</label>
                                    <select class="custom-select" id="cmbmuestra" name="ncmbmuestra" tabindex="13">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                            <option value="3">N/A</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ficha confecci&oacute;n</label>
                                    <select class="custom-select" id="cmbficha" name="ncmbficha" tabindex="14">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                            <option value="3">N/A</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Informaci&oacute;n ficha confecci&oacute;n</label>
                                    <select class="custom-select" id="cmbinfo" name="ncmbinfo" tabindex="15">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                            <option value="3">N/A</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Congruencia ficha conf vs Muestra</label>
                                    <select class="custom-select" id="cmbficha_muestra" name="ncmbficha_muestra" tabindex="16">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                            <option value="3">N/A</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cong muestra vs Contramuestra</label>
                                    <select class="custom-select" id="cmbmuestra_contra" name="ncmbmuestra_contra" tabindex="17">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                            <option value="3">N/A</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Cong ficha conf vs Contramuestra</label>
                                    <select class="custom-select" id="cmbficha_contra" name="ncmbficha_contra" tabindex="18">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                            <option value="3">N/A</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary" id="btn_auditoria" onclick="Registrar_Auditoria();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="medidas" style="position: relative;">
                        <div class="container" id="dv_medidas"></div><!--Se llena-->
                    </div>
                    <div class="chart tab-pane" id="visual" style="position: relative;">
                        <table class="table table-borderless">
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Etiqueta Monarch</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Inf. Monarch</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Etiqueta colgante</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Etiqueta bordada</label>
                                </td>
                                <td width="5%">
                                    <label>Otro/especifique</label>
                                </td>
                                <td width="20%">
                                    <input type="text" name="nmodcliente" class="form-control" id="tmodcliente" tabindex="3">
                                </td>
                            </tr>
                        </table>
                        <hr><br>
                        <table class='table table-borderless'>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Prueba de Fit</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Tensiones</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Pespuntes Uniformes</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Cuello</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Bolsas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Dobladillo</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Fusionado</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Ppp internas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Pretinas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Aletilla/Solapa</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Elastico</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Plancha</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Tono de hilo</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Ppp externas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Carteras</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Puño</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Mangas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Vistas</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Calibre de hilo</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Sisas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Trabas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Cierre</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Hombros</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Aplicaciones</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Tirantes</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Simetria</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Case de costuras</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Bies</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Encuartes</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Deshebrado</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Olanes/Alforzas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Cost. en sucio</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Tono de prenda</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Ojal y boton</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Manchas</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Terminado</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Otra muestra</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Comb. tela</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="20%">
                                    <label>Comb. de habilitaciones</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Cinturones</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Botones</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Cierres</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Vivos</label>
                                </td>
                                <td width="5%">
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0"></option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                        <option value="3">N/A</option>
                                    </select>
                                </td>
                                <td width="10%">
                                    <label>Tiros</label>
                                </td>
                                <td width="5%"></td>
                                <td width="20%"></td>
                                <td width="5%"></td>
                                <td width="10%"></td>
                                <td width="5%"></td>
                                <td width="10%"></td>
                                <td width="5%"></td>
                                <td width="10%"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="chart tab-pane" id="resultado" style="position: relative;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Hallazgo</label><input type="text" class="form-control" id="thallazgo" tabindex="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Accion correctiva</label>
                                    <textarea class="form-control" id="tcorrectiva" rows="3" placeholder="Ingrese el texto..." tabindex="2" style="resize: none"></textarea>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group"><br><br><button type="button" id="btn_hallazgo" class="btn btn-primary btn-sm" onclick="Agregar_Hallazgo();" tabindex="3">Agregar</button>
                                </div>
                            </div>
                            <div class="col-md-6" style="border: solid 1px red"></div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="card-footer" align="center">
                <!--<button type="button" class="btn btn-primary" onclick="Registrar_Tutor();">Guardar</button>-->
            </div>
        </div>
    </div>
</section>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
        bsCustomFileInput.init();
        $('#tnom_tu').focus();
        $('[data-mask]').inputmask()
    });

    $(document).ready(function() {

        $('#tbuscar').keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                Buscar_Orden();
            }
        });
    });

    function Buscar_Orden() {
        $('#btn_buscar').blur();
        if($.trim($('#tbuscar').val()) == ''){
            swal({title: 'Ingrese la orden.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#tbuscar').focus();
            return;
        }

        var param ='orden='+$('#tbuscar').val().toUpperCase()+'&tp=orden';

        $.ajax({
            url: 'consultas/busquedas_auditoria.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function (data) {
                if (data != 0) {
                    var str = data.split('|');
                    var res = str[0].split('@');
                    $('#torden').val(res[0]);
                    $('#tmodel').val(res[1]);
                    $('#cmbprenda').val(res[2]);
                    $('#cmbcliente').val(res[3]);
                    $('#cmbmarca').val(res[4]);
                    $('#tgraduadora').val(res[5]);
                    $('#id_ficha').val(res[6]);
                    $('#dv_talla').html(str[1]);
                    //swal({title: "Se registraron las actividades", timer: 1000, showConfirmButton: false});
                }else{
                    alert('No existe loy.!!');
                }
            },
            error: function (request, status, error) {
                swal("Ha ocurrido un error");
            }
        });
    }

    function Buscar_Medidas(nm){
        var param = 'id='+$('#id_ficha').val()+'&talla='+nm+'&tp=medidas';

        $.ajax({
            url: 'consultas/busquedas_auditoria.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function (data) {
                $('#dv_medidas').html(data);
            },
            error: function (request, status, error) {
                swal("Ha ocurrido un error");
            }
        });
    }

    function Agregar_Hallazgo() {
        $('#btn_hallazgo').blur();

        if($.trim($('#thallazgo').val())==''){
            swal({title: "Ingrese el hallazgo.!!", timer: 1000, showConfirmButton: false});
            $('#thallazgo').focus();
            return;
        }
        if($.trim($('#tcorrectiva').val())==''){
            swal({title: "Ingrese la acccion correctiva.!!", timer: 1000, showConfirmButton: false});
            $('#tcorrectiva').focus();
            return;
        }

        alert($.trim($('#thallazgo').val().toUpperCase())+'|'+$.trim($('#tcorrectiva').val().toUpperCase()));

    }

    function Registrar_Auditoria() {
        var param = $('#fauditoria').serialize();
            param+= '&accion=Registrar_Auditoria';
        alert(param);
        //$('#falumnos').trigger("reset");

        /*$.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function (data) {
                if (data == 1) {
                    //swal({title: "Se registraron las actividades", timer: 1000, showConfirmButton: false});
                    Ajax_Dinamico('alumnos.php', 'centro', '');
                }
            },
            error: function (request, status, error) {
                swal("Ha ocurrido un error");
            }
        });*/
    }
</script>