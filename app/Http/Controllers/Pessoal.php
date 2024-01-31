<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Pessoal as Pes;
use Illuminate\Support\Facades\DB;

class Pessoal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pessoais()
    {
        $p=DB::table('pessoal')
        ->join('departamentos','departamentos.id','=','pessoal.departamento_id')
        ->select('pessoal.*','departamentos.descricao as departamento')
        ->get();
        return $p;
    }

    public function pessoal($id)
    {
        $p=DB::table('pessoal')
        ->join('departamentos','departamentos.id','=','pessoal.departamento_id')
        ->where('pessoal.id','=',addslashes($id))
        ->select('pessoal.*','departamentos.descricao as departamento','pessoal.funcao as funcao')
        ->get();
        return $p;
    }
    public function index()
    {
        return view('pessoal.consultar',['pessoal'=>$this->pessoais()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dep=Departamento::all();
   
       return view('pessoal.index',['dep'=>$dep]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p=new Pes();
        $p->nome=addslashes($request->nome);
        $p->datanasc=addslashes($request->datanasc);
        $p->email=addslashes($request->email);
        $p->telefone=addslashes($request->telefone);
        $p->funcao=addslashes($request->funcao);
        $p->departamento_id=addslashes($request->departamento);
        $p->save();
        return view('pessoal.index',['sms'=>'pessoal registado com sucesso']);

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
       //dd($this->pessoal($id)->first());
        $dep=Departamento::all();
        return view('pessoal.alterar',['p'=>$this->pessoal($id)->first(),'dep'=>$dep]);
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
        $s=['nome'=> addslashes($request->nome), 
        'datanasc'=>addslashes($request->datanasc),
        'email'=>addslashes($request->email),
        'telefone'=>addslashes($request->telefone),
        'departamento_id'=>addslashes($request->departamento)];
        $p=Pes::findOrFail(addslashes($request->id));
        $p->update($s);

        return view('pessoal.consultar',['pessoal'=>$this->pessoais(),'sms'=>'registo alterado com sucesso']);

        
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
}
