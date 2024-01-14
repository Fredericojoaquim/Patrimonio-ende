<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Predefinicoes as Difinicoes;
use Illuminate\Support\Facades\DB;

class Predifinicoes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d=Difinicoes::findOrFail(2);
       return view('predefinicoes.consultar',['def'=>$d]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('predefinicoes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d=new Difinicoes();
        $d->nomesistema=addslashes($request->nome);
        $d->barra_inferior=addslashes($request->barra);

        if($request->file('logo')->isValid()){

            if($request->hasFile('logo')!=null){

                $requestarquivo = $request->logo;
                $extensao = $requestarquivo->extension();
                $nomearquivo = md5($requestarquivo->getClientOriginalName().strtotime("now")).".".$extensao;
                $request->logo->move(public_path('img'),$nomearquivo);
                $d->img=$nomearquivo;

                $d->save();
                return view('predefinicoes.index',['sms'=>'dados registado com suceso']);

            }
            return view('predefinicoes.index',['erro'=>'erro ao cadastrar ,por favor verifique os dados inseridos']);
        }
        return view('predefinicoes.index',['erro'=>'erro ao cadastrar ,por favor verifique os dados inseridos']);
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
        //
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
}
