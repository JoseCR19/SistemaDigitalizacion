<div class="modal fade in" aria-labelledby="myModalLabel" role="dialog" tabindex="-2" id="modal-create-personal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header mh-c" style="border:1px solid #18A689 !important;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <img src="{{asset('iconos-svg/profile.svg')}}" alt="" width="60px">
      </div>
      <div class="modal-body">
        <div class="box box-success">
          <div class="row" style="margin-top:5px;margin-right:2.5px;margin-left:2.5px;">
            <div class="col-md-6">
              MIMCO S.A.C
            </div>
          </div>
          <div class="box-header with-border" style="padding: 10px !important">
            <center>
                <h4 class="box-title" style="font-size: 14px !important;text-align: center;color: #676a6c !important;">
                    REGISTRAR PERSONAL 
                </h4>
            </center> 
          <div class="box-body">
          <form class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">NUMERO DNI:</label>

                            <div class="col-md-5">
                                <input id="dni" type="text" class="form-control" name="dni" value="" placeholder="Escribe DNI" required autofocus maxlength="8">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success" id="btnbuscar">
                                <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-5">
                                <small id="mensaje" style="color: red;display: none;font-size: 12pt;" > 
                                    <i class="fa fa-remove"></i> El numero de DNI no es valido. 
                                </small>
                            </div>                            
                        </div>


                        <hr>
<div class="row">
    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">DNI:</label>
            <div class="col-md-4">
                <input id="txtdni" type="text" class="form-control"  placeholder="DNI" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Nombres:</label>
            <div class="col-md-8">
                <input id="txtnombres" name="boo" type="text" class="form-control"  placeholder="Nombres" value="" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Apellidos:</label>
            <div class="col-md-8">
                <input id="txtapellidos" type="text" class="form-control"  placeholder="Apellidos" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Grupo de votación:</label>
            <div class="col-md-4">
                <input id="txtgrupo" type="text" class="form-control"  placeholder="Grupo de votacion" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Distrito:</label>
            <div class="col-md-8">
                <input id="txtdistrito" type="text" class="form-control"  placeholder="Distrito" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Provincia:</label>
            <div class="col-md-8">
                <input id="txtprovincia" type="text" class="form-control"  placeholder="Provincia" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-md-3 control-label">Departamento:</label>
            <div class="col-md-8">
                <input id="txtdepartamento" type="text" class="form-control"  placeholder="Departamento" readonly="">
            </div>
        </div>
    </div>
</div>

                    </form>
        </div>
  </div>
  <div class="modal-footer">
       <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </div> 
</div>
</div>









