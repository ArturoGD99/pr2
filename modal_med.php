<div class="modal fade in" id="modal_med" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2"><b>Medida</b></div>
                    <div class="col-md-6"><input type="text" class="form-control" id="tnueva" name="ncolorn" tabindex="3" maxlength="40"></div>
                    <div class="col-md-4"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#tnueva').val('');" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_nueva" class="btn btn-primary" onclick="Registrar_Nueva();">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function Registrar_Nueva() {
        $('#btn_nueva').blur();

        var param = 'medida='+$.trim($('#tnueva').val().toUpperCase())+'&accion=Nueva_Medida';

        $.ajax({
            url: 'Transacciones.php',
            cache:false,
            type: 'POST',
            data: param,
            success: function(data){
                if(data == 1){
                    swal({title: "Medida agregada.!!", icon: "success", timer: 1300, showConfirmButton: false});
                    Buscar_Corrida($('#id_ficha').val());
                    $('#modal_med').modal('hide');
                    $('#tnueva').val('');
                }else{
                    swal({title: "Error.!!", icon: "success", timer: 1300, showConfirmButton: false});
                }
            },
            error: function (request, status, error) {alert(request.responseText);}
        });
    }
</script>