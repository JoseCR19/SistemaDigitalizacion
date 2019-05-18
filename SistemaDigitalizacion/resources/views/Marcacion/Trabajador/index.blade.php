@extends('layouts.admin')
@section('contenido')
<section class="content-header">
    <h1>
        Panel de Administrador
        <small>Version 1.0.0</small>
    </h1>
    <ol class="breadcrumb">
        <li href="#">
            <i class="fas fa-dolly"></i> Marcación</li>
        <li class="active">Lista de Trabajadores</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border" style="padding: 10px !important">
                    <h4 style="float:left">
                        <strong style="font-weight: 400">
                            <i class="fas fa-list-ul"></i> Lista de Trabajadores
                        </strong>
                    </h4>
                    <div class="ibox-title-buttons pull-right">
                        <a  data-target="#modal-create-personal"  data-toggle="modal" href="" style="text-decoration: none !important">
                            <button class="btn btn-block btn-success" style="background-color: #18A689 !important;">
                                <i class="fas fa-plus-circle"></i> Nuevo Trabajador
                            </button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;font-size: 11px !important">
                        <thead> 
                            <tr>
                                <th>
                                    CODIGO
                                </th>
                                <th>
                                    APELLIDO PATERNO
                                </th>
                                <th>
                                    APELLIDO MATERNO
                                </th>
                                <th>
                                    NOMBRE
                                </th>
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trabajador as $t)
                                <tr>
                                    <td>
                                        {{$t->DNI}}
                                    </td>
                                    <td>
                                        {{$t->APELLIDO_PATERNO}}
                                    </td>
                                    <td>
                                        {{$t->APELLIDO_MATERNO}}
                                    </td>
                                    <td>
                                        {{$t->NOMBRES}}
                                    </td>
                                    <td style="align-content: center">
                                        <a href="{{route('trabajador-edit',$t->DNI)}}" class="btn btn-success btn-xs" role="button">
                                            <i class="fas fa-edit" title="Editar Proforma"></i>Editar 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('Marcacion.Trabajador.modal_create_personal')
                    {{$trabajador->render()}}
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#btnbuscar').click(function()
        {
            var numdni=$('#dni').val();
            
            if (numdni!='') {
                $.ajax({
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{ route('consultar.reniec')}}",
                    data:{dni:numdni},
                    type:'get',
                    dataType:'json',
                    success:function(data){

                        var resultados=data.estado;
                        var dni = data.dni;
                        console.log(dni);
                        console.log(resultados);
                        if (resultados==true) {
                            $('#txtdni').val(data.dni);
                            $('#txtnombres').val(data.nombres);
                            $('#txtapellidos').val(data.apellidos);
                            $('#txtgrupo').val(data.grupovota);
                            $('#txtdistrito').val(data.distrito);
                            $('#txtprovincia').val(data.provincia);
                            $('#txtdepartamento').val(data.departamento);
                        }else{
                            $('#txtdni').val('');
                            $('#txtnombres').val('');
                            $('#txtapellidos').val('');
                            $('#txtgrupo').val('');
                            $('#txtdistrito').val('');
                            $('#txtprovincia').val('');
                            $('#txtdepartamento').val('');                            
                            $('#mensaje').show();
                            $('#mensaje').delay(2000).hide(2500);
                        }
                    }
                });
            }else{
                alert('Escriba el DNI.!');
                $('#dni').focus();
            }
            
        });

    });
    
</script>
@endpush
@endsection