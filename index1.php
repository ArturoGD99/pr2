<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dise&ntilde;o Pammy</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="dist/img/icon.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">-->
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">-->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!--Sweetalert-->
   <!--<link rel="stylesheet" href="dist/css/sweetalert.min.css">-->
    <link rel="stylesheet" href="dist/css/sweetalert.css">
    <!--DATATABLE-->
<link rel="stylesheet" href="dist/css/dataTables.bootstrap4.min.css">
<!--<link rel="stylesheet" href="css/jquery.dataTables.min.css">-->
<link rel="stylesheet" href="dist/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="dist/css/responsive.bootstrap4.min.css">
<!--<link rel="stylesheet" href="dist/css/bootstrap.min.css">-->
  <style>
      input{text-transform: uppercase;}
      textarea{text-transform: uppercase;}
      /*.transition {
          -webkit-transform: scale(1.8);
          -moz-transform: scale(1.8);
          -o-transform: scale(1.8);
          transform: scale(1.8);
      }*/
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #F8F9FC">
<div id="dv_menu" style="display: none" class="wrapper">
  <nav id="header" class="main-header navbar navbar-expand navbar-white navbar-light"><!--style="display: block"-->
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      <!--<li class="nav-item"><a class="nav-link" href="#"><b>Menu</b></a></li>-->
    </ul>
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button" onclick="Salir();">
                  <i class="fas fa-sign-out-alt"></i>
              </a>
          </li>
      </ul>
  </nav>
  <aside id="menu" style="display: block" class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">-->
      <span class="brand-text font-weight-light">Leticia Pammy</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="display: inline-block">
        <div class="image"><img src="dist/img/teacher.png" class="img-circle elevation-2" alt="User Image"></div>
        <div class="info"><a id="info_user" href="#" class="d-block" style="font-size: 15px"></a></div>
      </div>
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!--<li id="sub_ficha" class="nav-item has-treeview">
                <a href="#" onclick="activar_opcion('ficha');" id="ficha" class="nav-link"><i class="nav-icon fas fa-pencil-ruler"></i><p>Ficha<i class="right fas fa-angle-left"></i></p></a>
                <ul id="ul_ficha" class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" onclick="Ajax_Dinamico('ficha.php','centro','');" class="nav-link">active
                            <i class="nav-icon fas fa-tshirt"></i> <p>Modelo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" onclick="Ajax_Dinamico('costura.php','centro','');" class="nav-link">
                            <i class="nav-icon fas fa-cut"></i> <p>Costura</p>
                        </a>
                    </li>
                </ul>
            </li>-->
            <li class="nav-item has-treeview">
                <a href="#" id="ficha" class="nav-link" onclick="activar_opcion('ficha'); Ajax_Dinamico('ficha.php','centro','');"><i class="nav-icon fas fa-pencil-ruler"></i><p>Ficha<i class="right fas fa-angle-left"></i></p></a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" id="auditoria" class="nav-link" onclick="activar_opcion('auditoria'); Submenu('sub_ficha'); Ajax_Dinamico('auditoria.php','centro','');"><i class="nav-icon fas fa-tasks"></i><p>Auditor&iacute;a<i class="right fas fa-angle-left"></i></p></a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" id="recibir" class="nav-link" onclick="activar_opcion('recibir'); Submenu('sub_ficha'); Ajax_Dinamico('recepcion.php','centro','');""><i class=" nav-icon fas fa-tshirt"></i><p>Recepci&oacute;n<i class="right fas fa-angle-left"></i></p></a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" id="asignar" class="nav-link" onclick="activar_opcion('asignar'); Submenu('sub_ficha'); Ajax_Dinamico('asignar.php','centro','');""><i class="nav-icon fas fa-user-check"></i><p>Asignar<i class="right fas fa-angle-left"></i></p></a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" id="consultas" class="nav-link" onclick="activar_opcion('consultas'); Submenu('sub_ficha'); Ajax_Dinamico('consultas.php','centro','');""><i class="nav-icon fas fa-search"></i><p>Consultas<i class="right fas fa-angle-left"></i></p></a>
            </li>
           </ul>
      </nav>
    </div>
  </aside>
    <div>
        <input type="hidden" id="id_user">
        <input type="hidden" id="id_perfil">
        <div class="content-wrapper" id="centro"></div>
    </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<div id="dv_login"><br><?php include_once('login.php'); ?></div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  //$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline
<script src="plugins/sparklines/sparkline.js"></script>-->
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>-->
<!-- Summernote
<script src="plugins/summernote/summernote-bs4.min.js"></script>-->
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!--Input files-->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!--Sweetalert-->
<!--<script src="dist/js/sweetalert.min.js"></script><!--Sweetalert-->
<script src="dist/js/sweetalert.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
</body>
</html>
<script>

    $(document).ready(function(){
        $('.zoom').hover(function() {
            $(this).addClass('transition');
        }, function() {
            $(this).removeClass('transition');
        });
    });

    function Ajax_Dinamico(url, div, param){
        $.ajax({
            url: url,
            cache:false,
            type: 'POST',
            data: param,
            success: function(data){$('#'+div).html(data); $(".select2").select2(); /*chosen();*/},
        });
    }
    function activar_opcion(op){
        $('#ficha').attr("class","nav-link");
        $('#auditoria').attr("class","nav-link");
        $('#consultas').attr("class","nav-link");
        $('#recibir').attr("class","nav-link");
        $('#asignar').attr("class","nav-link");
        $('#'+op).attr("class","nav-link active");
    }
    function Submenu(op){
        $('#sub_ficha').attr("class","nav-item has-treeview");
        $('#ul_ficha').fadeOut(150);
        //$('#'+op).attr("class","nav-link active");
    }
    function Salir(){
        var path = location.pathname.split('/');
        if (path[path.length-1].indexOf('.html')>-1)
            path.length = path.length - 1;

        var app = path[path.length-2];
        document.location.href='/'+app;
    }
    function chosen(){
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'No se encontraron resultados!'},
            '.chosen-select-width'     : {width:'242px',height:'26px'}/*,
             '.chosen-container'        : {font-size:'10px'}*/
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    }
    function Numerico(e){
        var key = e.keyCode || e.which;
        var tecla = String.fromCharCode(key).toLowerCase();
        var letras = "0123456789";
        if(letras.indexOf(tecla)==-1){
            var especiales = [8,9,42,120,233,237,243,250,32,46];
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
</script>