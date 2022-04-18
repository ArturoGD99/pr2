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
<input type="hidden" id="cor" value = "">
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-pencil-ruler"></i>  Ficha de Confecci&oacute;n</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item"><a class="nav-link active" href="#modelo" data-toggle="tab">Modelo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#combinaciones" data-toggle="tab">Combinaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="#habil" data-toggle="tab">Habilitaci&oacute;n</a></li>
                        <li class="nav-item"><a class="nav-link" href="#composicion" data-toggle="tab">Composici&oacute;n</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pzas" data-toggle="tab">Piezas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#medidas" data-toggle="tab">Medidas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#indicaciones" data-toggle="tab">Indicaciones</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0" style="border: solid 0px blue">
                    <div class="chart tab-pane active" id="modelo" style="position: relative; border: solid 0px purple;">
                        <input type="hidden" id="id_ficha">
                        <div class="col-md-2">
                            <div class="input-group" style="width: 70%;">
                                <input id="tbuscar" type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" maxlength="6" autofocus="autofocus">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="#" id="btn_buscar" onclick="Buscar_Pedido();"><i class="fas fa-search"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <hr><br>
                        <form id="fmodelo">
                            <div class="row">
                                <div class="col-md-4"><img style="width: 100%; height: 100%" src="fotos/prueba.jpg"></div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Modelo</label><input type="text" class="form-control" id="tmodel" name="nmodelo" tabindex="1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Orden</label><input type="text" name="norden" class="form-control" id="torden" tabindex="2" readonly>
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
                                                <label>Linea</label><div id="dv_linea">
                                                    <select class="custom-select" id="cmblinea" name="ncmblinea" tabindex="9">
                                                        <option value="0"></option>
                                                        <optgroup>
                                                        </optgroup>
                                                    </select></div>
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
                                                        <option value="1">Dise&ntilde;adora 1</option>
                                                        <option value="2">Dise&ntilde;adora 2</option>
                                                        <option value="3">Dise&ntilde;adora 3</option>
                                                        <option value="4">Dise&ntilde;adora 4</option>
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
                                                        <optgroup></optgroup>
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
                                                        $rs = $query->Consultar("*","FCAT_TALLA","STATUS > 0","ID_TALLA");
                                                        while(!$rs->EOF){
                                                            echo "<option value='".$rs->fields['ID_TALLA']."'>".$rs->fields['TALLA']."</option>";
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
                                                        <option value="1">Patronista 1</option>
                                                        <option value="2">Patronista 2</option>
                                                        <option value="3">Patronista 3</option>
                                                        <option value="4">Patronista 4</option>
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
                                                        <option value="1">Muestrista 1</option>
                                                        <option value="2">Muestrista 2</option>
                                                        <option value="3">Muestrista 3</option>
                                                        <option value="4">Muestrista 4</option>
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
                                                        <option value="1">Graduadora 1</option>
                                                        <option value="2">Graduadora 2</option>
                                                        <option value="3">Graduadora 3</option>
                                                        <option value="4">Graduadora 4</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Descripcion</label><!--<input type="text" name="ndescripcion" class="form-control" id="tdescripcion" tabindex="10">-->
                                                <textarea id="tdescripcion" name="ndescripcion" class="form-control" style="resize: none; height: 38px" readonly></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Igual a</label><input type="text" name="nigual" class="form-control" id="tigual" tabindex="3">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Mod cliente</label><input type="text" name="nmodcliente" class="form-control" id="tmodcliente" tabindex="3" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                    <hr><br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Corrida</label>
                                                <div id="dv_corrida" class="input-group"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Subir imagen </label><input id="timagen" name="nimagen" accept="image/jpg, image/jpeg" type="file" tabindex="4"><!--accept="image/jpeg,image/png"-->
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div id="progress" class="col-md-2"><button type="button" class="btn btn-primary" id="btn_model" onclick="Registrar_Modelo();">Guardar</button></div>
                                <div class="col-md-5"></div>
                            </div>
                        </form>
                    </div>
                    <div class="chart tab-pane" id="combinaciones" style="position: relative;">
                        <input type="hidden" id="id_fichac">
                        <div class="col-md-2">
                            <div class="input-group" style="width: 70%;">
                                <input id="tbuscar3" type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" maxlength="6" autofocus="autofocus">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="#" id="btn_buscar3" onclick="Buscar_Combinaciones();"><i class="fas fa-search"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <hr><br>
                        <div class="row">
                            <!--<div class="col-md-1"></div>-->
                            <div class="col-md-12">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="d-flex" align="center">
                                        <th class="col-2">Variantes</th>
                                        <th class="col-2">1</th>
                                        <th class="col-2">2</th>
                                        <th class="col-2">3</th>
                                        <th class="col-2">4</th>
                                        <th class="col-2">5</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="d-flex">
                                        <td class="col-2">
                                            <div class="form-group">
                                                Tipo:
                                                <select style="width: 100%" class="form-control select2" id="cmbtipo" name="ncmbtipo" tabindex="9">
                                                    <option value="0">Seleccione la opci&oacute;n</option>
                                                    <optgroup>
                                                        <option value="1">Tela base</option>
                                                        <option value="2">Combinaci&oacute;n 1</option>
                                                        <option value="3">Combinaci&oacute;n 2</option>
                                                        <option value="4">Combinaci&oacute;n 3</option>
                                                        <option value="5">Combinaci&oacute;n 4</option>
                                                        <option value="6">Combinaci&oacute;n 5</option>
                                                        <option value="7">Entretela</option>
                                                        <option value="8">Otro</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                Tela:
                                                <select style="width: 100%" class="form-control select2" id="cmbtela" name="ncmbtela" onchange="Buscar_Proveedor();" tabindex="9">
                                                    <option value="0">Seleccione la opci&oacute;n</option>
                                                    <optgroup>
                                                        <?php
                                                        $rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%' AND ISTKACT > 0","ICOD");//
                                                        while(!$rs->EOF){
                                                            echo "<option value='".$rs->fields['ICOD']."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                                            $rs->MoveNext();
                                                        }
                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div><br>
                                            <div class="col-md-3" style="display: inline-block;"></div>
                                            <div class="col-md-5" style="display: inline-block;"><button type="button" class="btn btn-primary" id="btn_combinacion" onclick="Ingresar_Combinacion();">Agregar</button></div>
                                            <div class="col-md-3" style="display: inline-block;"></div>
                                        </td>
                                        <td class="col-2">
                                            <div class="row">
                                                <div class="form-group">
                                                    Color:
                                                    <input class="form-control" id="tcolor1">
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Proveedor1:
                                                        <div id="dv_prv1">
                                                            <select style="width: 100%" class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup></optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        Proveedor2:
                                                        <div id="dv_prv2">
                                                            <select style="width: 100%" class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup></optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Factura1:
                                                        <div id="dv_factura1"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Factura2:
                                                        <div id="dv_factura2"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <div class="row">
                                                <div class="form-group">
                                                    Color:
                                                    <input class="form-control" id="tcolor2">
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Proveedor3:
                                                        <div id="dv_prv3"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Proveedor4:
                                                        <div id="dv_prv4"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Factura3:
                                                        <div id="dv_factura3"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Factura4:
                                                        <div id="dv_factura4"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <div class="row">
                                                <div class="form-group">
                                                    Color:
                                                    <input class="form-control" id="tcolor3">
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Proveedor5:
                                                        <div id="dv_prv5"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Proveedor6:
                                                        <div id="dv_prv6"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Factura5:
                                                        <div id="dv_factura5"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Factura6:
                                                        <div id="dv_factura6"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <div class="row">
                                                <div class="form-group">
                                                    Color:
                                                    <input class="form-control" id="tcolor4">
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Proveedor7:
                                                        <div id="dv_prv7"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Proveedor8:
                                                        <div id="dv_prv8"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Factura7:
                                                        <div id="dv_factura7"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Factura8:
                                                        <div id="dv_factura8"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-2">
                                            <div class="row">
                                                <div class="form-group">
                                                    Color:
                                                    <input class="form-control" id="tcolor5">
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Proveedor9:
                                                        <div id="dv_prv9"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Proveedor10:
                                                        <div id="dv_prv10"><select style="width: 100%" class="form-control select2" tabindex="9">
                                                            <option value="0">      </option>
                                                            <optgroup></optgroup>
                                                        </select></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: inline-block">
                                                    <div class="form-group">
                                                        Factura9:
                                                        <div id="dv_factura9"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                    <div class="form-group">
                                                        Factura10:
                                                        <div id="dv_factura10"><select style="width: 100%"class="form-control select2" tabindex="9">
                                                                <option value="0">      </option>
                                                                <optgroup>
                                                                </optgroup>
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12" id="factu">
                                    <div id="tbl_fact" class="table-responsive">
                                        <table  id="mytable" class="table table-bordered table-hover" style="display: none; font-size: 15px">
                                            <tr><th>TIPO</th><th>TELA</th><th>VARIANTE 1</th><th>VARIANTE 2</th><th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th></th>
                                            </tr>
                                        </table>
                                    </div>
                                </div><input type="hidden" id="tcombinaciones">
                            </div>
                            </div>
                            <!--<div class="col-md-1"></div>-->
                        </div>
                        <br>
                        <div id="dv_comb" class="row" style="display: none">
                            <div class="col-md-5"></div>
                            <div id="progress" class="col-md-2"><button type="button" class="btn btn-primary" id="btn_comb" onclick="Registrar_Combinacion();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="habil" style="position: relative;"><div id="dv_habil"></div>
                    </div>
                    <div class="chart tab-pane" id="composicion" style="position: relative;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Composicion</label>
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Tela base</option>
                                            <option value="2">Combinaci&oacute;n 1</option>
                                            <option value="3">Combinaci&oacute;n 2</option>
                                            <option value="4">Combinaci&oacute;n 3</option>
                                            <option value="5">Combinaci&oacute;n 4</option>
                                            <option value="6">Combinaci&oacute;n 5</option>
                                            <option value="7">Entretela</option>
                                            <option value="8">Otro</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Descripci&oacute;n</label><input type="text" name="norden" class="form-control" id="torden" tabindex="2">
                                </div>
                            </div>
                        </div><br>
                    </div>
                    <div class="chart tab-pane" id="pzas" style="position: relative;">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="custom-select" id="cmbgrado" name="ncmbgrado" tabindex="9">
                                        <option value="0">Seleccione la opci&oacute;n</option>
                                        <optgroup>
                                            <option value="1">Tela base</option>
                                            <option value="2">Combinaci&oacute;n 1</option>
                                            <option value="3">Combinaci&oacute;n 2</option>
                                            <option value="4">Combinaci&oacute;n 3</option>
                                            <option value="3">Combinaci&oacute;n 4</option>
                                            <option value="4">Combinaci&oacute;n 5</option>
                                            <option value="4">Entretela</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Nombre</label><input type="text" name="norden" class="form-control" id="torden" tabindex="2">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label><input type="text" name="npedido" class="form-control" id="tpedido" tabindex="3">
                                </div>
                            </div>
                        </div><br>
                    </div>
                    <div class="chart tab-pane" id="medidas" style="position: relative;">
                        <input type="hidden" id="tcorrida">
                        <input type="hidden" id="tficha">
                        <div class="col-md-2">
                            <div class="input-group" style="width: 70%;">
                                <input id="tbuscar2" type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" maxlength="6" autofocus="autofocus">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="#" id="btn_buscar2" onclick="Buscar_Corrida();"><i class="fas fa-search"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="dv_medidas" class="container"></div><br>
                        <div id="dv_btn" class="row" style="display: none; border: solid 0px red">
                            <div class="col-md-5"></div>
                            <div id="progress" class="col-md-2"><button type="button" class="btn btn-primary" id="btn_medidas" onclick="Registrar_Medidas();">Guardar</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="indicaciones" style="position: relative;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Indicaciones grals.</label>
                                    <textarea id="tindicaciones" name="nindicaciones" class="form-control" rows="5" placeholder="Ingrese el texto..." style="resize: none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="card-footer" align="center"></div>
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
        $('#tbuscar').keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                Buscar_Pedido();
            }
        });

        $('#tbuscar2').keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                Buscar_Corrida();
            }
        });

        $('#tbuscar3').keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                Buscar_Combinaciones();
            }
        });

        /*$('body').on('click', '#mytable tr', function() {
            var idtr = $(this).attr('id');
            alert("ID TR: "+idtr);
        })*/

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");//id del boton quitar
            /*document.getElementById("row"+button_id).remove();
            var td = button_id;
            var str = $('#tcombinaciones').val();
            var res = str.replace(td,"");
            $('#tcombinaciones').val(res);

            var nFilas = $("#mytable tr").length;
            if (nFilas == 1){
                document.getElementById("mytable").style.display = "none";
                $('#dv_comb').hide();
            }*/
            if($('#id_fichac').val() == ''){
                document.getElementById("row"+button_id).remove();
                var td = button_id;
                var str = $('#tcombinaciones').val();
                var res = str.replace(td,"");
                $('#tcombinaciones').val(res);

                var nFilas = $("#mytable tr").length;
                if (nFilas == 1){
                    document.getElementById("mytable").style.display = "none";
                    $('#dv_comb').hide();
                }
            }else{
                var param = 'id='+button_id;
                param+= '&accion=Eliminar_Combinacion';

                if(isNaN(button_id) == false){
                    $.ajax({
                        url: 'Transacciones.php',
                        cache:false,
                        type: 'POST',
                        data: param,
                        success: function(data){
                            if(data > 0){
                                swal({title: "Combinacion eliminada.!!", icon: "success", timer: 1300, showConfirmButton: false});
                                Buscar_Combinaciones();
                            }else if(data == 'Error'){
                                swal({title: "Error al eliminar la factura", icon: "error", timer: 1300, showConfirmButton: false});
                            }else if(data == 'Nueva'){

                            }
                        },
                        error: function (request, status, error) {alert(request.responseText);}
                    });
                }else{
                    document.getElementById("row"+button_id).remove();
                    var td = button_id;
                    var str = $('#tcombinaciones').val();
                    var res = str.replace(td,"");
                    $('#tcombinaciones').val(res);
                }
            }
        });
    });

    function  Buscar_Pedido() {
        $('#btn_buscar').blur();
        if($.trim($('#tbuscar').val()) == ''){
            swal({title: 'Ingrese la orden.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#tbuscar').focus();
            return;
        }

        var param ='orden='+$('#tbuscar').val().toUpperCase()+'&tp=orden';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                if(data.search('Ficha')!=-1){
                    res = data.split('@');
                    $('#tmodel').val(res[0]);
                    $('#torden').val(res[1]);
                    $('#tpedido').val(res[2]);
                    $('#cmbcliente').val(res[3]);
                    Ajax_Dinamico('consultas/busquedas.php','dv_marca','cliente='+res[3]+'&tp=cte'+'&mc='+res[4]);
                    Ajax_Dinamico('consultas/busquedas.php','dv_linea','cliente='+res[3]+'&tp=linea'+'&marca='+res[4]+'&mc='+res[5]);
                    Ajax_Dinamico('consultas/busquedas.php','dv_prenda','marca='+res[4]+'&tp=prenda'+'&linea='+res[5]+'&mc='+res[9]);
                    $('#tsemana').val(res[6]);
                    $('#ttemporada').val(res[7]);
                    $('#cmbdisenadora').val(res[8]);
                    $('#cmbtalla').val(res[10]);
                    $('#cmbpatronista').val(res[11]);
                    $('#cmbmuestrista').val(res[12]);
                    $('#cmbgraduadora').val(res[13]);
                    $('#tdescripcion').val(res[14]);
                    $('#tigual').val(res[15]);
                    $('#tmodcliente').val(res[16]);
                    $('#dv_corrida').html(res[17]);
                    $('#id_ficha').val(res[19]);
                }else if(data.search('Proscai')!=-1){
                    res = data.split('@');
                    str = res[0].split('|');
                    $('#tmodel').val(str[2]);
                    $('#torden').val(str[1]);
                    $('#tpedido').val(str[0]);
                    $('#tsemana').val(str[4]);
                    var desc = str[3].split('\r');
                    $('#tdescripcion').val(desc[1]+"\n"+desc[3]);
                    $('#tmodcliente').val(desc[2]);
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
                }else{
                    swal({title: 'Sin resultados.!!', icon: "success", timer: 1300, showConfirmButton: false});
                    $('#tbuscar').focus();
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Buscar_Combinaciones(){
        $('#btn_buscar3').blur();
        if($.trim($('#tbuscar3').val()) == ''){
            swal({title: 'Ingrese la orden.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#tbuscar3').focus();
            return;
        }

        var param ='orden='+($('#tbuscar3').val().toUpperCase())+'&tp=combinacion';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                if(data != 0){
                    var res = data.split('&')
                    if(res[0]!=''){
                        $('#tbl_fact').html(res[0]);
                        $('#id_fichac').val(res[1]);
                    }else{
                        $('#id_fichac').val(res[1]);
                    }
                }else{
                    swal({title: 'Sin resultados.!!', icon: "success", timer: 1300, showConfirmButton: false});
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Buscar_Marcas() {
        var param ='cliente='+$('#cmbcliente').val()+'&tp=cte';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                $('#dv_marca').html(data);
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Buscar_Linea() {
        var param ='cliente='+$('#cmbcliente').val()+'&marca='+($('#cmbmarca').val())+'&tp=linea';
        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                $('#dv_linea').html(data);
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Buscar_Prendas() {
        var param ='marca='+$('#cmbmarca').val()+'&linea='+$('#cmblinea').val()+'&tp=prenda';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                $('#dv_prenda').html(data);
                //Buscar_Tallas();
            },
            error: function (request, status, error) {alert(request.responseText);}
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

    function Buscar_Corrida() {
        $('#btn_buscar2').blur();

        if($.trim($('#tbuscar2').val()) == ''){
            swal({title: 'Ingrese la orden.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#tbuscar2').focus();
            return;
        }

        var param ='orden='+($('#tbuscar2').val().toUpperCase())+'&tp=corrida';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                var res = data.split('@');
                $('#tcorrida').val('');
                $('#tficha').val('');
                $('#dv_medidas').html(res[0]);
                if(res[2]=='1')//{
                    $('#tficha').val(res[1]+'-'+res[3]);
                else
                    $('#tcorrida').val(res[1]);
                $('#dv_btn').show();
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }
    
    function Cargar_Habil() {
        var param = 'id_prenda='+$('#cmbprenda').val()+'&tp=habil';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                $('#dv_habil').html(data);
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Registrar_Modelo(){
        $('#btn_model').blur();

        var corrida = "";
        for (var j = 1; j < $('#cor').val(); j++) {
            corrida += $('#cor'+j).val()+'|';
            /*if ($('#check'+j).is(":checked")){
                alert("Esta checkeado "+$('#check'+j).val());
            }*/
        }

        var param = $('#fmodelo').serialize();
        var title = "";
        if($('#id_ficha').val() == ''){
            param += '&corrida='+corrida;
            param += '&accion=Registrar_Modelo';
            title += "Registro exitoso.!!";
        }else{
            param += '&ficha='+$('#id_ficha').val();
            param += '&accion=Modificar_Modelo';
            title += "Se han actualizado los datos.!!";
        }

        $.ajax({
            url: 'Transacciones.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                if(data == 'Existe'){
                    swal({title: "La orden ya se encuentra registrada", icon: "success", timer: 1300, showConfirmButton: false});
                    $('#tbuscar').focus();
                }else if(data == 1){
                    swal({title: title, icon: "success", timer: 1300, showConfirmButton: false});
                    //Ajax_Dinamico('entregas.php','centro','');
                }else if(data == 'Error'){
                    swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    //Ajax_Dinamico('entregas.php','centro','');
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });

        /*
         var myfiles = document.getElementById("timagen");
         var files = myfiles.files;
         var foto = new FormData();
         for (i = 0; i < files.length; i++){
         foto.append('file' + i, files[i]);
         }

        $.ajax({
            url: 'upload.php?img='+$('#tmodel').val(),
            type: 'POST',
            contentType: false,
            data: foto,
            processData: false,
            cache: false,
        }).done(function(data){
            var msg = data.split('|');
            if(msg[0] == 'Incorrecto'){
                swal({title: "La extension deber ser JPG, estas ingresando: "+msg[1], timer: 2000, showConfirmButton: false});
            }else if(msg[0] == 'Excede'){
                swal({title: "El tamaño maximo permitido es de 1 Mb.!!", timer: 1500, showConfirmButton: false});
            }else if(msg[0] == 'Exito'){
                $.ajax({
                    url: 'Transacciones.php',
                    cache:false,
                    type: 'POST',
                    data:param,
                    success: function(data){
                        if(data == 'Existe'){
                            swal({title: "La orden ya se encuentra registrada", icon: "success", timer: 1300, showConfirmButton: false});
                            $('#tbuscar').focus();
                        }else if(data == 1){
                            swal({title: "Cambios guardados.!!", icon: "success", timer: 1300, showConfirmButton: false});
                            //Ajax_Dinamico('entregas.php','centro','');
                        }else if(data == 'Error'){
                            swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                            //Ajax_Dinamico('entregas.php','centro','');
                        }
                    },
                    error: function (request, status, error) {alert(request.responseText);}
                });
            }
        });*/
    }

    function Registrar_Combinacion() {
        $('#btn_comb').blur();

        var param = 'str='+$('#tcombinaciones').val();
            param += '&id='+$('#id_fichac').val();
            param += '&accion=Ingresar_Combinacion';

        $.ajax({
            url: 'Transacciones.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                if(data != 0){
                    swal({title: "Cambios guardados.!!", icon: "success", timer: 1300, showConfirmButton: false});
                }else{
                    swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });

    }

    function Buscar_Proveedor() {
        var param = 'icod='+$('#cmbtela').val()+'&tp=proveedor';

        for (var i=1; i<=10; i++){
            $('#cmbproveedor'+i).val(0);
            $('#cmbfactura'+i).val(0);
        }

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                res = data.split('@');
                for(var i=1; i<=res.length-1; i++){
                    $('#dv_prv'+i).html(res[i-1]);
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Buscar_Factura(nm){
        var param ='icod='+$('#cmbtela').val()+'&prv='+$('#cmbproveedor'+nm).val()+'&nm='+nm+'&tp=factura';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data:param,
            success: function(data){
                $('#dv_factura'+nm).html(data);
                //$(".select2").select2();
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Ingresar_Combinacion() {
        $('#btn_combinacion').blur();

        if($('#cmbtipo').val() == '0'){
            swal({title: 'Seleccione el tipo.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#cmbtipo').select2('open');
            return;
        }
        if($('#cmbtela').val() == '0'){
            swal({title: 'Seleccione la tela.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#cmbtela').select2('open');
            return;
        }
        if($('#tcolor1').val()==''){
            swal({title: 'Ingrese al menos una variante.!!', icon: "success", timer: 1300, showConfirmButton: false});
            $('#tcolor1').focus();
            return;
        }

        var tipo = $('#cmbtipo').val()+"-"+$('#cmbtipo option:selected').text();
        var tela = $('#cmbtela option:selected').text();
        var comb = "";

        comb += tipo+"|"+tela;

        var cont = 1;
        for(var i=1; i<=5; i++){
            comb += "|";
            if($.trim($('#tcolor'+i).val())!=''){
                comb += $('#tcolor'+i).val().toUpperCase()+"@";
                for(var j=cont; j<=cont+1; j++){
                    if($('#cmbproveedor'+j).val()!='0'){
                        if($('#cmbfactura'+j).val()!='0'){
                            comb += $('#cmbproveedor'+j).val()+"-"+$('#cmbfactura'+j).val()+"@";
                        }else{
                            swal({title: 'Seleccione la factura.!!', icon: "success", timer: 1300, showConfirmButton: false});
                            $('#cmbfactura'+j).focus();
                            return;
                        }
                    }
                }
            }
            cont = cont+2;
        }
        var final = "";
        var td = "";
        if($('#tcombinaciones').val() == ''){
            $('#tcombinaciones').val(comb+",");//se agrega la 1er factura con sus modelos
        }else{//se concatena la siguiente factura a la original
            final += $('#tcombinaciones').val();
            final += comb+",";
            $('#tcombinaciones').val(final);
        }

        td += comb+",";

       var tabla = comb.split('|');
       var t2 = tabla[0].split('-');
       document.getElementById("mytable").style.display = "block";
       $('#dv_comb').show();
       var fila = '<tr id="row' + td + '"><td>' + t2[1] + '</td><td>' + tabla[1] + '</td><td>' + tabla[2] + '</td><td>' + tabla[3] + '</td><td>' + tabla[4] + '</td><td>' + tabla[5] + '</td><td>' + tabla[6] + '</td><td><button type="button" name="remove" id="' + td + '" class="btn btn-danger btn-xs btn_remove">Quitar</button></td></tr>';//contenido de la fila
       $('#mytable tr:first').after(fila);
    }

    function Registrar_Medidas() {
        $('#btn_medidas').blur();
        if($('#tficha').val()==''){
            if($('#m1').val() == 0){
                swal({title: 'Ingrese las medidas.!!', icon: "success", timer: 1500, showConfirmButton: false});
                $('#m1').focus();
                return;
            }
            var med = "";
            var model = $('#tcorrida').val().split('|');//separa el string por talla
            for(var j = 1; j<11; j++){
                if($('#m'+j).val() != 0){
                    for(var i=0; i<model.length-1; i++) {
                        //if($('#'+model[i]+j).val()!=''){
                        med+= $('#m'+j).val()+'|'+model[i]+'|'+$('#'+model[i]+j).val()+'|'+$('#t'+j).val()+'@';
                        //alert('Medida'+j+': '+$('#m'+j).val()+' Talla '+model[i]+': '+$('#'+model[i]+j).val()+' Tol'+j+': '+$('#t'+j).val());
                        //}
                    }
                    med+='-';
                }
            }

            var param = 'med='+med;
            param+= '&orden='+$('#tbuscar2').val().toUpperCase();
            param+= '&accion=Registrar_Medidas';

            $.ajax({
                url: 'Transacciones.php',
                cache:false,
                type: 'POST',
                data: param,
                success: function(data){
                    if(data != 0){
                        swal({title: "Cambios guardados.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    }else{
                        swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    }
                },
                error: function (request, status, error) {alert(request.responseText);}
            });
        }else{
            var res = $('#tficha').val().split('-');
            var rango = res[1].split('|');
            var med = "";
            for(var i=rango[0]; i<=rango[1];i++){
                med+= i+'|'+$('#'+i).val()+'@';
            }

            var param = 'med='+med;
            param+= '&accion=Modificar_Medidas';

            $.ajax({
                url: 'Transacciones.php',
                cache:false,
                type: 'POST',
                data: param,
                success: function(data){
                    if(data != 0){
                        swal({title: "Cambios guardados.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    }else{
                        swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    }
                },
                error: function (request, status, error) {alert(request.responseText);}
            });
        }
    }

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>