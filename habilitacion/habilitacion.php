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
    .myFont{
        font-size:11px;
    }
</style>
<br>
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-pencil-ruler"></i>  Habilitacion</h3>&nbsp;&nbsp;&nbsp;<!--fas fa-tshirt-->
                <h3 class="card-title">&nbsp;&nbsp;&nbsp;
                    <a id="add_med" href="#" onclick="Agregar_Medida();" style="color: black; display: none">
                        <i class="fas fa-plus-square"></i>&nbsp;Agregar
                    </a>
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item"><a class="nav-link active" href="#pedidos" onclick="Validar_Tab(0)" data-toggle="tab">Pedidos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#etiquetas" onclick="Validar_Tab(0)" data-toggle="tab">Etiquetas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#habil" onclick="Validar_Tab(0)" data-toggle="tab">Habilitaci&oacute;n</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body"><input type="hidden" id="id_ficha"><input type="hidden" id="cor" value = "">
                <div class="tab-content p-0" style="border: solid 0px blue">
                    <div class="chart tab-pane active" id="pedidos" style="position: relative; border: solid 0px purple;">
                        <form id="fmodelo">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select class='form-control select2' id="cmbcliente" name="ncmbcliente" onchange="Buscar_Pedidos();" tabindex="1"><!--onchange="Buscar_Marcas();" -->
                                            <option value="0"></option>
                                            <optgroup>
                                                <?php
                                                $rs = $query->Consultar_Proscai("*","FCLI","","CLICOD");
                                                while(!$rs->EOF){
                                                    echo "<option value='".$rs->fields['CLICOD']."'>".$rs->fields['CLICOD']." - ".$rs->fields['CLINOM']."</option>";
                                                    $rs->MoveNext();
                                                }
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr><br>
                            <!--<div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-1"><button type="button" class="btn btn-primary" id="btn_model" onclick="Registrar_Modelo();">Guardar</button></div>
                                <div id="dv_duplicar" class="col-md-1"><button type="button" style="display: none;" class="btn btn-success" id="btn_duplicar" onclick="Duplicar();">Duplicar</button></div>
                                <div class="col-md-5"></div>
                            </div>-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="dv_pedidos" class="table-responsive"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="chart tab-pane" id="etiquetas" style="position: relative;">
                        <br>
                        <div id="dv_resultado" class="table-responsive">
                            <!--<table  id="mytable" class="table table-bordered table-hover" style="display: block; font-size: 12px">
                                <thead>
                                <tr align="center"><th>TIPO</th><th>VARIANTE 1</th><th>VARIANTE 2</th><th>VARIANTE 3</th><th>VARIANTE 4</th><th>VARIANTE 5</th><th>VARIANTE 6</th><th>VARIANTE 7</th><th>VARIANTE 8</th><th>VARIANTE 9</th><th></th><th></th></tr>
                                <tr align="center"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><button type='button' id='btn_modal_var' onclick="Modal_Variante()" class='btn btn-primary btn-xs'>Agregar</button></td><td></td></tr>
                                </thead>
                            </table>-->
                        </div>
                    </div>
                    <div class="chart tab-pane" id="habil" style="position: relative;">
                        <!--<input type="hidden" id="tvar">
                        <input type="hidden" id="tcor">
                        <input type="hidden" id="trango">
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
                        </div>-->
                    </div>
                </div>
            </div><br>
            <div class="card-footer" align="center"></div>
            <div class="container"><!--Modal para mostrar la ficha de diseno-->
                <div class="modal fade in" id="modal_pdf">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Factura</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" >
                                <div id="dv_pdf" style="height:100vh; display: none"></div>
                            </div>
                        </div>
                    </div>
                </div>
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
    $(document).ready(function() {
        $('#tbuscar').keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                Buscar_Pedido();
            }
        });
    });

    function Validar_Tab(nm) {
        if($('#tbuscar').val()!=''){
            if(nm == 1){
                if($('#id_perfil').val() == '1' || $('#id_perfil').val() == '2'){
				    $('#add_med').show();
				}else{
				    $('#add_med').hide();
				}
            }else{
                $('#add_med').hide();
            }
        }
    }

    function Buscar_Pedidos(){
        var param = 'clicod='+$('#cmbcliente').val();
            param+= '&tp=pedidos';

        $.ajax({
            url: 'habilitacion/consultas.php',
            cache:false,
            type: 'POST',
            data: param,
            success: function(data){
                $('#dv_pedidos').html(data);
                $(document).ready(function() {
                    $('#tbl_pedidos').DataTable( {
                        pagingType: 'full',
                    } );
                } );
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }

    function Abrir_Modal(nm) {
        $('#id_'+nm).blur();

        var param = 'id='+nm;
        var first = $('#id_'+nm).html();
        var replace = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";
        $('#id_'+nm).html(replace);
        //alert(param);
        $.ajax({
            url: 'pdf/pdf.php',
            type: "POST",
            data:param,
            success: function(pdf){
                //$('.overlay').remove();
                $(".modal-title").html("Ficha de Confección: <b>"+$('#torden').val()+"</b>");
                $("#modal_pdf").modal({backdrop: 'static', keyboard: false, show: true});
                $('#dv_pdf').show();
                $('#dv_pdf').html('<iframe width="100%" height="98%" type="application/pdf" src="data:application/pdf;base64,' + pdf + '"></iframe>');
                $('#id_'+nm).html(first);
            },error:function(request,error){
                swal("Ha ocurrido un error");
                //$('.overlay').remove();
            }
        });
    }

    function Numerico(e){
        var key = e.keyCode || e.which;
        var tecla = String.fromCharCode(key).toLowerCase();
        var letras = "/0123456789";
        if(letras.indexOf(tecla)==-1){
            var especiales = [8,9,233,237,243,250,32,46];
            //32 espacio, ß 225, Á 193, Í 205, Ó 211, 201,218,241,209
            var tecla_especial = false;
            for(var i in especiales) {
                if(key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            return tecla_especial;
        }
    }

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#cmbtela1').select2({ dropdownCssClass: "myFont" });
        $('#cmbtela2').select2({ dropdownCssClass: "myFont" });
        $('#cmbtela3').select2({ dropdownCssClass: "myFont" });
        $('#cmbtela4').select2({ dropdownCssClass: "myFont" });
        $('#cmbtela5').select2({ dropdownCssClass: "myFont" });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>