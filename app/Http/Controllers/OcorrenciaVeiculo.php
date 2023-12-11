<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OcorrenciaVeiculoModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\VeiculoController ;
use Illuminate\Support\Facades\Auth;

class OcorrenciaVeiculo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ocorrencias($id_veiculo){
        $ocrrencias=DB::table('ocorreciaveiculos')
        ->join('veiculos','veiculos.id','=','ocorreciaveiculos.veiculo_id')
       // ->join('users','users.id','=','ocorreciaveiculos.user_id')
        ->where('ocorreciaveiculos.veiculo_id','=',$id_veiculo)
       
       // ->where('trabalhos.tipo','!=','Auto-Arquivamento')
        ->select('veiculos.*','ocorreciaveiculos.*')
        ->get();
        //dd($ocrrencias);
        return  $ocrrencias;
    }


    public function index($d)
    {
        $o=$this->ocorrencias($d);
        return view('veiculo.historicoOcorrencia',['ocorrencias'=>$o]);
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

        $vc=new VeiculoController();
        $o=new OcorrenciaVeiculoModel();
        $o->veiculo_id=$request->veiculo_id;
        $o->descricao_problema=$request->descricao;
        $o->data_ocorrencia=date('Y-m-d');
        $o->estado='Pendente';
        $p=$vc->veiculos();

       
        $o->save();

        return view('veiculo.sucesso_registo_ocorrencia',['sms'=>'Ocorrencia registada com sucesso','ve'=>$p]);

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
        
        $oc=OcorrenciaVeiculoModel::findOrFail(addslashes($id));
        $o=$this->ocorrencias($oc->veiculo_id);
       return view('veiculo.ocorrenciaeditar',['oc'=>$oc,'ocorrencias'=>$o]);
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
        $o=OcorrenciaVeiculoModel::findOrFail(addslashes($request->ocorrencia_id));
        $o->update($s);
        $oc=$this->ocorrencias($o->veiculo_id);
        return view('veiculo.historicoOcorrencia',['ocorrencias'=>$oc,'sms'=>'Ocorrencia alterada com sucesso']);


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

    /** histórico ocorrencia */

    public function listarOcorrencias()
    {
       
        $ocorrencias=OcorrenciaVeiculoModel::all();
        return view('tecnica-veiculo.index',['ocorrencias'=>$ocorrencias]);




    }


    public function diagnosticar($id)
    {
        $s=['estado'=> 'Diagnosticando'];
        $o=OcorrenciaVeiculoModel::findOrFail(addslashes($id));
        $o->update($s);

        $ocorrencias=OcorrenciaVeiculoModel::all();
        return view('tecnica-veiculo.index',['ocorrencias'=>$ocorrencias,'sms'=>'Estado alterado com sucesso']);
    }

    public function resolver($id)
    {
        $s=['estado'=> 'Resolvendo'];
        $o=OcorrenciaVeiculoModel::findOrFail(addslashes($id));
        $o->update($s);
        $ocorrencias=OcorrenciaVeiculoModel::all();
        return view('tecnica-veiculo.index',['ocorrencias'=>$ocorrencias,'sms'=>'Estado alterado com sucesso']);

    }


    public function concluir(Request $request)
    {
        $user_id=Auth::user()->id;
        $s=['estado'=> 'Concluído', 'descricao_solucao'=>addslashes($request->descricao),'data_resolucao'=>date('y-m-d'),'user_id'=>$user_id];
        $o=OcorrenciaVeiculoModel::findOrFail(addslashes($request->ocorrencia_id));
        $o->update($s);
        $ocorrencias=OcorrenciaVeiculoModel::all();
        return view('tecnica-veiculo.index',['ocorrencias'=>$ocorrencias,'sms'=>'Estado alterado com sucesso']);

    }

    public function informacao($id)
    {

        $ocorrencias=DB::table('ocorreciaveiculos')
     //   ->join('veiculos','veiculos.id','=','ocorreciaveiculos.veiculo_id')
        ->join('users','users.id','=','ocorreciaveiculos.user_id')
        ->where('ocorreciaveiculos.id','=',addslashes($id))
       // ->where('trabalhos.tipo','!=','Auto-Arquivamento')
        ->select('users.name as tecnico','ocorreciaveiculos.*')
        ->get();

    // dd($ocorrencias);

        if($ocorrencias->count()>0)
        {
           
           // $ocorrencias=OcorrenciaVeiculoModel::findOrFail(addslashes($id));
            return view('tecnica-veiculo.informacao',['o'=>$ocorrencias->first()]);

        }
       
   

    }
}
