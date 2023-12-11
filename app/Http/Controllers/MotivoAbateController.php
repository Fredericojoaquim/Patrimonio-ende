<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoAbate;
use Illuminate\Support\Facades\DB;

class MotivoAbateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $m=MotivoAbate::all();
        return view('motivo-abate.consultar',['motivo'=>$m]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('motivo-abate.registar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $m=new MotivoAbate();
        $m->descricao=addslashes($request->descricao);
        $m->save();
        return view('motivo-abate.registar',['sms'=>'motivo registado com sucesso']);

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
        $m=MotivoAbate::findOrFail(addslashes($id));
        return view('motivo-abate.editar',['m'=>$m]);
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
        $m=MotivoAbate::findOrFail(addslashes($request->id));
        $m->update($s);
        $motivo=MotivoAbate::all();
        return view('motivo-abate.consultar',['motivo'=>$motivo,'sms'=>'Registo alterado com sucesso']);
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
        $m=DB::table('motivos_abate')->where('descricao','LIKE','%'.addslashes($request->descricao).'%')
         ->get();
         return  view('motivo-abate.consultar',['motivo'=>$m]);

    }
}
