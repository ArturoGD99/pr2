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
<style>
    .myFont {
        font-size: 11px;
    }
</style>
<br>
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Modelo</h3>&nbsp;&nbsp;&nbsp;
                <!--fas fa-tshirt-->
                <h3 class="card-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a id="mdl" href="#" onclick="Abrir_Modal();" style="color: black; display: none" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content">
                        <i class="fas fa-file-pdf"></i>&nbsp;PDF
                    </a>
                </h3>
                <h3 class="card-title">&nbsp;&nbsp;&nbsp;
                    <a id="add_med" href="#" onclick="Agregar_Medida();" style="color: black; display: none">
                        <i class="fas fa-plus-square"></i>&nbsp;Agregar
                    </a>
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li id="lmodelo" class="nav-item"><a class="nav-link active" href="#modelo" onclick="Validar_Tab(0)" data-toggle="tab">Modelo</a></li>
                        <!--<li class="nav-item"><a class="nav-link" href="#combinaciones" data-toggle="tab">Combinaciones</a></li>-->
                        <li id="lcombinaciones" class="nav-item"><a class="nav-link" href="#combinaciones2" onclick="Validar_Tab(0)" data-toggle="tab">Combinaciones</a></li>
                        <li id="lhabil" class="nav-item"><a class="nav-link" href="#habil" onclick="Validar_Tab(0)" data-toggle="tab">Habilitación</a></li>
                        <li id="lcomposicion" class="nav-item"><a class="nav-link" href="#composicion" onclick="Validar_Tab(0)" data-toggle="tab">Composición</a></li>
                        <li id="lpzas" class="nav-item"><a class="nav-link" href="#pzas" onclick="Validar_Tab(0)" data-toggle="tab">Piezas</a></li>
                        <li id="lmedidas" class="nav-item"><a class="nav-link" id="tab_med" href="#medidas" onclick="Validar_Tab(1)" data-toggle="tab">Medidas</a></li>
                        <li id="lindicaciones" class="nav-item"><a class="nav-link" href="#indicaciones" onclick="Validar_Tab(0)" data-toggle="tab">Indicaciones</a></li>
                        <!--<li id="llaboratorio" class="nav-item"><a id='Lab_pestana'class="nav-link " href="#laboratorio" onclick="Validar_Tab(0)" data-toggle="tab">Laboratorio</a></li>-->
                        <li class="nav-item">
                            <div class="input-group">
                                <input style="width: 85px" id="tbuscar" type="text" class="form-control" placeholder="Buscar" aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" maxlength="7" autofocus="autofocus">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="#" id="btn_buscar" onclick="Buscar_Pedido();"><i class="fas fa-search"></i></a></span>
                                </div>
                            </div>
                        </li>
                        <!--<li class="nav-item">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div id="progress" class="col-md-9">
                                    <div class="input-group">
                                        <input id="tbuscar" type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" maxlength="6" autofocus="autofocus">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="#" id="btn_buscar" onclick="Buscar_Pedido();"><i class="fas fa-search"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="card-body"><input type="hidden" id="id_ficha"><input type="hidden" id="cor" value="">
                <div class="tab-content p-0" style="border: solid 0px blue">
                    <div class="chart tab-pane active" id="modelo" style="position: relative; border: solid 0px purple;">
                        <br><br>
                        <form id="fmodelo">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Modelo</label><input type="text" class="form-control" id="tmodel" name="nmodelo" tabindex="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Orden</label><input type="text" name="norden" class="form-control" id="torden" tabindex="2">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Pedido</label><input type="text" name="npedido" class="form-control" id="tpedido" tabindex="3" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select class="custom-select" id="cmbcliente" name="ncmbcliente" onchange="Buscar_Marcas();" tabindex="9">
                                            <option value="0"></option>
                                            <optgroup>
                                                <?php
                                                $rs = $query->Consultar("*", "FCAT_CLIENTE", "STATUS > 0", "ID_CLIENTE");
                                                while (!$rs->EOF) {
                                                    echo "<option value='" . $rs->fields['ID_CLIENTE'] . "'>" . $rs->fields['CLIENTE'] . "</option>";
                                                    $rs->MoveNext();
                                                }
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <div id="dv_marca">
                                            <select class="custom-select" id="cmbmarca" name="ncmbmarca" tabindex="4">
                                                <option value="0"></option>
                                                <optgroup></optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Linea</label>
                                        <div id="dv_linea">
                                            <select class="custom-select" id="cmblinea" name="ncmblinea" tabindex="9">
                                                <option value="0"></option>
                                                <optgroup>
                                                    <?php
                                                    $rs = $query->Consultar("*", "FCAT_LINEA", "STATUS > 0", "");
                                                    while (!$rs->EOF) {
                                                        echo "<option value='" . $rs->fields['ID_LINEA'] . "'>" . utf8_encode($rs->fields['LINEA']) . "</option>";
                                                        $rs->MoveNext();
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Semana</label><input type="text" class="form-control" id="tsemana" name="nsemana" tabindex="7" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Temporada</label><input type="text" name="ntemporada" class="form-control" id="ttemporada" tabindex="8">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Diseñadora</label>
                                        <select class="custom-select" id="cmbdisenadora" name="ncmbdisenadora" tabindex="9">
                                            <option value="0"></option>
                                            <optgroup>
                                                <option value="ARELY MARTINEZ" selected>ARELY MARTINEZ</option>
                                                <!--<option value="DISENADORA 2">DISENADORA 2</option>
                                                <option value="DISENADORA 3">DISENADORA 3</option>
                                                <option value="DISENADORA 4">DISENADORA 4</option>-->
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Prenda</label>
                                        <div id="dv_prenda">
                                            <select class="custom-select" id="cmbprenda" name="ncmbprenda" tabindex="4">
                                                <option value="0"></option>
                                                <optgroup>
                                                    <?php
                                                    $rs = $query->Consultar("*", "FCAT_PRENDA", "STATUS > 0", "ID_PRENDA");
                                                    while (!$rs->EOF) {
                                                        echo "<option value='" . $rs->fields['ID_PRENDA'] . "'>" . $rs->fields['PRENDA'] . "</option>";
                                                        $rs->MoveNext();
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Talla</label>
                                        <!--<div id="dv_talla">-->
                                        <select class="custom-select" id="cmbtalla" name="ncmbtalla" tabindex="4">
                                            <option value="0"></option>
                                            <optgroup>
                                                <?php
                                                $rs = $query->Consultar("*", "FCAT_TALLA", "STATUS > 0", "ID_TALLA");
                                                while (!$rs->EOF) {
                                                    echo "<option value='" . $rs->fields['ID_TALLA'] . "'>" . $rs->fields['TALLA'] . "</option>";
                                                    $rs->MoveNext();
                                                }
                                                ?>
                                            </optgroup>
                                        </select>
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Patronista</label>
                                        <select class="custom-select" id="cmbpatronista" name="ncmbpatronista" tabindex="9">
                                            <option value="0"></option>
                                            <optgroup>
                                                <option value="GUADALUPE ESQUIVEL">GUADALUPE ESQUIVEL</option>
                                                <option value="JOSEFINA MARQUEZ">JOSEFINA MARQUEZ</option>
                                                <option value="ERIKA BARTOLO">ERIKA BARTOLO</option>
                                                <option value="XANAT MARQUEZ">XANAT MARQUEZ</option>
                                                <option value="MARGARITA ROJAS">MARGARITA ROJAS</option>
                                                <option value="PATRICIA PALMA">PATRICIA PALMA</option>
                                                <option value="DIANA PRIETO">DIANA PRIETO</option>
                                                <option value="KARLA GONZALEZ">KARLA GONZALEZ</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Muestrista</label>
                                        <select class="custom-select" id="cmbmuestrista" name="ncmbmuestrista" tabindex="9">
                                            <option value="0"></option>
                                            <optgroup>
                                                <option value="ERIKA VILLANUEVA">ERIKA VILLANUEVA</option>
                                                <option value="LUCY CAL Y MAYOR">LUCY CAL Y MAYOR</option>
                                                <option value="CARMEN JIMENEZ">CARMEN JIMENEZ</option>
                                                <option value="ANGEL GARCIA">ANGEL GARCIA</option>
                                                <option value="DANIEL POSADAS">DANIEL POSADAS</option>
                                                <option value="ROCIO GOMEZ">ROCIO GOMEZ</option>
                                                <!--<option value="CELIA ROSAS">CELIA ROSAS</option>
                                                <option value="PATRICIA OJEDA">PATRICIA OJEDA</option>
                                                <option value="ESTHER RESENDIZ">ESTHER RESENDIZ</option>
                                                <option value="ISABEL RIVERA">ISABEL RIVERA</option>-->
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Graduadora</label>
                                        <select class="custom-select" id="cmbgraduadora" name="ncmbgraduadora" tabindex="9">
                                            <option value="0"></option>
                                            <optgroup>
                                                <option value="JOSEFINA MARQUEZ">JOSEFINA MARQUEZ</option>
                                                <option value="GUADALUPE ESQUIVEL">GUADALUPE ESQUIVEL</option>
                                                <option value="ERIKA BARTOLO">ERIKA BARTOLO</option>
                                                <option value="XANAT MARQUEZ">XANAT MARQUEZ</option>
                                                <option value="MARGARITA ROJAS">MARGARITA ROJAS</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Igual a</label><input type="text" name="nigual" class="form-control" id="tigual" tabindex="3">
                                    </div>
                                </div>
                                <!--<div class="col-md-2">
                                    <div class="form-group">
                                        <label>Mod cliente</label><input type="text" name="nmodcliente" class="form-control" id="tmodcliente" tabindex="3" readonly>
                                    </div>
                                </div>-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cantidad</label><input type="text" name="ncantidad" class="form-control" id="tcantidad" tabindex="12" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <!--<input type="text" name="ndescripcion" class="form-control" id="tdescripcion" tabindex="10">-->
                                        <textarea id="tdescripcion" rows="2" name="ndescripcion" class="form-control" style="resize: none;"></textarea>
                                    </div>
                                </div>
                            </div><br>
                            <hr><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Corrida</label>
                                        <div id="dv_corrida" class="input-group"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Subir imagen </label><input id="timagen" name="nimagen" accept="image/jpg, image/jpeg" type="file" tabindex="4">
                                        <!--accept="image/jpeg,image/png"-->
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-1"><button type="button" class="btn btn-primary" id="btn_model" onclick="Registrar_Modelo();">Guardar</button></div>
                                <div id="dv_duplicar" class="col-md-1"><button type="button" style="display: none;" class="btn btn-success" id="btn_duplicar" onclick="Duplicar();">Duplicar</button></div>
                                <div class="col-md-5"></div>
                            </div>
                        </form>
                    </div>
                    <!--<div class="chart tab-pane" id="combinaciones" style="position: relative;">
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive p-0">
                                <table class="table table-bordered" style="font-size: 12px">
                                    <thead>
                                        <tr align="center">
                                            <th>Variantes</th>
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 150px; min-width: 210px; max-width: 150px;">
                                                <div class="form-group">
                                                    Tipo:
                                                    <select style="width: 100%;" class="form-control select2" id="cmbtipo" name="ncmbtipo" tabindex="9">
                                                        <option value="0">Seleccione la opci&oacute;n</option>
                                                        <optgroup>
                                                            <?php
                                                            /*$rs = $query->Consultar("*","FCAT_COMBINACION","ID_CAT_COMBINACION NOT IN (8,10)","ID_CAT_COMBINACION");// AND ISTKACT > 0
                                                            while(!$rs->EOF){
                                                                echo "<option value='".$rs->fields['ID_CAT_COMBINACION']."'>".$rs->fields['COMBINACION']."</option>";
                                                                $rs->MoveNext();
                                                            }*/
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <input id="tid_comb" type="hidden">
                                                <br><br><br><br><br>
                                                <div class="col-md-3" style="display: inline-block;"></div>
                                                <div class="col-md-5" style="display: inline-block;"><button type="button" class="btn btn-primary" id="btn_combinacion" onclick="if($('#btn_combinacion').html()=='Agregar'){Ingresar_Combinacion();}else{Actualizar_Combinacion();}">Agregar</button></div>
                                                <div class="col-md-3" style="display: inline-block;"></div>
                                            </td>
                                            <td style="width: 150px; min-width: 210px; max-width: 150px;">
                                                <div class="form-group">
                                                    Color:  <input type="text" id="tcolor1">
                                                </div>
                                                <div class="form-group">
                                                    Tela:
                                                    <select style="width: 100%" class="form-control select2" id="cmbtela1" name="ncmbtela1" onchange="Buscar_Proveedor(1);" tabindex="9">
                                                        <option value="0">Seleccione la opci&oacute;n</option>
                                                        <optgroup>
                                                            <?php
                                                            /*$rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%' AND ISTKACT > 0","ICOD");// AND ISTKACT > 0
                                                            while(!$rs->EOF){
                                                                echo "<option value='".$rs->fields['ICOD']."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                                                $rs->MoveNext();
                                                            }*/
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv1">
                                                                <select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv2">
                                                                <select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura1"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura2"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 150px; min-width: 210px; max-width: 150px;">
                                                <div class="form-group">
                                                    Color:  <input type="text" id="tcolor2">
                                                </div>
                                                <div class="form-group">
                                                    Tela:
                                                    <select style="width: 100%" class="form-control select2" id="cmbtela2" name="ncmbtela2" onchange="Buscar_Proveedor(2);" tabindex="9">
                                                        <option value="0">Seleccione la opci&oacute;n</option>
                                                        <optgroup>
                                                            <?php
                                                            /*$rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%' AND ISTKACT > 0","ICOD");// AND ISTKACT > 0
                                                            while(!$rs->EOF){
                                                                echo "<option value='".$rs->fields['ICOD']."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                                                $rs->MoveNext();
                                                            }*/
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv3"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv4"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura3"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura4"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 150px; min-width: 210px; max-width: 150px;">
                                                <div class="form-group">
                                                    Color:  <input type="text" id="tcolor3">
                                                </div>
                                                <div class="form-group">
                                                    Tela:
                                                    <select style="width: 100%" class="form-control select2" id="cmbtela3" name="ncmbtela3" onchange="Buscar_Proveedor(3);" tabindex="9">
                                                        <option value="0">Seleccione la opci&oacute;n</option>
                                                        <optgroup>
                                                            <?php
                                                            /*$rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%' AND ISTKACT > 0","ICOD");// AND ISTKACT > 0
                                                            while(!$rs->EOF){
                                                                echo "<option value='".$rs->fields['ICOD']."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                                                $rs->MoveNext();
                                                            }*/
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv5"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv6"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura5"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura6"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 150px; min-width: 210px; max-width: 150px;">
                                                <div class="form-group">
                                                    Color:  <input type="text" id="tcolor4">
                                                </div>
                                                <div class="form-group">
                                                    Tela:
                                                    <select style="width: 100%" class="form-control select2" id="cmbtela4" name="ncmbtela4" onchange="Buscar_Proveedor(4);" tabindex="9">
                                                        <option value="0">Seleccione la opci&oacute;n</option>
                                                        <optgroup>
                                                            <?php
                                                            /*$rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%' AND ISTKACT > 0","ICOD");// AND ISTKACT > 0
                                                            while(!$rs->EOF){
                                                                echo "<option value='".$rs->fields['ICOD']."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                                                $rs->MoveNext();
                                                            }*/
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv7"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv8"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura7"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura8"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 150px; min-width: 210px; max-width: 150px;">
                                                <form>
                                                <div class="form-group">
                                                    <label>Color: </label>&nbsp;<input type="text" id="tcolor5">
                                                </div>
                                                <div class="form-group row">
                                                    <label>Tela: </label>&nbsp;&nbsp;
                                                    <select class="select2" style="width: 85%;" id="cmbtela5" name="ncmbtela5" onchange="Buscar_Proveedor(5);" tabindex="9">
                                                        <option value="0">Seleccione la opci&oacute;n</option>
                                                        <optgroup>
                                                            <?php
                                                            /*$rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%' AND ISTKACT > 0","ICOD");// AND ISTKACT > 0
                                                            while(!$rs->EOF){
                                                                echo "<option value='".$rs->fields['ICOD']."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                                                $rs->MoveNext();
                                                            }*/
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv9"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Proveedor:
                                                            <div id="dv_prv10"><select style="width: 100%" class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup></optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="display: inline-block">
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura9"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                        <div class="form-group">
                                                            Factura:
                                                            <div id="dv_factura10"><select style="width: 100%"class="form-control" tabindex="9">
                                                                    <option value="0">      </option>
                                                                    <optgroup>
                                                                    </optgroup>
                                                                </select></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                    <div id="dv_comb" class="table-responsive">
                                        <table  id="mytable" class="table table-bordered table-hover" style="display: none; font-size: 12px">
                                            <thead>
                                            <tr align="center"><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th><th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th></th><th></th></tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div><input type="hidden" id="tcombinaciones">
                            </div>
                            </div>
                        </div>
                        <br>
                        <div id="dv_guardarC" class="row" style="display: none">
                            <div class="col-md-5"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary" id="btn_comb" onclick="Registrar_Combinacion();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>-->
                    <div class="chart tab-pane" id="combinaciones2" style="position: relative;">
                        <br>
                        <div id="dv_resultado" class="table-responsive">
                            <table id="mytable" class="table table-bordered table-hover" style="display: block; font-size: 12px">
                                <thead>
                                    <tr align="center">
                                        <th>TIPO</th>
                                        <th>VARIANTE 1</th>
                                        <th>VARIANTE 2</th>
                                        <th>VARIANTE 3</th>
                                        <th>VARIANTE 4</th>
                                        <th>VARIANTE 5</th>
                                        <th>VARIANTE 6</th>
                                        <th>VARIANTE 7</th>
                                        <th>VARIANTE 8</th>
                                        <th>VARIANTE 9</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr align="center">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button type='button' id='btn_modal_var' onclick="Modal_Variante()" class='btn btn-primary btn-xs'>Agregar</button></td>
                                        <td></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="habil" style="position: relative;">
                        <input type="hidden" id="tvar">
                        <!--Cantidad de variantes-->
                        <input type="hidden" id="tcor">
                        <!--Corrida-->
                        <input type="hidden" id="trango">
                        <!--Rango de id´s para actualizar habilitaciones-->
                        <div class="row">
                            <div id="dvp" class="col-md-4" style="border: solid 0px yellow">
                                <div id="dv_habilP" class="container"></div>
                            </div>
                            <div id="dvf" class="col-md-8" style="border: solid 0px red">
                                <div id="dv_habil" class="container"></div>
                            </div>
                        </div><br>
                        <div id="dv_btn_habil" class="row" style="display: none">
                            <div class="col-md-5"></div>
                            <div id="progress" class="col-md-2"><button type="button" class="btn btn-primary" id="btn_habil" onclick="Registrar_Habil();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="composicion" style="position: relative;"><br>
                        <input type="hidden" id="tid">
                        <input type="hidden" id="ttipo">
                        <input type="hidden" id="tnew">
                        <input type="hidden" id="totro">
                        <div id="dv_composicion"></div><br>
                        <div id="dv_otro" class="row">
                            <!--style="display: none"-->
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="custom-select" id="cmbtipo_otro" tabindex="9">
                                        <option value="0"></option>
                                        <optgroup>
                                            <option value="8">OTRO</option>
                                            <option value="10">ELASTICO</option>
                                            <option value="11">JARETA</option>
                                            <option value="12">SMOCK</option>
                                            <option value="13">CINTURON</option>
                                            <!--<option value="3">COMBINACION 2</option>
                                            <option value="4">COMBINACION 3</option>
                                            <option value="5">COMBINACION 4</option>
                                            <option value="6">COMBINACION 5</option>
                                            <option value="7">ENTRETELA</option>-->
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Descripcion</label><input type="text" class="form-control" id="tdesc_otro" tabindex="2">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Composicion</label><input type="text" class="form-control" id="tcomp_otro" tabindex="3">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;&nbsp;</label><br>
                                    <button style="width: 60%" id="btn_otro" type="button" class="btn btn-block btn-secondary btn-sm" onclick="Agregar_Otro();">Agregar</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="dv_tbl_otro" class="table-responsive">
                                    <table id="tbl_otro" class="table table-bordered table-hover" style="display: block; font-size: 15px">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Descripcion</th>
                                                <th>Composicion</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div><br>
                        <!--<input type="text" id="tpzas">-->
                        <input type="hidden" id="totro_str">
                        <div id="dv_btn_comp" class="row" style="display: none">
                            <div class="col-md-5"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary" id="btn_composicion" onclick="Registrar_Composicion();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="pzas" style="position: relative;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Descripcion</label><input type="text" class="form-control" id="tdesc" tabindex="2">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Cantidad</label><input type="text" class="form-control" id="tcant" tabindex="3" onkeypress="return Numerico(event);">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <div id="dv_tipop"><select class="custom-select" id="cmbtipoc" tabindex="9">
                                            <option value="0"></option>
                                            <optgroup>
                                                <option value="1">TELA BASE</option>
                                                <option value="2">COMBINACION 1</option>
                                                <option value="3">COMBINACION 2</option>
                                                <option value="4">COMBINACION 3</option>
                                                <option value="5">COMBINACION 4</option>
                                                <option value="6">COMBINACION 5</option>
                                                <option value="7">ENTRETELA</option>
                                                <option value="9">FORRO</option>
                                            </optgroup>
                                        </select></div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;&nbsp;</label><br>
                                    <button style="width: 60%" id="btn_agregar" type="button" class="btn btn-block btn-primary btn-sm" onclick="Agregar_Pieza();">Agregar</button>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <div id="dv_pzas" class="table-responsive">
                                    <table id="tbl_pzas" class="table table-bordered table-hover" style="display: none; font-size: 15px">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Tipo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <input type="hidden" id="tpzas">
                            <input type="hidden" id="tstr">
                        </div><br>
                        <div id="dv_guardar" class="row" style="display: none; border: solid 0px red">
                            <div class="col-md-5"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary" id="btn_pzas" onclick="Registrar_Pzas();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="medidas" style="position: relative;">
                        <input type="hidden" id="tcorrida">
                        <input type="hidden" id="tficha">
                        <!--<div id="dv_medidas" class="container"></div><br>-->
                        <div class="row">
                            <div id="dvm" class="col-md-8" style="border: solid 0px yellow">
                                <div id="dv_medidas" class="container"></div>
                            </div>
                            <div id="dvf" class="col-md-4" style="border: solid 0px red">
                                <div id="dvfoto" class="container"></div>
                            </div>
                        </div><br>
                        <div id="dv_btnMed" class="row" style="display: none; border: solid 0px red">
                            <div class="col-md-5"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary" id="btn_medidas" onclick="Registrar_Medidas();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="indicaciones" style="position: relative;">
                        <div class="row">
                            <!--<div class="col-md-2">
                                <div class="form-group">
                                    <label>Indicaciones Tejido</label>
                                    <textarea id="tindicaciones2" name="nindicaciones2" class="form-control" rows="5" placeholder="Ingrese el texto..." style="resize: none; text-transform: uppercase" maxlength="300"></textarea>
                                </div>
                            </div>-->
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rpunto" onclick="Validar_Check(1,'Tejido');">
                                                <!--checked-->
                                                <label for="rpunto">
                                                    Tejido de punto
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rplano" onclick="Validar_Check(2,'Tejido');">
                                                <label for="rplano">
                                                    Telar plano
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rnoplanchar" onclick="Validar_Check(1,'Planchado');">
                                                <!--checked-->
                                                <label for="rnoplanchar">
                                                    No planchar
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="rreves" onclick="Validar_Check(2,'Planchado');">
                                                <label for="rreves">
                                                    Planchar por el reves
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Indicaciones Cuidado</label>
                                    <textarea id="tindicaciones4" name="nindicaciones4" class="form-control" rows="5" placeholder="Ingrese el texto..." style="resize: none; text-transform: uppercase" maxlength="300"></textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Indicaciones grals.</label>
                                    <textarea id="tindicaciones" name="nindicaciones" class="form-control" rows="5" placeholder="Ingrese el texto..." style="resize: none; text-transform: uppercase" maxlength="300"></textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Indicaciones Corte</label>
                                    <textarea id="tindicaciones3" name="nindicaciones3" class="form-control" rows="5" placeholder="Ingrese el texto..." style="resize: none; text-transform: uppercase" maxlength="300"></textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Molde de referencia</label>
                                    <textarea id="tindicaciones5" name="nindicaciones5" class="form-control" rows="5" placeholder="Ingrese el texto..." style="resize: none; text-transform: uppercase" maxlength="300"></textarea>
                                </div>
                            </div>
                        </div><br>
                        <input type="hidden" id="tid_ind">
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-2"><button type="button" class="btn btn-primary" id="btn_indicaciones" onclick="Registrar_Indicaciones();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="laboratorio" style="position: relative;">
                        <div class="col-md-12">
                            <div id="dv_tbl_lab" class="table-responsive">
                                <table id="tbl_lab" class="table table-bordered table-hover " style="display: block; font-size: 15px"></table>
                            </div>
                        </div>
                        <div class="modal fade in" id="modal_lab" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl " style="width:1000vh;" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalScrollableTitle"></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Limpiar_Modal_Lab();">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="container">
                                        <h6 class="modal-data"></h6>
                                    </div>
                                    <div class="modal-body">
                                        <form id='flaboratorio'>
                                            <input type="hidden" name='nvar' id="id_varL">
                                            <input type="hidden" name='ncomb' id="id_comb">
                                            <input type="hidden" name='ntela' id="ntela">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>%</label>
                                                        <input type="number" class="form-control porcent1" id="tporcentajen1" name="nporcentaje1" min='0' tabindex="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Composición1:</label>
                                                        <select style="width: 100%" class="form-control compo1" id="cmbcomposicion1" name="ncmbcomposicion1" tabindex="2">
                                                            <option value="0"></option>
                                                            <optgroup>
                                                                <?php
                                                                $rs = $query->Consultar("*", "FCAT_COMPOSICION", "ID_CAT_COMPOSICION", "ID_CAT_COMPOSICION");
                                                                while (!$rs->EOF) {
                                                                    echo "<option value='" . $rs->fields['ID_CAT_COMPOSICION'] . "'>" . utf8_encode($rs->fields['DESCRIPCION']) . "</option>";
                                                                    $rs->MoveNext();
                                                                }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>%</label>
                                                        <input type="number" class="form-control porcent2" id="tporcentajen2" name="nporcentaje2" min='0' tabindex="3">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Composición2:</label>
                                                        <select style="width: 100%" class="form-control compo2" id="cmbcomposicion2" name="ncmbcomposicion2" tabindex="4">
                                                            <option value="0"></option>
                                                            <optgroup>
                                                                <?php
                                                                $rs = $query->Consultar("*", "FCAT_COMPOSICION", "ID_CAT_COMPOSICION", "ID_CAT_COMPOSICION");
                                                                while (!$rs->EOF) {
                                                                    echo "<option value='" . $rs->fields['ID_CAT_COMPOSICION'] . "'>" . utf8_encode($rs->fields['DESCRIPCION']) . "</option>";
                                                                    $rs->MoveNext();
                                                                }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>%</label>
                                                        <input type="number" class="form-control porcent3" id="tporcentajen3" name="nporcentaje3" min='0' tabindex="5">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Composición3:</label>
                                                        <select style="width: 100%" class="form-control compo3" id="cmbcomposicion3" name="ncmbcomposicion3" tabindex="6">
                                                            <option value="0"></option>
                                                            <optgroup>
                                                                <?php
                                                                $rs = $query->Consultar("*", "FCAT_COMPOSICION", "ID_CAT_COMPOSICION", "ID_CAT_COMPOSICION");
                                                                while (!$rs->EOF) {
                                                                    echo "<option value='" . $rs->fields['ID_CAT_COMPOSICION'] . "'>" . utf8_encode($rs->fields['DESCRIPCION']) . "</option>";
                                                                    $rs->MoveNext();
                                                                }
                                                                ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-secondary" value='Cancelar' onclick="Limpiar_Modal_Lab();" data-dismiss="modal">
                                        <input type="button" class="btn btn-primary" value='Guardar' onclick="Registrar_Laboratorio();">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="card-footer" align="center"></div>
        </div>
        <div class="container"><?php include_once('modal_pdf.php') ?></div>
        <div class="container"><?php include_once('modal_variante.php') ?></div>
        <div class="container"><?php include_once('modal_med.php') ?></div>
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
    $(document).ready(function() {
        /*Ocultar pestañas de la ficha para el usuario de laboratorio*/
        if ($('#id_perfil').val() == 1) {
            $('#btn_duplicar').show();
        } else if ($('#id_perfil').val() == 2) {
            $('#btn_duplicar').show();
            // $('#llaboratorio').hide();
        } else if ($('#id_perfil').val() == 6) {
            // $('#btn_duplicar').hide();
            // $('#lmodelo').hide();
            // $('#lmodelo').removeClass('active');
            // $('#modelo').removeClass('active');
            // // $('#Mod_pestana').removeClass('active');
            // $('#lcombinaciones').hide();
            // $('#lhabil').hide();
            // $('#lcomposicion').hide();
            // $('#lpzas').hide();
            // $('#lmedidas').hide();
            // $('#lindicaciones').hide();
            // $('#Lab_pestana').addClass('active');
            // $('#laboratorio').addClass('active');
            // $('#llaboratorio').addClass('active');
            // $('#btn_model').prop("disabled",true);
        } else {
            $('#btn_duplicar').hide();
            // $('#llaboratorio').hide();
        }
        /*Termina ocultar*/

        /*if($('#id_perfil').val()==1 || $('#id_perfil').val()==2){
            $('#btn_duplicar').show();
        }else{
            $('#btn_duplicar').hide();
        }*/

        $('#tbuscar').keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
                e.preventDefault();
                Buscar_Pedido();
            }
        });

        /*$('body').on('click', '#mytable tr', function() {
            var idtr = $(this).attr('id');
            alert("ID TR: "+idtr);
        })*/

        $(document).on('click', '.btn_rmv_otro', function() {
            var button_id = $(this).attr("id"); //id del boton quitar
            if ($('#id_ficha').val() == '') {
                document.getElementById("row" + button_id).remove();
                var td = button_id;
                var str = $('#totro_str').val();
                var res = str.replace(td, "");
                $('#totro_str').val(res);

                /*var nFilas = $("#tbl_otro tr").length;
                if (nFilas == 1){
                    document.getElementById("tbl_otro").style.display = "none";//none
                    //$('#dv_guardar').hide();
                }*/
            } else {
                var param = 'id=' + button_id;
                param += '&accion=Eliminar_Otro';

                if (isNaN(button_id) == false) {
                    $.ajax({
                        url: 'Transacciones.php',
                        cache: false,
                        type: 'POST',
                        data: param,
                        success: function(data) {
                            if (data > 0) {
                                Buscar_Otro($('#id_ficha').val());
                            } else if (data == 'Error') {
                                swal({
                                    title: "Error al eliminar.!!",
                                    icon: "error",
                                    timer: 1300,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function(request, status, error) {
                            alert(request.responseText);
                        }
                    });
                } else {
                    document.getElementById("row" + button_id).remove();
                    var td = button_id;
                    var str = $('#totro_str').val();
                    var res = str.replace(td, "");
                    $('#totro_str').val(res);
                    /* var nFilas = $("#tbl_otro tr").length;
                     if (nFilas == 1){
                         document.getElementById("tbl_otro").style.display = "none";
                     }*/
                }
            }
        });

        $(document).on('click', '.btn_rmv_pzs', function() {
            var button_id = $(this).attr("id"); //id del boton quitar
            if ($('#id_ficha').val() == '') {
                document.getElementById("row" + button_id).remove();
                var td = button_id;
                var str = $('#tstr').val();
                var res = str.replace(td, "");
                $('#tstr').val(res);

                var nFilas = $("#tbl_pzas tr").length;
                if (nFilas == 1) {
                    document.getElementById("tbl_pzas").style.display = "none"; //none
                    $('#dv_guardar').hide();
                }
            } else {
                var param = 'id=' + button_id;
                param += '&accion=Eliminar_Pieza';

                if (isNaN(button_id) == false) {
                    $.ajax({
                        url: 'Transacciones.php',
                        cache: false,
                        type: 'POST',
                        data: param,
                        success: function(data) {
                            if (data > 0) {
                                Buscar_Piezas($('#id_ficha').val());
                            } else if (data == 'Error') {
                                swal({
                                    title: "Error al eliminar.!!",
                                    icon: "error",
                                    timer: 1300,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function(request, status, error) {
                            alert(request.responseText);
                        }
                    });
                } else {
                    document.getElementById("row" + button_id).remove();
                    var td = button_id;
                    var str = $('#tstr').val();
                    var res = str.replace(td, "");
                    $('#tstr').val(res);
                    var nFilas = $("#tbl_pzas tr").length;
                    if (nFilas == 1) {
                        document.getElementById("tbl_pzas").style.display = "none"; //none
                        $('#dv_guardar').hide();
                    }
                }
            }
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id"); //id del boton quitar
            if ($('#id_ficha').val() == '') {
                document.getElementById("row" + button_id).remove();
                var td = button_id;
                var str = $('#tcombinaciones').val();
                var res = str.replace(td, "");
                $('#tcombinaciones').val(res);

                var nFilas = $("#mytable tr").length;
                if (nFilas == 1) {
                    document.getElementById("mytable").style.display = "none";
                    $('#dv_comb').hide();
                    $('#dv_guardarC').hide();
                }
            } else {
                var param = 'id=' + button_id;
                param += '&accion=Eliminar_Combinacion';

                if (isNaN(button_id) == false) {
                    $.ajax({
                        url: 'Transacciones.php',
                        cache: false,
                        type: 'POST',
                        data: param,
                        success: function(data) {
                            if (data > 0) {
                                swal({
                                    title: "Combinacion eliminada.!!",
                                    icon: "success",
                                    timer: 1300,
                                    showConfirmButton: false
                                });
                                Buscar_Combinaciones($('#id_ficha').val());
                                Buscar_CombinacionesN($('#id_ficha').val());
                                Buscar_Composicion($('#id_ficha').val());
                            } else if (data == 'Error') {
                                swal({
                                    title: "Error al eliminar la combinacion",
                                    icon: "error",
                                    timer: 1300,
                                    showConfirmButton: false
                                });
                            } else if (data == 'Nueva') {

                            }
                        },
                        error: function(request, status, error) {
                            alert(request.responseText);
                        }
                    });
                } else {
                    document.getElementById("row" + button_id).remove();
                    var td = button_id;
                    var str = $('#tcombinaciones').val();
                    var res = str.replace(td, "");
                    $('#tcombinaciones').val(res);
                    var nFilas = $("#mytable tr").length;
                    if (nFilas == 1) {
                        document.getElementById("mytable").style.display = "none";
                        $('#dv_comb').hide();
                        $('#dv_guardarC').hide();
                    }
                }
            }
        });
    });

    function Validar_Tab(nm) {
        if ($('#tbuscar').val() != '') {
            if (nm == 1) {
                if ($('#id_perfil').val() == '1' || $('#id_perfil').val() == '2') {
                    $('#add_med').show();
                } else {
                    $('#add_med').hide();
                }
            } else {
                $('#add_med').hide();
            }
        }
    }

    function Duplicar() {
        $('#btn_duplicar').blur();
        $('#btn_duplicar').prop('disabled', true);
        $('#btn_duplicar').html('<i class="fas fa-sync-alt"></i> Duplicando..!');
        var param = $('#fmodelo').serialize() + '&ficha=' + $('#id_ficha').val() + '&corrida=' + $('#cor').val() + '&accion=Duplicar_Modelo';

        $.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data == 'Existe') {
                    swal({
                        title: 'Orden ya existe',
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    $('#torden').focus();
                } else if (data == 'Exito') {
                    swal({
                        title: 'Orden duplicada',
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    $('#tbuscar').val($('#torden').val());
                    Buscar_Pedido();
                } else if (data == 'No_Proscai') {
                    swal({
                        title: 'Orden no existe en Proscai',
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                } else {
                    swal({
                        title: "Error.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
        $('#btn_duplicar').prop('disabled', false);
        $('#btn_duplicar').html('Duplicar');
    }

    function Registrar_CombinacionN() {
        $('#btn_regN').blur();

        if ($('#cmbtipon').val() == '0') {
            $('#cmbtipon').focus();
            return;
        }
        if ($('#cmbvarianten').val() == '0') {
            $('#cmbvarianten').focus();
            return;
        }
        if ($('#tcolorn').val() == '') {
            $('#tcolorn').focus();
            return;
        }
        /*Modificar el ingreso de las telas, llevarse unicamente el icod y ya no la descripcion
         * al seleccionar la tela la descripcion se debera cargar en un input text y se tomara el valor de este input para ingresarlo en la BD
         * */
        if ($('#cmbtelan1').val() != '0')
            //var tela1 = $('#cmbtelan1 option:selected').text();//llevar el valor del input nuevo concatenando '_'
            var tela1 = $('#cmbtelan1').val() + '_' + $.trim($('#tdesct1').val().toUpperCase());
        else
            var tela1 = '';

        if ($('#cmbproveedorn1').val() != '0') {
            tela1 += '|' + $('#cmbproveedorn1').val();
            if ($('#cmbfacturan1').val() != '0') {
                tela1 += '-' + $('#cmbfacturan1').val();
            }
        }
        if ($('#cmbproveedorn2').val() != '0') {
            tela1 += '@' + $('#cmbproveedorn2').val();
            if ($('#cmbfacturan2').val() != '0') {
                tela1 += '-' + $('#cmbfacturan2').val();
            }
        }
        if ($('#cmbtelan2').val() != '0') {
            //var tela2 = $('#cmbtelan2 option:selected').text();
            var tela2 = $('#cmbtelan2').val() + '_' + $.trim($('#tdesct2').val().toUpperCase());
            if ($('#cmbproveedorn3').val() != '0') {
                tela2 += '|' + $('#cmbproveedorn3').val();
                if ($('#cmbfacturan3').val() != '0') {
                    tela2 += '-' + $('#cmbfacturan3').val();
                }
            }
            if ($('#cmbproveedorn4').val() != '0') {
                tela2 += '@' + $('#cmbproveedorn4').val();
                if ($('#cmbfacturan4').val() != '0') {
                    tela2 += '-' + $('#cmbfacturan4').val();
                }
            }
        } else
            var tela2 = '';

        var param = 'ficha=' + $('#id_ficha').val() + '&comb=' + $('#tipo_var').val() + '&tipo=' + $('#cmbtipon').val() + '&var=' + $('#cmbvarianten').val() + '&color=' + $('#tcolorn').val().toUpperCase() + '&tela1=' + tela1 + '&tela2=' + tela2;
        if ($('#id_variante').val() != '')
            param += '&idvar=' + $('#id_variante').val() + '&accion=Modificar_CombN';
        else
            param += '&accion=Ingresar_CombN';

        if ($('#id_ficha').val() != '') {
            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data > 0) {
                        $('#modal_variante').modal('hide');
                        Limpiar_Modal();
                        Buscar_CombinacionesN($('#id_ficha').val());
                        Buscar_Habil($('#id_ficha').val());
                        Buscar_Composicion($('#id_ficha').val());
                        Buscar_TipoP($('#id_ficha').val());
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        } else {
            swal({
                title: "Orden sin registrar.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }
    }

    function Buscar_CombinacionesN(nm) {
        var param = 'ficha=' + nm + '&tp=Consultar_Comb';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    $('#dv_resultado').html(data);
                } else {
                    var tbl = "<table id='mytable' class='table table-bordered table-hover' style='display: block; font-size: 12px'><thead>";
                    tbl += "<tr align='center'><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th><th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th>VARIANTE 6</th><th>VARIANTE 7</th><th>VARIANTE 8</th><th>VARIANTE 9</th><th></th><th></th></tr>";
                    tbl += "<tr align='center'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><button type='button' id='btn_modal_var' onclick='Modal_Variante()' class='btn btn-primary btn-xs'>Agregar</button></td><td></td></tr>";
                    tbl += "</thead></table>";
                    $('#dv_resultado').html(tbl);
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });

    }

    function Buscar_ProveedorN(nm) {
        var param = 'icod=' + $('#cmbtelan' + nm).val() + '&nm=' + nm + '&tp=PrvN';
        /*var tp = nm*2;//1,2,3,4,5
        for(var i=tp-1; i<=tp; i++){
            $('#cmbproveedorn'+i).val(0);
            $('#cmbfacturann'+i).val(0);
        }*/

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                res = data.split('@');
                $('#dv_prvn' + res[1]).html(res[0]);
                $('#dv_prvn' + res[3]).html(res[2]);
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_FacturaN(nm, mn) {
        var param = 'icod=' + $('#cmbtelan' + mn).val() + '&prv=' + $('#cmbproveedorn' + nm).val() + '&nm=' + nm + '&tp=factN';
        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                $('#dv_facturan' + nm).html(data);
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Mostrar_Ocultar() {
        if ($('#cmbtipo').val() == '7' || $('#cmbtipo').val() == '9') {
            if ($('#cmbtipo').val() == '7') {
                $('#dv_entretela').show();
                $('#cmbforro').select2('val', '0');
                $('#dv_forro').hide();
                for (var i = 1; i <= 5; i++) {
                    $('#cmbtela' + i).select2('val', '0');
                }
                for (var j = 1; j <= 10; j++) {
                    $('#cmbfactura' + j).select2('val', '0');
                }
            } else {
                $('#dv_entretela').hide();
                $('#cmbentretela').select2('val', '0');
                $('#dv_forro').show();
            }
        } else {
            $('#dv_entretela').hide();
            $('#dv_forro').hide();
            $('#cmbentretela').select2('val', '0');
            $('#cmbforro').select2('val', '0');
        }
    }

    function Abrir_Modal() {
        $('#mdl').blur();

        var param = 'id=' + $('#id_ficha').val();

        $.ajax({
            url: 'pdf/pdf.php',
            type: "POST",
            data: param,
            success: function(pdf) {
                //alert(pdf);
                $('.overlay').remove();
                $(".modal-title").html("Ficha de Confección: <b>" + $('#torden').val() + "</b>");
                $("#modal_pdf").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
                $('#dv_pdf').show();
                $('#dv_pdf').html('<iframe width="100%" height="98%" type="application/pdf" src="data:application/pdf;base64,' + pdf + '"></iframe>');
            },
            error: function(request, error) {
                swal("Ha ocurrido un error");
                $('.overlay').remove();
            }
        });
    }

    function Agregar_Medida() {
        $('#add_med').blur();

        //Buscar_Corrida($('#id_ficha').val());

        $(".modal-title").html("Agregar");
        $("#modal_med").modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        $('#dv_pdf').show();
    }

    function Modal_Variante(nm, tipo, cont) {
        $('#btn_modal_var').blur();
        $('#tipo_var').val(nm);
        $('#cmbtipon').val(tipo);
        $('#cmbvarianten').val(cont + 1);
        /*if(cont > 0){
            $('#cmbvarianten').find('option').remove().end().append('<option value="0"></option>').val('0');
            for(var i=cont+1; i<=10; i++){
                $('#cmbvarianten').append('<option value="'+i+'">'+i+'</option>');
            }
        }*/
        var param = 'id=' + $('#id_ficha').val();
        $(".modal-title").html("Agregar variante");
        $("#modal_variante").modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function Cargar_ProveedorN(nm, a, b, prv, ft) {
        var param = 'icod=' + $('#cmbtelan' + nm).val() + '&nm=' + nm + '&a=' + a + '&b=' + b + '&prv=' + prv + '&tp=Buscar_Prv';
        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                res = data.split('@');
                $('#dv_prvn' + a).html(res[0]);
                $('#dv_prvn' + b).html(res[1]);
                var param = 'icod=' + $('#cmbtelan' + nm).val() + '&prv1=' + $('#cmbproveedorn' + a).val() + '&prv2=' + $('#cmbproveedorn' + b).val() + '&ft=' + ft + '&a=' + a + '&b=' + b + '&nm=' + nm + '&tp=Buscar_Ft';
                $.ajax({
                    url: 'consultas/busquedas.php',
                    cache: false,
                    type: 'POST',
                    data: param,
                    success: function(data) {
                        res = data.split('@');
                        $('#dv_facturan' + a).html(res[0]);
                        $('#dv_facturan' + b).html(res[1]);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Editar_Variante(id, comb, vte, cl, tela) {
        $('#id_variante').val(id);
        $('#cmbtipon').val(comb);
        $('#cmbvarianten').val(vte);
        $('#tcolorn').val(cl);
        var ft = tela.split('|'); //separamos las telas
        var icod = ft[0].split('_');
        $('#cmbtelan1').select2('destroy');
        $('#cmbtelan1').val(icod[0]).select2();
        var prv1 = ft[0].split('@');
        var desc = icod[1].split('@');
        $('#tdesct1').val(desc[0]);
        var fin1 = (prv1[1] ? prv1[1].split('-') : ''); //validamos si tiene proveedor
        var fin2 = (prv1[2] ? prv1[2].split('-') : '');
        var prv = (fin1[0] ? fin1[0] + '|' : '|');
        prv += (fin2[0] ? fin2[0] : '');
        var fact = (fin1[1] ? fin1[1] + '|' : '|');
        fact += (fin2[1] ? fin2[1] : '');
        Cargar_ProveedorN(1, 1, 2, prv, fact);
        if (ft[1] != '') { //tela 2
            var icod2 = ft[1].split('_'); //separamos icod y tela
            $('#cmbtelan2').select2('destroy');
            $('#cmbtelan2').val(icod2[0]).select2();
            var prv2 = ft[1].split('@');
            var desc2 = icod2[1].split('@');
            $('#tdesct2').val(desc2[0]);
            var fin3 = (prv2[1] ? prv2[1].split('-') : ''); //validamos si tiene proveedor
            var fin4 = (prv2[2] ? prv2[2].split('-') : '');
            var prvf = (fin3[0] ? fin3[0] + '|' : '|');
            prvf += (fin4[0] ? fin4[0] : '');
            var fact2 = (fin3[1] ? fin3[1] + '|' : '|');
            fact2 += (fin4[1] ? fin4[1] : '');
            Cargar_ProveedorN(2, 3, 4, prvf, fact2);
        }
        $('.modal-title').html('Editar variante');
        $('#modal_variante').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function Eliminar_Variante(id, vte, comb) {
        $('#' + id).blur();

        swal({
                title: "Deseas borrar la variante?",
                //text: "No podrás deshacer este paso...",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#28A745",
                confirmButtonText: "¡Si!",
                closeOnConfirm: false
            },

            function() {
                var param = 'id_var=' + id + '&var=' + vte + '&comb=' + comb + '&ficha=' + $('#id_ficha').val() + '&accion=Delete_Variante';

                $.ajax({
                    url: 'Transacciones.php',
                    cache: false,
                    type: 'POST',
                    data: param,
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                title: "Variante eliminada.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                            Buscar_CombinacionesN($('#id_ficha').val());
                            Buscar_Habil($('#id_ficha').val());
                            Buscar_Composicion($('#id_ficha').val());
                        } else {
                            swal({
                                title: "Error.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            });
    }

    function Buscar_Pedido() {
        $('#btn_buscar').blur();
        if ($.trim($('#tbuscar').val()) == '') {
            swal({
                title: 'Ingrese la orden.!!',
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }

        if ($('#id_perfil').val() == '1' || $('#id_perfil').val() == '2') {
            $('#btn_duplicar').show();
        } else {
            $('#btn_duplicar').hide();
        }

        var param = 'orden=' + $('#tbuscar').val().toUpperCase() + '&tp=orden';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data.search('Ficha') != -1) {
                    res = data.split('@');
                    $('#mdl').show();
                    $('#tmodel').val(res[0]);
                    $('#torden').val(res[1]);
                    $('#tpedido').val(res[2]);
                    $('#cmbcliente').val(res[3]);
                    Ajax_Dinamico('consultas/busquedas.php', 'dv_marca', 'cliente=' + res[3] + '&tp=cte' + '&mc=' + res[4]);
                    $('#cmblinea').val(res[5]);
                    $('#cmbprenda').val(res[9]);
                    $('#tsemana').val(res[6]);
                    $('#ttemporada').val(res[7]);
                    $('#cmbdisenadora').val(res[8]);
                    $('#cmbtalla').val(res[10]);
                    $('#cmbpatronista').val(res[11]);
                    $('#cmbmuestrista').val(res[12]);
                    $('#cmbgraduadora').val(res[13]);
                    $('#tdescripcion').val(res[14]);
                    $('#tigual').val(res[15]);
                    //$('#tmodcliente').val(res[16]);
                    $('#dv_corrida').html(res[17]);
                    $('#id_ficha').val(res[19]);
                    $('#tcantidad').val(res[20]);
                    $('#cor').val(res[21]);
                    $('#tcombinaciones').val('');
                    $('#tstr').val('');
                    $('#dv_duplicar').show();
                    Buscar_Combinaciones(res[19]);
                    Buscar_CombinacionesN(res[19]);
                    Buscar_Habil(res[19]);
                    Buscar_Composicion(res[19]);
                    Buscar_Otro(res[19]);
                    Buscar_Piezas(res[19]);
                    Buscar_TipoP(res[19]);
                    Buscar_Corrida(res[19]);
                    Buscar_Indicaciones(res[19]);
                    // Buscar_Laboratorio(res[19]);
                    $('#btn_model').prop('disabled', false);
                    $('#btn_duplicar').prop('disabled', false);
                } else if (data.search('Proscai') != -1) {
                    res = data.split('@');
                    str = res[0].split('|');
                    $('#mdl').hide();
                    $('#tmodel').val(str[2]);
                    $('#torden').val(str[1]);
                    $('#tpedido').val(str[0]);
                    $('#tsemana').val(str[4]);
                    $('#tcantidad').val(parseInt(str[5]));
                    $('#tdescripcion').val(str[3]);
                    /*var desc = str[3].split('\r');
                    $('#tdescripcion').val(desc[1]+"\n"+desc[3]);
                    $('#tmodcliente').val(desc[2]);*/
                    $('#dv_corrida').html(res[1]);
                    $('#cor').val(res[2]);
                    $('#cmbcliente').val(0);
                    $('#cmbmarca').val(0);
                    $('#cmblinea').val(0);
                    $('#ttemporada').val('');
                    $('#cmbdisenadora').val(0);
                    $('#cmbprenda').val(0);
                    $('#cmbtalla').val(0);
                    $('#cmbpatronista').val(0);
                    $('#cmbmuestrista').val(0);
                    $('#cmbgraduadora').val(0);
                    $('#id_ficha').val('');
                    document.getElementById("mytable").style.display = "none";
                    $('#dv_guardarC').hide();
                    $('#dv_habil').html('');
                    $('#tvar').val('');
                    $('#tcor').val('');
                    $('#trango').val('');
                    $('#dvp').html('');
                    $('#dvp').hide();
                    $('#dv_btn_habil').hide();
                    $('#tid').val('');
                    $('#ttipo').val('');
                    $('#dv_composicion').html('');
                    $('#dv_btn_comp').hide();
                    $('#dv_guardar').hide();
                    $('#tstr').val('');
                    $('#tpzas').val('');
                    $('#tcorrida').val('');
                    $('#dvfoto').empty();
                    $('#tficha').val('');
                    $('#dv_medidas').html('');
                    $('#dv_btnMed').hide();
                    $('#tid_ind').val('');
                    $('#dv_duplicar').hide();
                    $('#tindicaciones').val('*CODIGOS X COLOR Y TALLAS (PEDIR SU FICHA A HABILITACION). *SE ANEXA HOJA DE REFENCIA DE MONARCH PARA REVISAR QUE SEA EXACTAMENTE IGUAL A LA ETIQUETA.');
                    $('#tindicaciones3').val('*FOLEAR TODO EL CORTE PARA EVITAR PRENDAS PINTAS. *CASAR DELANTEROS. *PLANCHAR CON CUIDADO, EVITE LUSTRAR LA PRENDA. *REPOSAR LA TELA MINIMO 24HRS. *SEPARAR DELANTERO PARA MANDAR ESTAMPAR. *SE MANDA PLANTILLA PARA MARCAR OJAL, CHARRETERA O BOTON AL FINAL DEL TRASO. *EVITE CABECEAR PIEZAS, EL PELO DEBE PEINAR HACIA ABAJO.');
                    var tbl1 = '<table  id="mytable" class="table table-bordered table-hover" style="display: none; font-size: 13px"><thead><tr><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th>'; //<th>TELA</th>
                    tbl1 += '<th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th></th><th></th></tr></thead></table>';
                    $('#dv_comb').html(tbl1);
                    $('#tcombinaciones').val('');
                    var tbl = '<table  id="tbl_pzas" class="table table-bordered table-hover" style="display: none; font-size: 15px"><thead><tr><th>Nombre</th><th>Cantidad</th><th>Tipo</th><th></th></tr></thead></table>'
                    $('#dv_pzas').html(tbl);
                    var select = "<select class='custom-select' id='cmbtipoc' tabindex='9'>'<option value='0'></option>'<optgroup><option value='1'>TELA BASE</option><option value='2'>COMBINACION 1</option><option value='3'>COMBINACION 2</option>";
                    select += "<option value='4'>COMBINACION 3</option><option value='5'>COMBINACION 4</option><option value='6'>COMBINACION 5</option><option value='7'>ENTRETELA</option><option value='9'>FORRO</option></optgroup></select>";
                    $('#dv_tipop').html(select);
                    $('#btn_model').prop('disabled', false);
                    $('#btn_duplicar').prop('disabled', true);
                } else if (data.search('Repetidos') != -1) {
                    var str = data.split('|');
                    swal({
                        title: 'Qs repetidas en Proscai: ' + str[1],
                        icon: "danger",
                        timer: 3500,
                        showConfirmButton: false
                    });
                    $('#tbuscar').focus();
                    $('#btn_model').prop('disabled', true);
                    $('#btn_duplicar').prop('disabled', true);
                } else {
                    swal({
                        title: 'Sin resultados.!!',
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    $('#tbuscar').focus();
                    $('#btn_model').prop('disabled', true);
                    $('#btn_duplicar').prop('disabled', true);
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Combinaciones(nm) {
        var param = 'ficha=' + nm + '&tp=combinacion';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    $('#dv_comb').html(data);
                } else {
                    var tbl1 = '<table id="mytable" class="table table-bordered table-hover" style="display: none; font-size: 13px"><thead><tr><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th>'; //<th>TELA</th>
                    tbl1 += '<th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th></th><th></th></tr></thead></table>';
                    $('#dv_comb').html(tbl1);
                    $('#tcombinaciones').val('');
                    $('#dv_guardarC').hide();
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Marcas() {
        var param = 'cliente=' + $('#cmbcliente').val() + '&tp=cte';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                $('#dv_marca').html(data);
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Linea() {
        var param = 'cliente=' + $('#cmbcliente').val() + '&marca=' + ($('#cmbmarca').val()) + '&tp=linea';
        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                $('#dv_linea').html(data);
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Prendas() {
        var param = 'marca=' + $('#cmbmarca').val() + '&linea=' + $('#cmblinea').val() + '&tp=prenda';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                $('#dv_prenda').html(data);
                //Buscar_Tallas();
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    /*function Buscar_Tallas() {
        var param ='id='+($('#cmblinea').val())+'&tp=talla';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                $('#dv_talla').html(data);
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }*/

    function Buscar_Habil(nm) {
        //var param = 'id_prenda='+$('#cmbprenda').val()+'&tp=habil';
        var param = 'ficha=' + nm + '&tp=habil';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != '') {
                    var res = data.split('@');
                    //console.log(res[0]);
                    $('#dv_habil').html(res[0]);
                    $('#tvar').val(res[1]);
                    $('#tcor').val(res[2]);
                    $('#trango').val(res[3]);
                    if (res[3] != "") {
                        $('#dvp').html(res[4]);
                        $('#dvp').show();
                        $('#dvp').addClass('col-md-4');
                        $('#dvf').removeClass('col-md-12');
                        $('#dvf').addClass('col-md-8');
                    } else {
                        $('#dvp').html('');
                        $('#dvp').hide();
                        $('#dvp').removeClass('col-md-4');
                        $('#dvf').addClass('col-md-12');
                    }
                    $('#dv_btn_habil').show();
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Composicion(nm) {
        var param = 'ficha=' + nm + '&tp=composicion';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    var res = data.split('@');
                    $('#dv_composicion').html(res[0]);
                    $('#dv_btn_comp').show();
                    $('#tid').val(res[1]);
                    $('#ttipo').val(res[2]);
                    $('#tnew').val(res[3]);
                    $('#totro').val(res[4]);
                } else {
                    $('#dv_composicion').html('<h3>Orden sin combinaciones</h3>');
                    $('#dv_btn_comp').hide();
                    $('#tid').val('');
                    $('#ttipo').val('');
                    $('#tnew').val('');
                    $('#totro').val('');
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Otro(nm) {
        var param = 'ficha=' + nm + '&tp=otro';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    $('#dv_tbl_otro').html(data);
                }
                /*else{
                                    $('#dv_tbl_otro').empty();
                                }*/
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });

    }

    function Registrar_Modelo() {
        $('#btn_model').blur();

        if ($('#tbuscar').val() != '') {
            $('#btn_model').prop('disabled', true);
            $('#btn_model').html('<i class="fas fa-sync-alt"></i> Guardando..!');

            var corrida = "";
            for (var j = 1; j < $('#cor').val(); j++) {
                corrida += $('#cor' + j).val() + '|';
                /*if ($('#check'+j).is(":checked")){
                    alert("Esta checkeado "+$('#check'+j).val());
                }*/
            }

            var param = $('#fmodelo').serialize();

            var title = "";
            if ($('#id_ficha').val() == '') {
                param += '&corrida=' + corrida;
                param += '&accion=Registrar_Modelo';
                title += "Registro exitoso.!!";
            } else {
                param += '&ficha=' + $('#id_ficha').val();
                param += '&accion=Modificar_Modelo';
                title += "Cambios guardados.!!";
            }

            var selectedFile = document.getElementById('timagen').files;

            if (selectedFile.length > 0) {
                param += '&foto=1';
                var myfiles = document.getElementById("timagen");
                var files = myfiles.files;
                var foto = new FormData();
                for (i = 0; i < files.length; i++) {
                    foto.append('file' + i, files[i]);
                }

                $.ajax({
                    url: 'upload.php?img=' + $('#tmodel').val(),
                    type: 'POST',
                    contentType: false,
                    data: foto,
                    processData: false,
                    cache: false,
                }).done(function(data) {
                    var msg = data.split('|');
                    if (msg[0] == 'Incorrecto') {
                        swal({
                            title: "La extension deber ser JPG, estas ingresando: " + msg[1],
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else if (msg[0] == 'Excede') {
                        swal({
                            title: "El tama? maximo permitido es de 1 Mb.!!",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else if (msg[0] == 'Exito') {
                        $.ajax({
                            url: 'Transacciones.php',
                            cache: false,
                            type: 'POST',
                            data: param,
                            success: function(data) {
                                if (data.search('Existe') != -1) {
                                    var str = data.split('|');
                                    swal({
                                        title: 'Ya existe la Q en la orden: ' + str[1],
                                        icon: "success",
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else if (data.search('Error') != -1) {
                                    swal({
                                        title: "Error.!!",
                                        icon: "success",
                                        timer: 1300,
                                        showConfirmButton: false
                                    });
                                } else {
                                    swal({
                                        title: title,
                                        icon: "success",
                                        timer: 1300,
                                        showConfirmButton: false
                                    });
                                    Buscar_Pedido();
                                }
                                $('#btn_model').prop('disabled', false);
                                $('#btn_model').html('Guardar');
                            },
                            error: function(request, status, error) {
                                alert(request.responseText);
                            }
                        });
                    }
                });
            } else {
                $.ajax({
                    url: 'Transacciones.php',
                    cache: false,
                    type: 'POST',
                    data: param,
                    success: function(data) {
                        if (data.search('Existe') != -1) {
                            var str = data.split('|');
                            swal({
                                title: 'Ya existe la Q en la orden: ' + str[1],
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else if (data.search('Error') != -1) {
                            swal({
                                title: "Error.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                        } else {
                            swal({
                                title: title,
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                            Buscar_Pedido();
                        }
                        $('#btn_model').prop('disabled', false);
                        $('#btn_model').html('Guardar');
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            }
        } else {
            swal({
                title: "Debe buscar una orden.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }

    }

    function Registrar_Combinacion() {
        $('#btn_comb').blur();

        if ($('#id_ficha').val() != '') {
            var param = 'str=' + $('#tcombinaciones').val();
            param += '&id=' + $('#id_ficha').val();
            param += '&accion=Ingresar_Combinacion';

            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data > 0) {
                        swal({
                            title: "Cambios guardados.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                        Buscar_Combinaciones($('#id_ficha').val());
                        Buscar_Habil($('#id_ficha').val());
                        Buscar_Composicion($('#id_ficha').val());
                        Buscar_TipoP($('#id_ficha').val());
                        $('#cmbtipo').val('0');
                        $('#cmbtipo').trigger('change');
                        for (var j = 1; j <= 5; j++) {
                            $('#tcolor' + j).val('');
                            $('#cmbtela' + j).select2('destroy');
                            $('#cmbtela' + j).val('0').select2();
                        }
                        for (var i = 1; i <= 10; i++) {
                            $('#cmbproveedor' + i).select2('destroy');
                            $('#cmbproveedor' + i).val('0');
                            $('#cmbfactura' + i).select2('destroy');
                            $('#cmbfactura' + i).val('0');
                        }
                        $('#tcombinaciones').val('');
                    } else if (data == 'Error_Comp') {
                        swal({
                            title: "Sin composicion en Proscai.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        } else {
            swal({
                title: "Orden sin registrar.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }
    }

    function Cargar_Combinacion(nm, cat, comb, idc) {
        $('#edit_' + nm).blur();
        var id = nm + '-' + idc;
        $('#tid_comb').val(id);
        $('#btn_combinacion').html('Guardar');

        $('#cmbtipo').val(cat);
        $('#cmbtipo').trigger('change');
        var str = comb.split('|');
        var cont = 1;
        for (var i = 0; i <= str.length - 2; i++) {
            var ft = str[i].split('@');
            var icod = ft[0].split('_'); //separamos icod y tela
            $('#cmbtela' + cont).select2('destroy');
            $('#cmbtela' + cont).val(icod[0]).select2();
            //
            $('#tcolor' + cont).val(ft[1]);

            if (ft[2] != '') {
                var prv1 = ft[2].split("-");
                var pr1 = prv1[0];
                var ft1 = prv1[1];
            }
            if (ft[3] != '') {
                var prv2 = ft[3].split("-");
                var pr2 = prv2[0];
                var ft2 = prv2[1];
            }

            if (cont == 1) {
                $('#cmbproveedor1').val('0');
                $('#cmbfactura1').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv1', 'icod=' + icod[0] + '&prv=' + pr1 + '&nm=1&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura1', 'icod=' + icod[0] + '&prv=' + pr1 + '&ft=' + ft1 + '&nm=1&tp=Buscar_Ft');
                $('#cmbproveedor2').val('0');
                $('#cmbfactura2').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv2', 'icod=' + icod[0] + '&prv=' + pr2 + '&nm=2&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura2', 'icod=' + icod[0] + '&prv=' + pr2 + '&ft=' + ft2 + '&nm=2&tp=Buscar_Ft');
            } else if (cont == 2) {
                $('#cmbproveedor3').val('0');
                $('#cmbfactura3').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv3', 'icod=' + icod[0] + '&prv=' + pr1 + '&nm=3&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura3', 'icod=' + icod[0] + '&prv=' + pr1 + '&ft=' + ft1 + '&nm=3&tp=Buscar_Ft');
                $('#cmbproveedor4').val('0');
                $('#cmbfactura4').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv4', 'icod=' + icod[0] + '&prv=' + pr2 + '&nm=4&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura4', 'icod=' + icod[0] + '&prv=' + pr2 + '&ft=' + ft2 + '&nm=4&tp=Buscar_Ft');
            } else if (cont == 3) {
                $('#cmbproveedor5').val('0');
                $('#cmbfactura5').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv5', 'icod=' + icod[0] + '&prv=' + pr1 + '&nm=5&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura5', 'icod=' + icod[0] + '&prv=' + pr1 + '&ft=' + ft1 + '&nm=5&tp=Buscar_Ft');
                $('#cmbproveedor6').val('0');
                $('#cmbfactura6').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv6', 'icod=' + icod[0] + '&prv=' + pr2 + '&nm=6&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura6', 'icod=' + icod[0] + '&prv=' + pr2 + '&ft=' + ft2 + '&nm=6&tp=Buscar_Ft');
            } else if (cont == 4) {
                $('#cmbproveedor7').val('0');
                $('#cmbfactura7').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv7', 'icod=' + icod[0] + '&prv=' + pr1 + '&nm=7&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura7', 'icod=' + icod[0] + '&prv=' + pr1 + '&ft=' + ft1 + '&nm=7&tp=Buscar_Ft');
                $('#cmbproveedor8').val('0');
                $('#cmbfactura8').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv8', 'icod=' + icod[0] + '&prv=' + pr2 + '&nm=8&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura8', 'icod=' + icod[0] + '&prv=' + pr2 + '&ft=' + ft2 + '&nm=8&tp=Buscar_Ft');
            } else {
                $('#cmbproveedor9').val('0');
                $('#cmbfactura9').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv9', 'icod=' + icod[0] + '&prv=' + pr1 + '&nm=9&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura9', 'icod=' + icod[0] + '&prv=' + pr1 + '&ft=' + ft1 + '&nm=9&tp=Buscar_Ft');
                $('#cmbproveedor10').val('0');
                $('#cmbfactura10').val('0');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_prv10', 'icod=' + icod[0] + '&prv=' + pr2 + '&nm=10&tp=Buscar_Prv');
                Ajax_Dinamico('consultas/busquedas.php', 'dv_factura10', 'icod=' + icod[0] + '&prv=' + pr2 + '&ft=' + ft2 + '&nm=10&tp=Buscar_Ft');
            }
            cont++;
        }
    }

    function Actualizar_Combinacion() {
        $('#btn_combinacion').blur();
        var tipo = $('#cmbtipo').val();
        var comb = "";
        comb += tipo;
        var ft = $('#tid_comb').val().split('-');
        var idc = ft[1].split('|');
        var cont = 1;
        for (var i = 1; i <= 5; i++) {
            comb += "|";
            if ($.trim($('#tcolor' + i).val()) != '') {
                comb += $('#cmbtela' + i + ' option:selected').text() + "@";
                comb += idc[i - 1] + "@" + $('#tcolor' + i).val().toUpperCase() + "@";
                for (var j = cont; j <= cont + 1; j++) {
                    if ($('#cmbproveedor' + j).val() != '0') {
                        if ($('#cmbfactura' + j).val() != '0') {
                            comb += $('#cmbproveedor' + j).val() + "-" + $('#cmbfactura' + j).val() + "@";
                        } else {
                            comb += $('#cmbproveedor' + j).val() + "-@";
                        }
                    }
                }
            }
            cont = cont + 2;
        }
        var idcomb = $('#tid_comb').val().split('-');
        var param = 'str=' + comb;
        param += '&id=' + $('#id_ficha').val();
        param += '&comb=' + idcomb[0];
        param += '&accion=Actualizar_Combinacion';
        //alert(param);
        $.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    swal({
                        title: "Cambios guardados.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    Buscar_Combinaciones($('#id_ficha').val());
                    /*Buscar_Habil($('#id_ficha').val());
                    Buscar_Composicion($('#id_ficha').val());
                    Buscar_TipoP($('#id_ficha').val());*/
                    $('#cmbtipo').val('0');
                    $('#cmbtipo').trigger('change');
                    for (var j = 1; j <= 5; j++) {
                        $('#tcolor' + j).val('');
                        $('#cmbtela' + j).select2('destroy');
                        $('#cmbtela' + j).val('0').select2();
                    }
                    for (var i = 1; i <= 10; i++) {
                        $('#cmbproveedor' + i).select2('destroy');
                        $('#cmbproveedor' + i).val('0');
                        $('#cmbfactura' + i).select2('destroy');
                        $('#cmbfactura' + i).val('0');
                    }
                    $('#tid_comb').val('');
                    $('#btn_combinacion').html('Agregar');
                } else {
                    swal({
                        title: "Error.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Ingresar_Combinacion() {
        $('#btn_combinacion').blur();

        if ($('#cmbtipo').val() == '0') {
            swal({
                title: 'Seleccione el tipo.!!',
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#cmbtipo').select2('open');
            return;
        }
        /* if($('#tcolor1').val()==''){
             swal({title: 'Ingrese al menos una variante.!!', icon: "success", timer: 1300, showConfirmButton: false});
             $('#tcolor1').focus();
             return;
         }*/

        if ($('#tbuscar').val() != '') {
            /*if($('#cmbtipo').val()=='7'){
                var tipo = $('#cmbtipo').val()+"-"+$('#cmbtipo option:selected').text()+"-"+$('#cmbentretela option:selected').text();
            }else if($('#cmbtipo').val()=='9'){
                var tipo = $('#cmbtipo').val()+"-"+$('#cmbtipo option:selected').text()+"-"+$('#cmbforro option:selected').text();
            }else{
                var tipo = $('#cmbtipo').val()+"-"+$('#cmbtipo option:selected').text();
            }*/
            var tipo = $('#cmbtipo').val() + "-" + $('#cmbtipo option:selected').text();
            var comb = "";
            //comb += tipo+"|"+tela;
            comb += tipo;

            var cont = 1;
            for (var i = 1; i <= 5; i++) {
                comb += "|";
                if ($.trim($('#tcolor' + i).val()) != '') {
                    /*if($('#cmbtipo').val()== '7')
                        comb += $('#cmbentretela option:selected').text()+"@";
                    else if($('#cmbtipo').val()== '9')
                        comb += $('#cmbforro option:selected').text()+"/"+$('#cmbtela'+i+' option:selected').text()+"@";
                    else*/
                    comb += $('#cmbtela' + i + ' option:selected').text() + "@";
                    comb += $('#tcolor' + i).val().toUpperCase() + "@";
                    // if($('#cmbtipo').val()!='7'){//agrega proveedor y factura solo si es diferente de 7(entretela)
                    for (var j = cont; j <= cont + 1; j++) {
                        if ($('#cmbproveedor' + j).val() != '0') {
                            if ($('#cmbfactura' + j).val() != '0') {
                                comb += $('#cmbproveedor' + j).val() + "-" + $('#cmbfactura' + j).val() + "@";
                            } else {
                                comb += $('#cmbproveedor' + j).val() + "-@";
                            }
                        }
                    }
                    //}
                }
                cont = cont + 2;
            }
            var final = "";
            var td = "";
            if ($('#tcombinaciones').val() == '') {
                $('#tcombinaciones').val(comb + ","); //se agrega la 1er combinacion
            } else { //se concatena la siguiente combinacion a la original
                /*if($('#tcombinaciones').val().indexOf(tipo) > -1){
                    swal({title: 'Combinacion previamente agregada.!!', icon: "success", timer: 1300, showConfirmButton: false});
                    return;
                }else{*/
                final += $('#tcombinaciones').val();
                final += comb + ",";
                $('#tcombinaciones').val(final);
                //}
            }

            td += comb + ",";

            var tabla = comb.split('|');
            var t2 = tabla[0].split('-');
            document.getElementById("mytable").style.display = "block";
            $('#dv_comb').show();
            $('#dv_guardarC').show();
            var fila = '<tr id="row' + td + '"><td>' + t2[1] + '</td><td>' + tabla[1] + '</td><td>' + tabla[2] + '</td><td>' + tabla[3] + '</td><td>' + tabla[4] + '</td><td>' + tabla[5] + '</td><td><td><button type="button" name="remove" id="' + td + '" class="btn btn-danger btn-xs btn_remove">Quitar</button></td></tr>'; //contenido de la fila
            $('#mytable tr:first').after(fila);
            $('#cmbtipo').val('0');
            $('#cmbtipo').trigger('change');
            for (var j = 1; j <= 5; j++) {
                $('#tcolor' + j).val('');
                $('#cmbtela' + j).select2('destroy');
                $('#cmbtela' + j).val('0').select2();
            }
            for (var i = 1; i <= 10; i++) {
                $('#cmbproveedor' + i).select2('destroy');
                $('#cmbproveedor' + i).val('0');
                $('#cmbfactura' + i).select2('destroy');
                $('#cmbfactura' + i).val('0');
            }
        } else {
            swal({
                title: "Debes buscar una orden.!!",
                icon: "success",
                timer: 1400,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }
    }

    function Registrar_Habil() {
        $('#btn_habil').blur();
        var str = "";
        if ($('#trango').val() == '') {
            $('#tbl_habil tbody tr').each(function(index) {
                var campo1, campo2, campo3;
                var variantes = "";
                var tallas = "";

                $(this).children("td").each(function(index2) {
                    switch (index2) {
                        case 0:
                            campo1 = $(this).text();
                            break;
                        case 1:
                            campo2 = $(this).text().replace(String.fromCharCode(92), String.fromCharCode(92, 92));
                            break;
                        case 2:
                            campo3 = $(this).text().replace(String.fromCharCode(92), String.fromCharCode(92, 92));
                            for (var i = 1; i <= ($('#tvar').val()); i++) {
                                variantes += document.getElementById(i + '_' + campo3).value.trim() + '@';
                            }
                            var res = $('#tcor').val().split('|');
                            for (var j = 0; j < res.length - 1; j++) {
                                tallas += res[j] + "_" + document.getElementById(res[j] + '_' + campo3).value.trim() + '@';
                                //tallas += res[j]+"_"+($.trim($('#'+res[j]+"_"+campo3).val()))+'@';
                            }
                            break;
                            /*case 2:
                                campo3 = $(this).text();
                                for(var i=1; i<= ($('#tvar').val()); i++){
                                    variantes += ($.trim($('#'+i+"_"+campo3).val()))+'@';
                                }
                                var res = $('#tcor').val().split('|');
                                for(var j=0; j<res.length - 1; j++){
                                    tallas += res[j]+"_"+($.trim($('#'+res[j]+"_"+campo3).val()))+'@';
                                }
                                break;*/
                    }
                    //$(this).css('background-color', '#ECF8E0');
                })
                str += campo2 + '|' + campo3 + '|' + variantes + '|' + tallas + '>';
            })
            var param = 'str=' + str + '&ficha=' + $('#id_ficha').val() + '&accion=Registrar_Habilitacion';
        } else {
            var res = $('#trango').val().split('|'); //Separamos los rangos -> Tabla variantes y tallas
            var rango1 = res[0].split('-'); //Rango para variantes
            var rango2 = res[1].split('-'); //Rango para tallas
            var hab_var = "";
            var hab_talla = "";
            for (var i = 0; i <= rango1.length - 2; i++) { //rango de id´s a actualizar
                hab_var += rango1[i] + '|' + $('#v' + rango1[i]).val() + '@';
            }
            for (var j = 0; j <= rango2.length - 2; j++) { //rango de id´s a actualizar
                hab_talla += rango2[j] + '|' + $('#t' + rango2[j]).val() + '@';
            }

            var param = 'str=' + hab_var + "_" + hab_talla;
            param += '&accion=Modificar_Habilitacion';
        }

        $('#btn_habil').prop('disabled', true);
        $('#btn_habil').html('<i class="fas fa-sync-alt"></i> Guardando..!');
        $.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    swal({
                        title: "Cambios guardados.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    Buscar_Habil($('#id_ficha').val());
                    $('#btn_habil').prop('disabled', false);
                    $('#btn_habil').html('Guardar');
                } else {
                    swal({
                        title: "Error.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Registrar_Otro() {
        var ficha = $('#id_ficha').val();

        if ($('#tcomp1').val() != '') {
            if ($('#totro1').val() == '') {
                swal({
                    title: "Ingrese los datos completos.!!",
                    icon: "success",
                    timer: 1300,
                    showConfirmButton: false
                });
                $('#totro1').focus();
                return false;
            }
        }
        if ($('#totro1').val() != '') {
            if ($('#tcomp1').val() == '') {
                swal({
                    title: "Ingrese los datos completos.!!",
                    icon: "success",
                    timer: 1300,
                    showConfirmButton: false
                });
                $('#tcomp1').focus();
                return false;
            }
        }
        //return ficha;
    }

    function Registrar_Composicion() {
        $('#btn_composicion').blur();

        var str = "";
        var comp = "";
        var str1 = "";
        if ($('#tnew').val() != '') { //Agregar nuevas composiciones para combinaciones nuevas
            var res1 = $('#tnew').val().split('|');
            for (var j = 0; j < res1.length - 1; j++) {
                if ($('#ct_' + res1[j]).val() != '') {
                    str1 += res1[j] + "|" + $('#ct_' + res1[j]).val() + "@";
                } else {
                    swal({
                        title: "Ingrese la descripcion.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    $('#ct_' + res1[j]).focus();
                    return;
                }
            }

            var param = 'str=' + str1;
            param += '&accion=Ingresar_Composicion';
            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data != 0) {
                        var res = $('#tid').val().split('|');
                        for (var i = 0; i < res.length - 1; i++) {
                            if ($('#ct_' + res[i]).val() != '') {
                                str += res[i] + "|" + $('#ct_' + res[i]).val() + "@";
                            } else {
                                swal({
                                    title: "Ingrese la descripcion.!!",
                                    icon: "success",
                                    timer: 1300,
                                    showConfirmButton: false
                                });
                                $('#ct_' + res[i]).focus();
                                return;
                            }
                        }
                        var param = 'str=' + str;
                        if ($('#ttipo').val() == '1') {
                            param += '&accion=Modificar_Composicion';
                        } else {
                            param += '&accion=Ingresar_Composicion';
                        }
                        $.ajax({
                            url: 'Transacciones.php',
                            cache: false,
                            type: 'POST',
                            data: param,
                            success: function(data) {
                                if (data != 0) {
                                    swal({
                                        title: "Cambios guardados.!!",
                                        icon: "success",
                                        timer: 1300,
                                        showConfirmButton: false
                                    });
                                    Buscar_Composicion($('#id_ficha').val());
                                } else {
                                    swal({
                                        title: "Error.!!",
                                        icon: "success",
                                        timer: 1300,
                                        showConfirmButton: false
                                    });
                                }
                            },
                            error: function(request, status, error) {
                                alert(request.responseText);
                            }
                        });
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        } else {
            var cadena = $('#tid').val().split('-');
            var res = cadena[0].split('|');
            var compo = cadena[1].split('|');
            for (var i = 0; i < res.length - 1; i++) {
                //if($('#ct_'+res[i]).val()!=''){
                str += res[i] + "|" + $('#ct_' + res[i]).val() + "@";
                //}
                /*else{
                    swal({title: "Ingrese la descripcion.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    $('#ct_'+res[i]).focus();
                    return;
                }*/
            }
            for (var j = 0; j < compo.length - 1; j++) {
                comp += compo[j] + "|" + $('#cp_' + compo[j]).val() + "@";
            }

            var param = 'str=' + str + '&comp=' + comp;
            if ($('#ttipo').val() == '1') {
                param += '&accion=Modificar_Composicion';
            } else {
                param += '&accion=Ingresar_Composicion';
            }

            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data != 0) {
                        if ($('#totro_str').val() != '') {
                            var param = 'str=' + $('#totro_str').val();
                            param += '&id=' + $('#id_ficha').val();
                            param += '&accion=Ingresar_Otro';

                            $.ajax({
                                url: 'Transacciones.php',
                                cache: false,
                                type: 'POST',
                                data: param,
                                success: function(data) {
                                    if (data != 0) {
                                        swal({
                                            title: "Cambios guardados.!!",
                                            icon: "success",
                                            timer: 1300,
                                            showConfirmButton: false
                                        });
                                        Buscar_Composicion($('#id_ficha').val());
                                        Buscar_Otro($('#id_ficha').val());
                                        $('#totro_str').val('');
                                    } else {
                                        swal({
                                            title: "Error.!!",
                                            icon: "success",
                                            timer: 1300,
                                            showConfirmButton: false
                                        });
                                    }
                                },
                                error: function(request, status, error) {
                                    alert(request.responseText);
                                }
                            });
                        } else {
                            swal({
                                title: "Cambios guardados.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                            Buscar_Composicion($('#id_ficha').val());
                        }
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        }

        /*var comp_otro = "";
        var param = 'id='+$('#id_ficha').val();

        if($('#totro').val()==''){
            if($('#tcomp1').val()!='' && $('#tdesc1').val()!=''){
                comp_otro += $('#tcomp1').val()+"@"+$('#tdesc1').val()+"|";
            }
            if($('#tcomp2').val()!='' && $('#tdesc2').val()!=''){
                comp_otro += $('#tcomp2').val()+"@"+$('#tdesc2').val()+"|";
            }
            if($('#tcomp3').val()!='' && $('#tdesc3').val()!=''){
                comp_otro += $('#tcomp3').val()+"@"+$('#tdesc3').val()+"|";
            }
            param += '&otro='+comp_otro;
            param += '&accion=Ingresar_Otro';
        }else{//primero modificamos y luego registramos
            var ft = $('#totro').val().split('|');
            var res = ft.length;
            var nvo = "";
            for(var i=0; i<=ft.length-2; i++){
                var str = ft[i].split('_');
                comp_otro += +str[0]+'@'+$('#otro_'+str[0]).val()+'@'+str[1]+'@'+$('#ct_'+str[1]).val()+"|";
            }
            for(var j=res; j<=3; j++){
                if($('#tcomp'+j).val()!='' && $('#tdesc'+j).val()!=''){
                    nvo += $('#tcomp'+j).val()+'@'+$('#tdesc'+j).val()+'|';
                }
            }
            param += '&otro='+comp_otro+'&nvo='+nvo+'&accion=Modificar_Otro';
            //llevarnos los datos de update de otro existente y datos nuevos de otros a trans
            //falta recibir en transaaciones
        }
        //alert(param);

        $.ajax({
            url: 'Transacciones.php',
            cache:false,
            type: 'POST',
            data: param,
            success: function(data){
                if(data != 0){
                    swal({title: "Cambios guardados.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    Buscar_Composicion($('#id_ficha').val());
                }else{
                    swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });*/
    }

    function Agregar_Pieza() {
        $('#btn_agregar').blur();

        if ($('#tdesc').val() == '') {
            swal({
                title: "Ingrese la descripción.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tdesc').focus();
            return;
        }
        if ($('#tcant').val() == '') {
            swal({
                title: "Ingrese la cantidad.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tcant').focus();
            return;
        }
        if ($('#cmbtipoc').val() == '0') {
            swal({
                title: "Seleccione la combinacion.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#cmbtipoc').focus();
            return;
        }

        if ($('#tbuscar').val() != '') {
            $('#btn_agregar').prop('disabled', true);
            $('#btn_agregar').html('<i class="fas fa-sync-alt"></i> Guardando..!');
            var str = $('#tdesc').val().toUpperCase() + "|" + $('#tcant').val() + "|" + $('#cmbtipoc').val() + "@" + $('#cmbtipoc option:selected').text();
            var desc = $('#tdesc').val().toUpperCase();
            var final = "";

            if ($('#tstr').val() == '') {
                $('#tstr').val(str + "_"); //se agrega la 1er linea
            } else {
                /*if($('#tstr').val().indexOf(desc) > -1){
                    swal({title: 'Descripcion previamente agregada.!!', icon: "success", timer: 1300, showConfirmButton: false});
                    $('#tdesc').focus();
                    return;
                }else{*/
                final += $('#tstr').val();
                final += str + "_";
                $('#tstr').val(final);
                //}
            }
            var td = "";
            td += str + "_";

            var tabla = str.split('|');
            var t2 = tabla[2].split('@');

            if (!$('#dv_pzas').html()) {
                var tbl = '<table id="tbl_pzas" class="table table-bordered table-hover" style="display: none; font-size: 15px"><thead><tr><th>Nombre</th><th>Cantidad</th><th>Tipo</th><th></th></tr></thead></table>';
                $('#dv_pzas').html(tbl);
            }

            document.getElementById("tbl_pzas").style.display = "block";
            $('#dv_guardar').show();
            var fila = '<tr class="filas" id="row' + td + '"><td>' + tabla[0] + '</td><td>' + tabla[1] + '</td><td>' + t2[1] + '</td><td><button type="button" name="remove" id="' + td + '" class="btn btn-danger btn-xs btn_rmv_pzs">Quitar</button></td></tr>'; //contenido de la fila
            $('#tbl_pzas tr:first').after(fila);
            $('#tdesc').val('');
            $('#tcant').val('');
            $('#cmbtipoc').val('0');
            $('#btn_agregar').prop('disabled', false);
            $('#btn_agregar').html('Guardar');
        } else {
            swal({
                title: "Debes buscar una orden.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }
    }

    function Agregar_Otro() {
        $('#btn_otro').blur();

        if ($('#cmbtipo_otro').val() == '0') {
            swal({
                title: "Seleccione el tipo.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#cmbtipo_otro').focus();
            return;
        }
        /*if($('#tdesc_otro').val()==''){
            swal({title: "Ingrese la descripción.!!", icon: "success", timer: 1300, showConfirmButton: false});
            $('#tdesc_otro').focus();
            return;
        }*/
        if ($('#tcomp_otro').val() == '') {
            swal({
                title: "Ingrese la composicion.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tcomp_otro').focus();
            return;
        }
        $('#btn_otro').prop('disabled', true);

        var str = $('#cmbtipo_otro').val() + "|" + $('#cmbtipo_otro option:selected').text().toUpperCase() + "|" + $('#tdesc_otro').val().toUpperCase() + "|" + $('#tcomp_otro').val().toUpperCase();
        var final = "";

        if ($('#totro_str').val() == '') {
            $('#totro_str').val(str + "_"); //se agrega la 1er linea
        } else {
            final += $('#totro_str').val();
            final += str + "_";
            $('#totro_str').val(final);
        }

        var td = "";
        td += str + "_";

        var tabla = str.split('|');
        /*var t2 = tabla[2].split('@');*/

        /*if(!$('#dv_pzas').html()) {
            var tbl = '<table id="tbl_otro" class="table table-bordered table-hover" style="display: none; font-size: 15px"><thead><tr><th>Nombre</th><th>Cantidad</th><th>Tipo</th><th></th></tr></thead></table>';
            $('#dv_pzas').html(tbl);
        }*/
        document.getElementById("tbl_otro").style.display = "block";
        var fila = '<tr id="row' + td + '"><td>' + tabla[1] + '</td><td>' + tabla[2] + '</td><td>' + tabla[3] + '</td><td><button type="button" name="remove" id="' + td + '" class="btn btn-danger btn-xs btn_rmv_otro">Quitar</button></td></tr>'; //contenido de la fila
        $('#tbl_otro tr:first').after(fila);
        $('#cmbtipo_otro').val('0');
        $('#tdesc_otro').val('');
        $('#tcomp_otro').val('');
        $('#btn_otro').prop('disabled', false);
    }

    function Registrar_Pzas() {
        $('#btn_pzas').blur();

        if ($('#id_ficha').val() != '') {
            $('#btn_pzas').prop('disabled', true);
            $('#btn_pzas').html('<i class="fas fa-sync-alt"></i> Guardando..!');
            var param = 'str=' + $('#tstr').val();
            param += '&id=' + $('#id_ficha').val();
            param += '&accion=Ingresar_Piezas';

            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data != 0) {
                        swal({
                            title: "Cambios guardados.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                        Buscar_Piezas($('#id_ficha').val());
                        $('#tstr').val('');
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                    $('#btn_pzas').prop('disabled', false);
                    $('#btn_pzas').html('Guardar');
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        } else {
            swal({
                title: "Orden sin registrar.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }
    }

    function Buscar_Piezas(nm) {
        var param = 'ficha=' + nm + '&tp=piezas';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    $('#dv_guardar').show();
                    $('#dv_pzas').html(data);
                } else {
                    $('#dv_pzas').empty();
                    $('#dv_guardar').hide();
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_TipoP(nm) {
        var param = 'ficha=' + nm + '&tp=tipo_p';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    $('#dv_tipop').html(data);
                } else {
                    var select = "<select class='custom-select' id='cmbtipoc' tabindex='9'>'<option value='0'></option>'<optgroup><option value='1'>TELA BASE</option><option value='2'>COMBINACION 1</option><option value='3'>COMBINACION 2</option>";
                    select += "<option value='4'>COMBINACION 3</option><option value='5'>COMBINACION 4</option><option value='6'>COMBINACION 5</option><option value='7'>ENTRETELA</option><option value='9'>FORRO</option></optgroup></select>";
                    $('#dv_tipop').html(select);
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Validar_Check(nm, tej) {
        if (tej == 'Tejido') { //Validamos indicaciones de tejido
            if (nm == 1)
                $('#rplano').prop('checked', false); //desmarcamos el check
            else
                $('#rpunto').prop('checked', false);
        } else { //Validamos indicaciones de planchado
            if (nm == 1)
                $('#rreves').prop('checked', false);
            else
                $('#rnoplanchar').prop('checked', false);
        }
    }

    function Registrar_Indicaciones() {
        $('#btn_indicaciones').blur();

        if ($.trim($('#tindicaciones').val()) == '' && $.trim($('#tindicaciones2').val()) == '' && $.trim($('#tindicaciones3').val()) == '' && $.trim($('#tindicaciones4').val()) == '' && $.trim($('#tindicaciones5').val()) == '') {
            swal({
                title: "Ingrese una indicacion.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tindicaciones').focus();
            return;
        }

        if ($('#id_ficha').val() != '') {
            $('#btn_indicaciones').prop('disabled', true);
            $('#btn_indicaciones').html('<i class="fas fa-sync-alt"></i> Guardando..!');

            if ($('#rpunto').is(":checked"))
                var tejido = 'Tejido de punto';
            else if ($('#rplano').is(":checked"))
                var tejido = 'Telar plano';
            else
                var tejido = '';

            if ($('#rnoplanchar').is(":checked"))
                var planchado = 'No planchar';
            else if ($('#rreves').is(":checked"))
                var planchado = 'Planchar por el reves';
            else
                var planchado = ''

            var param = '';
            param += 'ind=' + $('#tindicaciones').val(); //indicaciones generales
            //param += '&ind2='+$('#tindicaciones2').val();//indicaciones de tejido
            param += '&ind2=' + tejido;
            param += '&ind3=' + $('#tindicaciones3').val(); //indicaciones corte
            param += '&ind4=' + $('#tindicaciones4').val(); //indicaciones cuidado -> Planchado
            param += '&ind5=' + $('#tindicaciones5').val(); //indicaciones referencia
            param += '&planchado=' + planchado;

            if ($('#tid_ind').val() == '') {
                param += '&ficha=' + $('#id_ficha').val() + '&accion=Registrar_Indicacion';
            } else {
                param += '&id=' + $('#tid_ind').val() + '&accion=Modificar_Indicacion';
            }

            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data != 0) {
                        swal({
                            title: "Cambios guardados.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                        Buscar_Indicaciones($('#id_ficha').val());
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
            $('#btn_indicaciones').prop('disabled', false);
            $('#btn_indicaciones').html('Guardar');
        } else {
            swal({
                title: "Debes buscar una orden.!!",
                icon: "success",
                timer: 1300,
                showConfirmButton: false
            });
            $('#tbuscar').focus();
            return;
        }
    }

    function Buscar_Indicaciones(nm) {
        var param = 'ficha=' + nm + '&tp=indicaciones';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    var res = data.split('@');
                    $('#tid_ind').val(res[0]);
                    $('#tindicaciones').val(res[1]);
                    //$('#tindicaciones2').val(res[2]);//Tipo de tejido
                    if (res[2] == 'TELAR PLANO')
                        $('#rplano').prop('checked', true);
                    else if (res[2] == 'TEJIDO DE PUNTO')
                        $('#rpunto').prop('checked', true);

                    if (res[6] == 'No planchar')
                        $('#rnoplanchar').prop('checked', true);
                    else if (res[6] == 'Planchar por el reves')
                        $('#rreves').prop('checked', true);

                    $('#tindicaciones3').val(res[3]);
                    $('#tindicaciones4').val(res[4]);
                    $('#tindicaciones5').val(res[5]);
                } else {
                    $('#tid_ind').val('');
                    $('#tindicaciones2').val('');
                    $('#tindicaciones4').val('');
                    $('#tindicaciones5').val('');
                    $('#tindicaciones').val('*CODIGOS X COLOR Y TALLAS (PEDIR SU FICHA A HABILITACION). *SE ANEXA HOJA DE REFENCIA DE MONARCH PARA REVISAR QUE SEA EXACTAMENTE IGUAL A LA ETIQUETA.');
                    $('#tindicaciones3').val('*FOLEAR TODO EL CORTE PARA EVITAR PRENDAS PINTAS. *CASAR DELANTEROS. *PLANCHAR CON CUIDADO, EVITE LUSTRAR LA PRENDA. *REPOSAR LA TELA MINIMO 24HRS. *SEPARAR DELANTERO PARA MANDAR ESTAMPAR. *SE MANDA PLANTILLA PARA MARCAR OJAL, CHARRETERA O BOTON AL FINAL DEL TRASO.');
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    /*function Registrar_Indicaciones(){
        $('#btn_indicaciones').blur();

        if($.trim($('#tindicaciones').val())=='' && $.trim($('#tindicaciones2').val())=='' && $.trim($('#tindicaciones3').val())=='' && $.trim($('#tindicaciones4').val())=='' && $.trim($('#tindicaciones5').val())==''){
            swal({title: "Ingrese una indicacion.!!", icon: "success", timer: 1300, showConfirmButton: false});
            $('#tindicaciones').focus();
            return;
        }

        if($('#id_ficha').val() != ''){
            $('#btn_indicaciones').prop('disabled', true);
            $('#btn_indicaciones').html('<i class="fas fa-sync-alt"></i> Guardando..!');
            var param = '';
                param += 'ind='+$('#tindicaciones').val();//indicaciones generales
                param += '&ind2='+$('#tindicaciones2').val();//indicaciones de tejido
                param += '&ind3='+$('#tindicaciones3').val();//indicaciones corte
                param += '&ind4='+$('#tindicaciones4').val();//indicaciones cuidado
                param += '&ind5='+$('#tindicaciones5').val();//indicaciones referencia

            if($('#tid_ind').val()==''){
                param += '&ficha='+$('#id_ficha').val()+'&accion=Registrar_Indicacion';
            }else{
                param += '&id='+$('#tid_ind').val()+'&accion=Modificar_Indicacion';
            }

            $.ajax({
                url: 'Transacciones.php',
                cache:false,
                type: 'POST',
                data:param,
                success: function(data){
                    if(data != 0){
                        swal({title: "Cambios guardados.!!", icon: "success", timer: 1300, showConfirmButton: false});
                        Buscar_Indicaciones($('#id_ficha').val());
                    }else{
                        swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    }
                },
                error: function (request, status, error) {alert(request.responseText);}
            });
            $('#btn_indicaciones').prop('disabled', false);
            $('#btn_indicaciones').html('Guardar');
        }else{
            swal({title: "Debes buscar una orden.!!", icon: "success", timer: 1300, showConfirmButton: false});
            $('#tbuscar').focus();
            return;
        }
    }

    function Buscar_Indicaciones(nm) {
        var param = 'ficha='+nm+'&tp=indicaciones';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data: param,
            success: function(data){
                if(data != 0){
                    var res = data.split('@');
                    $('#tid_ind').val(res[0]);
                    $('#tindicaciones').val(res[1]);
                    $('#tindicaciones2').val(res[2]);
                    $('#tindicaciones3').val(res[3]);
                    $('#tindicaciones4').val(res[4]);
                    $('#tindicaciones5').val(res[5]);
                }else{
                    $('#tid_ind').val('');
                    $('#tindicaciones2').val('');
                    $('#tindicaciones4').val('');
                    $('#tindicaciones5').val('');
                    $('#tindicaciones').val('*CODIGOS X COLOR Y TALLAS (PEDIR SU FICHA A HABILITACION). *SE ANEXA HOJA DE REFENCIA DE MONARCH PARA REVISAR QUE SEA EXACTAMENTE IGUAL A LA ETIQUETA.');
                    $('#tindicaciones3').val('*FOLEAR TODO EL CORTE PARA EVITAR PRENDAS PINTAS. *CASAR DELANTEROS. *PLANCHAR CON CUIDADO, EVITE LUSTRAR LA PRENDA. *REPOSAR LA TELA MINIMO 24HRS. *SEPARAR DELANTERO PARA MANDAR ESTAMPAR. *SE MANDA PLANTILLA PARA MARCAR OJAL, CHARRETERA O BOTON AL FINAL DEL TRASO.');
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }*/

    function Buscar_Proveedor(nm) {
        var param = 'icod=' + $('#cmbtela' + nm).val() + '&tp=proveedor&nm=' + nm;

        var tp = nm * 2; //1,2,3,4,5
        for (var i = tp - 1; i <= tp; i++) {
            $('#cmbproveedor' + i).val(0);
            $('#cmbfactura' + i).val(0);
        }
        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                res = data.split('@');
                $('#dv_prv' + res[1]).html(res[0]);
                $('#dv_prv' + res[3]).html(res[2]);
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Factura(nm, mn) {
        var param = 'icod=' + $('#cmbtela' + mn).val() + '&prv=' + $('#cmbproveedor' + nm).val() + '&nm=' + nm + '&tp=factura';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                $('#dv_factura' + nm).html(data);
                //$(".select2").select2();
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Corrida(nm) {
        var param = 'ficha=' + nm + '&tp=corrida';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                var res = data.split('@');
                //console.log(res[0]);
                $('#tcorrida').val('');
                //$('#tficha').val('');
                $('#dv_medidas').html(res[0]);
                if (res[2] == '1') { //Tiene ficha con medidas
                    //$('#tficha').val(res[1]+'-'+res[3]);
                    $('#tficha').val(res[3]);
                    $('#tcorrida').val(res[4]); //Lo ocupamos para saber a partir de que medida haremos insert despues de hacer update
                    $('#dvfoto').html('<div class="table-responsive"><img src="fotos/' + res[5] + '" style="width: 530px; height: 550px;"></div>');
                } else { //Ficha sin medidas
                    $('#tcorrida').val(res[1]); //Lo ocupamos para hacer el insert con las tallas de cada medida
                    $('#tficha').val('');
                    $('#dvfoto').html('<div class="table-responsive"><img src="fotos/' + res[5] + '" style="width: 530px; height: 550px;"></div>');
                }
                $('.select2').select2();
                $('#dv_btnMed').show();
                if (($('#tab_med').hasClass('nav-link active'))) {
                    if ($('#id_perfil').val() == '1' || $('#id_perfil').val() == '2') {
                        $('#add_med').show();
                    } else {
                        $('#add_med').hide();
                    }
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Registrar_Medidas() {
        $('#btn_medidas').blur();

        if ($('#tficha').val() == '') { //Validacion para saber si registramos o actualizamos
            if ($('#m1').val() == 0) {
                swal({
                    title: 'Ingrese las medidas.!!',
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#m1').focus();
                return;
            }

            $('#btn_medidas').prop('disabled', true);
            $('#btn_medidas').html('<i class="fas fa-sync-alt"></i> Guardando..!');

            /*var validar = "";
            *for(){
            * if($('#m'+j).val() != 0){
                validar += $('#m'+j).val()+'|';
             }
            * }
            * */

            var med = "";
            var model = $('#tcorrida').val().split('|'); //separa el string por talla
            for (var j = 1; j < 22; j++) { //rango de medidas
                if ($('#m' + j).val() != 0) {
                    for (var i = 0; i < model.length - 1; i++) {
                        med += $('#m' + j).val() + '|' + model[i] + '|' + $('#' + model[i] + j).val() + '|' + $('#t' + j).val() + '@';
                    }
                    med += '-';
                }
            }

            var param = 'med=' + med;
            param += '&ficha=' + $('#id_ficha').val();
            param += '&accion=Registrar_Medidas';

            $.ajax({
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data != 0) {
                        swal({
                            title: "Cambios guardados.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                        Buscar_Corrida($('#id_ficha').val());
                    } else {
                        swal({
                            title: "Error.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                    $('#btn_medidas').prop('disabled', false);
                    $('#btn_medidas').html('Guardar');
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        } else {
            $('#btn_medidas').prop('disabled', true);
            $('#btn_medidas').html('<i class="fas fa-sync-alt"></i> Guardando..!');
            var res = $('#tficha').val().split('|');
            var med = "";
            for (var i = 0; i <= res.length - 2; i++) { //rango de id´s a actualizar
                var ft = res[i].split('_');
                if ($('#med_' + ft[0]).val() != 0) { //validar que tenga medida seleccionada 05/03/2021
                    med += ft[1] + '|' + $('#m_' + ft[1]).val() + "|" + $('#med_' + ft[0]).val() + "|" + $('#tol_' + ft[0]).val() + '@';
                }
            }

            var param = 'med=' + med;
            param += '&accion=Modificar_Medidas';

            $.ajax({ //Hacemos ajax para actualizar medidas
                url: 'Transacciones.php',
                cache: false,
                type: 'POST',
                data: param,
                success: function(data) {
                    if (data.search('Error') != 1) {
                        var med = "";
                        var model = $('#tcorrida').val().split('|'); //separa el string por talla
                        for (var j = parseInt(ft[0]) + 1; j < 22; j++) { //rango de medidas
                            if ($('#md_' + j).val() != 0) {
                                for (var i = 0; i < model.length - 1; i++) {
                                    med += $('#md_' + j).val() + '|' + model[i] + '|' + $('#' + model[i] + j).val() + '|' + $('#t_' + j).val() + '@';
                                }
                                med += '-';
                            }
                        }
                        if (med != '') {
                            var param = 'med=' + med;
                            param += '&ficha=' + $('#id_ficha').val();
                            param += '&accion=Registrar_Medidas';

                            $.ajax({ //Hacemos ajax para registrar nuevas medidas
                                url: 'Transacciones.php',
                                cache: false,
                                type: 'POST',
                                data: param,
                                success: function(data) {
                                    if (data != 0) {
                                        swal({
                                            title: "Cambios guardados.!!",
                                            icon: "success",
                                            timer: 1300,
                                            showConfirmButton: false
                                        });
                                        Buscar_Corrida($('#id_ficha').val());
                                    } else {
                                        swal({
                                            title: "Error.!!",
                                            icon: "success",
                                            timer: 1300,
                                            showConfirmButton: false
                                        });
                                    }
                                    $('#btn_medidas').prop('disabled', false);
                                    $('#btn_medidas').html('Guardar');
                                },
                                error: function(request, status, error) {
                                    alert(request.responseText);
                                }
                            });
                        } else {
                            swal({
                                title: "Cambios guardados.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                            Buscar_Corrida($('#id_ficha').val());
                        }
                    } else {
                        swal({
                            title: "Error al actualizar los datos.!!",
                            icon: "success",
                            timer: 1300,
                            showConfirmButton: false
                        });
                    }
                    $('#btn_medidas').prop('disabled', false);
                    $('#btn_medidas').html('Guardar');
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        }
    }

    function Limpiar_Medidas(nm) {
        $('#' + nm).blur();

        swal({
                title: "Deseas borrar las medidas?",
                //text: "No podrás deshacer este paso...",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#28A745",
                confirmButtonText: "¡Si!",
                closeOnConfirm: false
            },

            function() {
                var param = 'id=' + nm + '&accion=Delete_Medidas';

                $.ajax({
                    url: 'Transacciones.php',
                    cache: false,
                    type: 'POST',
                    data: param,
                    success: function(data) {
                        if (data == 1) {
                            swal({
                                title: "Medidas eliminadas.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                            Buscar_Corrida($('#id_ficha').val());
                        } else {
                            swal({
                                title: "Error.!!",
                                icon: "success",
                                timer: 1300,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            });
    }

    function Eliminar_Habil(nm) {
        $('#h_' + nm).blur();
        var param = 'id=' + nm + '&accion=Delete_Habil';

        $.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data == 1) {
                    Buscar_Habil($('#id_ficha').val());
                } else {
                    swal({
                        title: "Error.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Eliminar_HabilP(nm) {
        var replaced = nm.replace(String.fromCharCode(92), String.fromCharCode(92, 92));
        document.getElementById(replaced).remove();
        //$('#'+replaced).blur();
    }

    function Agregar_Habil(nm) {
        var replaced = nm.replace(String.fromCharCode(92), String.fromCharCode(92, 92));
        var res = replaced.split('|');
        //$('#hp_'+res[0]).blur();

        var param = 'icod=' + res[0];
        param += '&idescr=' + res[1];
        param += '&var=' + $('#tvar').val();
        param += '&cor=' + $('#tcor').val();
        param += '&id=' + $('#id_ficha').val();
        param += '&accion=Agregar_Habil';

        $.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data == 1) {
                    Buscar_Habil($('#id_ficha').val());
                } else {
                    swal({
                        title: "Error.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Numerico(e) {
        var key = e.keyCode || e.which;
        var tecla = String.fromCharCode(key).toLowerCase();
        var letras = "/0123456789";
        if (letras.indexOf(tecla) == -1) {
            var especiales = [8, 9, 120, 233, 237, 243, 250, 32, 46];
            //32 espacio, ß 225, Á 193, Í 205, Ó 211, 201,218,241,209,42,
            var tecla_especial = false;
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            return tecla_especial;
        }
    }

    /*******funciones laboratorio********/
    function Modal_Lab(comb, vari, icod, corta, color, ntela) {
        $('#id_comb').val(comb);
        $('#id_varL').val(vari);
        $('#icod').val(icod);
        $('#ntela').val(ntela);

        param = 'id_var=' + vari;
        param += '&id_comb=' + comb;
        param += '&tela=' + ntela;
        param += '&id_ficha=' + $('#id_ficha').val();
        param += '&tp=consultar_laboratorio';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    var str = data.split('@');
                    var comp1 = str[0].split('|')
                    var comp2 = str[1].split('|')
                    var comp3 = str[2].split('|')
                    $('#tporcentajen1').val(comp1[0]);
                    $('#cmbcomposicion1').val(comp1[1]);
                    $('#tporcentajen2').val(comp2[0]);
                    $('#cmbcomposicion2').val(comp2[1]);
                    $('#tporcentajen3').val(comp3[0]);
                    $('#cmbcomposicion3').val(comp3[1]);
                }
                $('#btn_regLab').text('Guardar'); //cambiar texto del boton a MODIFICAR
                $(".modal-title").html("Agregar Composición   ");
                $(".modal-data").html(" " + corta + " " + color + " " + icod);
                $("#modal_lab").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Laboratorio(nm) {
        var param = 'ficha=' + nm + '&tp=laboratorio';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    $('#dv_tbl_lab').html(data);
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Registrar_Laboratorio() {
        if ($('#tporcentajen1').val() == '') {
            alert('Debes ingresar el porcentaje');
            $('#tporcentajen1').focus();
            return;
        }
        if ($('#cmbcomposicion1').val() == '0') {
            alert('Debes seleccionar la composicion');
            $('#cmbcomposicion1').focus();
            return;
        }
        if ($('#tporcentajen2').val() != '') {
            if ($('#cmbcomposicion2').val() == '0') {
                alert('Debes seleccionar la composicion 2');
                $('#cmbcomposicion2').focus();
                return;
            }
        }
        if ($('#tporcentajen3').val() != '') {
            if ($('#cmbcomposicion3').val() == '0') {
                alert('Debes seleccionar la composicion 3');
                $('#cmbcomposicion3').focus();
                return;
            }
        }
        var porcentaje = parseInt($('#tporcentajen1').val()) + ($('#tporcentajen2').val() != '' ? parseInt($('#tporcentajen2').val()) : 0) + ($('#tporcentajen3').val() != '' ? parseInt($('#tporcentajen3').val()) : 0);

        if (porcentaje > 100) {
            alert('La suma de los porcentajes es mayor al 100%');
            return;
        }
        var param = $('#flaboratorio').serialize();
        param += '&id_ficha=' + $('#id_ficha').val() + '&accion=Registrar_Laboratorio';

        $.ajax({
            url: 'Transacciones.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                if (data != 0) {
                    swal({
                        title: "Datos guardados.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                    Limpiar_Modal_Lab();
                } else {
                    swal({
                        title: "Error.!!",
                        icon: "success",
                        timer: 1300,
                        showConfirmButton: false
                    });
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Limpiar_Modal_Lab() {
        $('#tporcentajen1').val('');
        $('#tporcentajen2').val('');
        $('#tporcentajen3').val('');
        $('#cmbcomposicion1').val('');
        $('#cmbcomposicion2').val('');
        $('#cmbcomposicion3').val('');
        $('#modal_lab').modal('toggle');
    }
    /*Termina funciones laboratorio*/

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#cmbtela1').select2({
            dropdownCssClass: "myFont"
        });
        $('#cmbtela2').select2({
            dropdownCssClass: "myFont"
        });
        $('#cmbtela3').select2({
            dropdownCssClass: "myFont"
        });
        $('#cmbtela4').select2({
            dropdownCssClass: "myFont"
        });
        $('#cmbtela5').select2({
            dropdownCssClass: "myFont"
        });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>