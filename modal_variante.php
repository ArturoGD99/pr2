<?php
include_once('registro.php');
$query = new Registro();
?>
<div class="modal fade in" id="modal_variante" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="tipo_var"><!--tipo combinacion-->
        <input type="hidden" id="id_variante"><!--id variante -> editar variante-->
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tipo:</label>
                    <select style="width: 100%" class="form-control" id="cmbtipon" name="ncmbtipon" tabindex="1"><!--onchange="Mostrar_Ocultar();"-->
                        <option value="0"></option>
                        <optgroup>
                            <?php
                            $rs = $query->Consultar("*","FCAT_COMBINACION","ID_CAT_COMBINACION NOT IN (8,10,11,12,13)","ID_CAT_COMBINACION");// AND ISTKACT > 0
                            while(!$rs->EOF){
                                echo "<option value='".$rs->fields['ID_CAT_COMBINACION']."'>".$rs->fields['CORTA']."</option>";
                                $rs->MoveNext();
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Variante:</label>
                    <select style="width: 100%" class="form-control" id="cmbvarianten" name="ncmbvarianten" tabindex="2"><!--onchange="Mostrar_Ocultar();"-->
                        <option value="0"></option>
                        <optgroup>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Color:</label><input type="text" class="form-control" id="tcolorn" name="ncolorn" tabindex="3">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Tela:</label>
                    <select style="width: 100%" class="form-control select2" id="cmbtelan1" name="ncmbtelan1" onchange="Buscar_ProveedorN(1);Cargar_Desc($('#cmbtelan1 option:selected').text(),1);" tabindex="4">
                        <option value="0">Seleccione la opci&oacute;n</option>
                        <optgroup>
                            <?php
                            $rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%'","ICOD");// AND ISTKACT > 0
                            while(!$rs->EOF){
                                echo "<option value='".utf8_encode($rs->fields['ICOD'])."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                $rs->MoveNext();
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripcion:</label><input type="text" class="form-control" id="tdesct1">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Tela:</label>
                    <select style="width: 100%" class="form-control select2" id="cmbtelan2" name="ncmbtelan2" onchange="Buscar_ProveedorN(2);Cargar_Desc($('#cmbtelan2 option:selected').text(),2);" tabindex="5">
                        <option value="0">Seleccione la opci&oacute;n</option>
                        <optgroup>
                            <?php
                            $rs = $query->Consultar_Proscai("ICOD, IDESCR, ISTKACT","FINV","ICOD LIKE 'T%'","ICOD");// AND ISTKACT > 0
                            while(!$rs->EOF){
                                echo "<option value='".utf8_encode($rs->fields['ICOD'])."'>".utf8_encode($rs->fields['ICOD'])."_".utf8_encode($rs->fields['IDESCR'])."</option>";
                                $rs->MoveNext();
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripcion:</label><input type="text" class="form-control" id="tdesct2">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
          <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              Proveedor:
                              <div id="dv_prvn1"><select style="width: 100%" class="form-control">
                                      <option value="0"></option>
                                      <optgroup></optgroup>
                                  </select></div>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              Factura:
                              <div id="dv_facturan1"><select style="width: 100%"class="form-control" tabindex="9">
                                      <option value="0">      </option>
                                      <optgroup>
                                      </optgroup>
                                  </select></div>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              Proveedor:
                              <div id="dv_prvn3"><select style="width: 100%" class="form-control">
                                      <option value="0">      </option>
                                      <optgroup></optgroup>
                                  </select></div>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              Factura:
                              <div id="dv_facturan3"><select style="width: 100%"class="form-control" tabindex="9">
                                      <option value="0">      </option>
                                      <optgroup>
                                      </optgroup>
                                  </select></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-1"></div>
          </div>
          <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10">
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              Proveedor:
                              <div id="dv_prvn2"><select style="width: 100%" class="form-control">
                                      <option value="0"></option>
                                      <optgroup></optgroup>
                                  </select></div>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              Factura:
                              <div id="dv_facturan2"><select style="width: 100%"class="form-control" tabindex="9">
                                      <option value="0">      </option>
                                      <optgroup>
                                      </optgroup>
                                  </select></div>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              Proveedor:
                              <div id="dv_prvn4"><select style="width: 100%" class="form-control">
                                      <option value="0">      </option>
                                      <optgroup></optgroup>
                                  </select></div>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              Factura:
                              <div id="dv_facturan4"><select style="width: 100%"class="form-control" tabindex="9">
                                      <option value="0">      </option>
                                      <optgroup>
                                      </optgroup>
                                  </select></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-1"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="Limpiar_Modal();" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_CombinacionN();">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script>
    function Limpiar_Modal(){
        $('#tipo_var').val('');
        $('#id_variante').val('');
        $('#cmbtipon').val('0');
        $('#cmbvarianten').val('0');
        $('#tcolorn').val('');
        $('#cmbtelan1').select2('destroy');
        $('#cmbtelan1').val('0').select2();
        $('#cmbtelan2').select2('destroy');
        $('#cmbtelan2').val('0').select2();
        $('#tdesct1').val('');
        $('#tdesct2').val('');
        for(var i=1; i<=4; i++){
            $('#cmbproveedorn'+i).val('0');
            $('#cmbfacturan'+i).val('0');
        }
    }
    function Cargar_Desc(nm,a){
        var descr = nm.split('_');
        $('#tdesct'+a).val(descr[1]);
    }
</script>