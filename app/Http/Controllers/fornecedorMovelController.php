<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FornecedorMovel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class fornecedorMovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $fornecedores=FornecedorMovel::all();
        return view('fornecedor.consultar',['for'=>$fornecedores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fornecedor.index');
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
        $f=new FornecedorMovel ();
        $f->nome=$request->nome;
        $f->nif=$request->nif;
        $f->endereco=$request->endereco;
        $f->email=$request->email;
        $f->telefone=$request->telefone;
        $f->save();
        return view('fornecedor.index',['sms'=>'Fornecedor registado com sucesso']);
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
        $f=FornecedorMovel::findOrFail(addslashes($id));
        return view('fornecedor.editar',['f'=>$f]);
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
        if(Auth::check())
       {

        $s=[
            'nome'=> addslashes($request->nome),
            'email'=>addslashes($request->email),
            'nif'=>addslashes($request->nif),
            'telefone'=>addslashes($request->telefone),
            'endereco'=>addslashes($request->endereco),
        ];
        $f=FornecedorMovel::findOrFail(addslashes($request->id));
        $f->update($s);
        $fornecedores=FornecedorMovel::all();
        return view('fornecedor.consultar',['sms'=>'fornecedor alterado com sucesso','for'=>$fornecedores]);
       }
       abort(403);
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
        $for=DB::table('fornecedor')->where('nome','LIKE','%'.$request->nome.'%')
         ->get();

         return  view('fornecedor.consultar',['for'=>$for]);

    }
}
