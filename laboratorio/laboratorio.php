<?php
include_once('../registro.php');
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
                <h3 class="card-title"><i class="fas fa-pencil-ruler"></i> Laboratorio</h3>&nbsp;&nbsp;&nbsp;
                <!--fas fa-tshirt-->
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item"><a class="nav-link active" href="#pedidos" onclick="Validar_Tab(0)" data-toggle="tab">Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rango" onclick="Validar_Tab(0)" data-toggle="tab">Rango</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body"><input type="hidden" id="id_ficha"><input type="hidden" id="cor" value="">
                <div class="tab-content p-0" style="border: solid 0px blue">
                    <div class="chart tab-pane active" id="pedidos" style="position: relative; border: solid 0px purple;">
                        <form id="fmodelo">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select class='form-control select2' id="cmbcliente" name="ncmbcliente" onchange="Buscar_Marcas();" tabindex="1">
                                            <option value="0"></option>
                                            <optgroup>
                                                <?php
                                                $rs = $query->Consultar_Proscai("*", "FCLI", "", "CLICOD");
                                                while (!$rs->EOF) {
                                                    echo "<option value='" . $rs->fields['CLICOD'] . "'>" . $rs->fields['CLICOD'] . " - " . $rs->fields['CLINOM'] . "</option>";
                                                    $rs->MoveNext();
                                                }
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr><br>

                        </form>
                    </div>
                    <div class="chart tab-pane" id="rango" style="position: relative;">
                        <form id="Frango">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select class='form-control select2' id="cmbcliente1" name="ncmbcliente1" onchange="Modal_Ord();" tabindex="1">
                                            <!--onchange="Buscar_Marcas();" -->
                                            <option value="0"></option>
                                            <optgroup>
                                                <?php
                                                $rs = $query->Consultar_Proscai("*", "FCLI", "", "CLICOD");
                                                while (!$rs->EOF) {
                                                    echo "<option value='" . $rs->fields['CLICOD'] . "'>" . $rs->fields['CLICOD'] . " - " . $rs->fields['CLINOM'] . "</option>";
                                                    $rs->MoveNext();
                                                }
                                                ?>
                                            </optgroup>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                                <div id="btn_Cambiar" class="col-md-3">
                                    <button type="button" class="btn btn-primary" onclick="Modal_Ord();"><i class="nav-icon fas fa-window-restore"></i></button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="dv_pedidos" class="table-responsive"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><br>
            <div class="card-footer" align="center"></div>
            <div class="container">
                <!--Modal para mostrar la ficha de diseno-->
                <div class="modal fade in" id="modal_pdf">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Factura</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div id="dv_pdf" style="height:100vh; display: none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="col-md-12">

