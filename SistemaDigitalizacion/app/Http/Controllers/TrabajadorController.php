<?php

namespace SistemaDigitalizacion\Http\Controllers;

use Illuminate\Http\Request;
use SistemaDigitalizacion\Trabajador;
use SistemaDigitalizacion\Horario_Detalle;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\reniec\reniec;
use App\reniec\curl;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Carbon\Carbon; 

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request->get('searchText'));
            $trabajador=DB::connection('sqlsrv3')->table('Trabajador')
            ->where('CODIGO_NEW','LIKE','%'.$query.'%')
            ->orderBy('APELLIDO_PATERNO')
            ->paginate(20);
            return view('Marcacion.Trabajador.index',["trabajador"=>$trabajador,"searchText"=>$query]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $Trabajador=DB::connection('sqlsrv3')->select('exec  sp_getDatosTrabajador ?',array($id));
        $Historial_H=DB::connection('sqlsrv3')->select('exec  sp_HistoricoHorario ?',array($id));
        $Horario=DB::connection('sqlsrv3')->select('sp_ListarHorario');
        //dd($trabajador);

        return view("Marcacion.Trabajador.edit",["Trabajador"=>$Trabajador,"Historial_H"=>$Historial_H,"Horario"=>$Horario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function ajaxStoreHorario(Request $request)
    {
        
        try{
            $dni;
            $horario;
            $tipo_horario;
            $empresa;
            $codigo;
            $fecha_inicio;
            $estado;
            $id=$request->get('id');
            foreach($request->datos as $dato)
            {
                $horario=$dato['HorarioDetalle'];
                $tipo_horario=$dato['TipoHorarioDetalle'];
                $empresa=$dato['Empresa'];
                $codigo=$dato['Codigo'];
                $fecha_inicio=$dato['today_date'];
                $estado=$dato['Estado'];
                $dni=$dato['Dni'];
            }
            $Trabajador=DB::connection('sqlsrv3')->select('exec  sp_insertarHorarioTrabajador ?,?,?,?,?,?,?',array($dni,$horario,$tipo_horario,$empresa,$codigo,$fecha_inicio,$estado));
            $Historial_H=DB::connection('sqlsrv3')->select('exec  sp_HistoricoHorario ?',array($id));
            
            if($Historial_H){            
                $estado=true;
            }else{
                $estado=false;
            }
            return response()->json(["Historial_H"=>$Historial_H,'veri'=>$estado]);
        }
        catch(Exception $e)
        {
            return ['data'=>$e,'veri'=>$estado];
        }
    }
    public function ajaxRequestPostHorario(Request $request)
    {
        $id=$request->get('dato');
        $lista=DB::connection('sqlsrv3')->select('exec  sp_HoraioDiario ?',array($id));
        return['lista'=>$lista,'veri'=>true];
    }

    public function buscarDni(Request $request)
    { 
        if ($request->ajax()) {
            
            $dni=$request->get('dni');
            $persona = new reniec();
            $yo = $persona->search($dni);
            if (is_null($yo)) {
                $data=array('estado' => false);
                echo json_encode($data);
            }else{
                if( $yo->success==true )
                {
                    $data=array(
                        'dni' => $yo->result->DNI,
                        'codveri' => $yo->result->CodVerificacion,
                        'nombres' => $yo->result->Nombres,
                        'apellidos' => $yo->result->Apellidos,
                        'grupovota' => $yo->result->gvotacion,
                        'distrito' => $yo->result->Distrito,
                        'provincia' => $yo->result->Provincia,
                        'departamento' => $yo->result->Departamento,
                        'estado' => $yo->success
                    );
                    echo json_encode($data);
                }else{
                    $data=array('estado' => $yo->success);
                    echo json_encode($data);
                }             
            }
            
        }
        else{
            return['veri'=>false];
        }
    }


}
