<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAquisicaoModel;
use Illuminate\Support\Facades\DB;

class TipoAquisicao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo=TipoAquisicaoModel::all();
        return view('tipoAquisicao.consultar',['tipo'=>$tipo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoAquisicao.index');
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
        $t=new TipoAquisicaoModel();
        $t->descricao=$request->descricao;
        $t->save();
        return view('tipoAquisicao.index',['sms'=>'Tipo de aquisição registada com sucesso']);

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
        $t=TipoAquisicaoModel::findOrFail(addslashes($id));
        return view('tipoAquisicao.editar',['t'=>$t]);
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
        $s=['descricao'=> addslashes($request->descricao)];
        $t=TipoAquisicaoModel::findOrFail(addslashes($request->id));
        $t->update($s);
        $tipo=TipoAquisicaoModel::all();
        
        return view('tipoAquisicao.consultar',['sms'=>'Tipo de aquisição alterado com sucesso','tipo'=>$tipo]);
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
    public function pesquisar(Request $request)
    {
       
        $tipo=DB::table('tipoaquisicao')->where('descricao','LIKE','%'.$request->descricao.'%')
         ->get();

         if($tipo->count()>0)
         {
            return  view('tipoAquisicao.consultar',['tipo'=>$tipo]);
         }

         return  view('tipoAquisicao.consultar',['erro'=>'registo não encontrado']);
    }
}