</div>
<div class="modal fade in" id="modal_ord" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl " style="width:1000vh;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="Limpiar_Modal_Ord();">
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
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div id="dv_tbl_lab" class="table-responsive"></div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Selecciona el rango de Q</label> <br>
                                <div class="input-group mb-3">
                                    <label>Q Inicio</label>
                                    <input class="form-control" id="Qinicio" name="ninicio" type="text">
                                    <label>Q Fin</label>
                                    <input class="form-control" id="Qfin" name="nfin" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-secondary" value='Cancelar' onclick="Limpiar_Modal_Ord();" data-dismiss="modal">
                <input type="button" class="btn btn-primary" value='Guardar' onclick="Buscar_Ordenes();">
            </div>
        </div>
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
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div id="dv_tbl_lab" class="table-responsive"></div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>PR</label>
                                <input type="text" class="form-control" id="tpr" name="npr" tabindex="1">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>%</label>
                                <input type="number" class="form-control porcent1" id="tporcentajen1" name="nporcentaje1" min='0' tabindex="1">
                            </div>
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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
        $('#btn_Cambiar').hide();
        // $('#tbuscar').keypress(function(e) {
        //     var code = (e.keyCode ? e.keyCode : e.which);
        //     if(code==13){
        //         e.preventDefault();
        //         Buscar_Pedido();
        //     }
        // });
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

    function Abrir_Modal_Lab(nm) {
        $('#id_' + nm).blur();

        var param = 'id=' + nm;
        var first = $('#id_' + nm).html();
        var replace = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";
        $('#id_' + nm).html(replace);
        //alert(param);
        $.ajax({
            url: 'pdf/pdf.php',
            type: "POST",
            data: param,
            success: function(pdf) {
                //$('.overlay').remove();
                $(".modal-title").html("Ficha de Confección: <b>" + $('#torden').val() + "</b>");
                $("#modal_pdf").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
                $('#dv_pdf').show();
                $('#dv_pdf').html('<iframe width="100%" height="98%" type="application/pdf" src="data:application/pdf;base64,' + pdf + '"></iframe>');
                $('#id_' + nm).html(first);
            },
            error: function(request, error) {
                swal("Ha ocurrido un error");
                //$('.overlay').remove();
            }
        });
    }

    function Buscar_Ordenes() {
        var param = 'clicod=' + $('#cmbcliente1').val();
        param += '&qinicio=' + $('#Qinicio').val();
        param += '&qfin=' + $('#Qfin').val();
        param += '&tp=ordenes';
        alert(param);
        $.ajax({
            url: 'laboratorio/consultas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                // alert(data);
                $('#btn_Cambiar').show();
                $('#dv_pedidos').html(data);
                $('#modal_ord').modal('toggle');
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Buscar_Pedidos() {
        var param = 'clicod=' + $('#cmbcliente').val();
        param += '&tp=pedidos';

        $.ajax({
            url: 'habilitacion/consultas.php',
            cache: false,
            type: 'POST',
            data: param,
            success: function(data) {
                $('#dv_pedidos').html(data);
                $(document).ready(function() {
                    $('#tbl_pedidos').DataTable({
                        pagingType: 'full',
                    });
                });
            },
            error: function(request, status, error) {
                alert(request.responseText);
            }
        });
    }

    function Modal_Lab(nm) {
        $('#id_' + nm).blur();
        //alert(nm);

        /*$('#id_comb').val(comb);
        $('#id_varL').val(vari);
        $('#icod').val(icod);
        $('#ntela').val(ntela);

        param = 'id_var='+vari;
        param += '&id_comb='+comb;
        param += '&tela='+ntela;
        param += '&id_ficha='+$('#id_ficha').val();
        param += '&tp=consultar_laboratorio';

        $.ajax({
            url: 'consultas/busquedas.php',
            cache:false,
            type: 'POST',
            data: param,
            success: function(data){
                if(data!=0){
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
                $('#btn_regLab').text('Guardar');//cambiar texto del boton a MODIFICAR
                $(".modal-title").html("Agregar Composición   ");
                $(".modal-data").html(" "+corta+" "+color+" "+icod);
                $("#modal_lab").modal({backdrop: 'static', keyboard: false, show: true});
            },
            error: function (request, status, error) {alert(request.responseText);}
        });*/
        $('#btn_regLab').text('Guardar'); //cambiar texto del boton a MODIFICAR
        $(".modal-title").html("Agregar Composición   ");
        //$(".modal-data").html(" "+corta+" "+color+" "+icod);
        $("#modal_lab").modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        Buscar_Laboratorio(nm);
    }

    function Modal_Ord(nm) {
        $('#id_' + nm).blur();
        Limpiar_Modal_Ord();
        $('#btn_regLab').text('Guardar'); //cambiar texto del boton a MODIFICAR
        $(".modal-title").html("Agregar Composición   ");
        //$(".modal-data").html(" "+corta+" "+color+" "+icod);
        $("#modal_ord").modal({
            backdrop: 'static',
            keyboard: false,
            show: true
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

    function Limpiar_Modal_Lab() {
        $('#tporcentajen1').val('');
        $('#tporcentajen2').val('');
        $('#tporcentajen3').val('');
        $('#cmbcomposicion1').val('');
        $('#cmbcomposicion2').val('');
        $('#cmbcomposicion3').val('');
        $('#modal_lab').modal('toggle');
    }

    function Limpiar_Modal_Ord() {
        // Colocar los componentes del modal
        $('#Qinicio').val('');
        $('#Qfin').val('');
        $('#modal_ord').modal('toggle');
    }

    function Numerico(e) {
        var key = e.keyCode || e.which;
        var tecla = String.fromCharCode(key).toLowerCase();
        var letras = "/0123456789";
        if (letras.indexOf(tecla) == -1) {
            var especiales = [8, 9, 233, 237, 243, 250, 32, 46];
            //32 espacio, ß 225, Á 193, Í 205, Ó 211, 201,218,241,209
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