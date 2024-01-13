<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoSeguro as Tipo;
use Illuminate\Support\Facades\DB;

class TipoSeguro extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo=Tipo::all();
        return view('seguro.consultar',['tipo'=>$tipo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seguro.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $t=new Tipo();
        $t->descricao=addslashes($request->descricao);
        $t->save();

        return view('seguro.index',['sms'=>'tipo seguro registado com sucesso']);
        
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
        $t=Tipo::findOrFail(addslashes($id));
        return view('seguro.editar',['tipo'=>$t]);
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
        $t=Tipo::findOrFail(addslashes($request->id));
        $t->update($s);
        $tipo=Tipo::all();
        
        return view('seguro.consultar',['sms'=>'Tipo seguro alterado com sucesso','tipo'=>$tipo]);
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
        $tipo=DB::table('tiposeguro')->where('descricao','LIKE','%'.$request->descricao.'%')
        ->get();

        if($tipo->count()>0)
        {
           return  view('seguro.consultar',['tipo'=>$tipo]);
        }

        return  view('seguro.consultar',['erro'=>'registo não encontrado']);
    }
}
