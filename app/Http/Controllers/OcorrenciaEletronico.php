<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialElectronico ;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MaterialElectronicoController;
use App\Models\OcorrenciaEletronico as OcorrenciaModel;
use Illuminate\Support\Facades\Auth;

class OcorrenciaEletronico extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function ocorrencias($id_material){
        $ocrrencias=DB::table('ocorrencia_eletronico')
        ->join('materiaeletronico','materiaeletronico.id','=','ocorrencia_eletronico.material_id')
       // ->join('users','users.id','=','ocorreciaveiculos.user_id')
        ->where('ocorrencia_eletronico.material_id','=',$id_material)
       
       // ->where('trabalhos.tipo','!=','Auto-Arquivamento')
        ->select('materiaeletronico.*','ocorrencia_eletronico.*')
        ->get();
        //dd($ocrrencias);
        return  $ocrrencias;
    }

    public function index($id)
    {
        $o=$this->ocorrencias($id);
        return view('material_eletronico.historicoOcorrencia',['ocorrencias'=>$o]);
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
        $me=new  MaterialElectronicoController();

        $o=new OcorrenciaModel();
        $o->material_id=addslashes($request->material_id);
        $o->descricao_problema=addslashes($request->descricao);
        $o->data_ocorrencia=date('Y-m-d');
        $o->estado='Pendente';
        $o->save();

        return view('material_eletronico.sucesso_registo_ocorrencia',['sms'=>'Ocorrencia registada com sucesso','mat'=>$me->material_eletronicos()]);
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
        $oc=OcorrenciaModel::findOrFail(addslashes($id));
        $o=$this->ocorrencias($oc->material_id);
       return view('material_eletronico.ocorrenciaeditar',['oc'=>$oc,'ocorrencias'=>$o]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $s=['descricao_problema'=> addslashes($request->descricao)];
        $o=OcorrenciaModel::findOrFail(addslashes($request->ocorrencia_id));
        $o->update($s);
        $oc=$this->ocorrencias($o->material_id);
        return view('material_eletronico.historicoOcorrencia',['ocorrencias'=>$oc,'sms'=>'Ocorrencia alterada com sucesso']);
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

    public function listarOcorrencias()
    {
       
        $ocorrencias=OcorrenciaModel::all();
        return view('tecnica-movel.index',['ocorrencias'=>$ocorrencias]);

    }


    public function diagnosticar($id)
    {
        $s=['estado'=> 'Diagnosticando'];
        $o=OcorrenciaModel::findOrFail(addslashes($id));
        $o->update($s);

        $ocorrencias=OcorrenciaModel::all();
        return view('tecnica-movel.index',['ocorrencias'=>$ocorrencias,'sms'=>'Estado alterado com sucesso']);
    }


    public function resolver($id)
    {
        $s=['estado'=> 'Resolvendo'];
        $o=OcorrenciaModel::findOrFail(addslashes($id));
        $o->update($s);
        $ocorrencias=OcorrenciaModel::all();
        return view('tecnica-movel.index',['ocorrencias'=>$ocorrencias,'sms'=>'Estado alterado com sucesso']);

    }

    public function concluir(Request $request)
    {
        $user_id=Auth::user()->id;
        $s=['estado'=> 'Concluído', 'descricao_solucao'=>addslashes($request->descricao),'data_resolucao'=>date('y-m-d'),'user_id'=>$user_id];
        $o=OcorrenciaModel::findOrFail(addslashes($request->ocorrencia_id));
        $o->update($s);
        $ocorrencias=OcorrenciaModel::all();
        return view('tecnica-movel.index',['ocorrencias'=>$ocorrencias,'sms'=>'Estado alterado com sucesso']);

    }


    public function informacao($id)
    {
        $ocorrencias=DB::table('ocorrencia_eletronico')
        ->join('materiaeletronico','materiaeletronico.id','=','ocorrencia_eletronico.material_id')
        ->join('users','users.id','=','ocorrencia_eletronico.user_id')
        ->where('ocorrencia_eletronico.id','=',addslashes($id))
       // ->where('trabalhos.tipo','!=','Auto-Arquivamento')
        ->select('users.name as tecnico','ocorrencia_eletronico.*')
        ->get();

   // dd($ocorrencias);

        if($ocorrencias->count()>0)
        {
           
           // $ocorrencias=OcorrenciaVeiculoModel::findOrFail(addslashes($id));
            return view('tecnica-movel.informacao',['o'=>$ocorrencias->first()]);

        }
       
   

    }

}
