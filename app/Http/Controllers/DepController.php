<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;

class DepController extends Controller
{
    //

    public function index()
    {
       
        $dep=Departamento::all();
        

        // dd($dep);
 
         return view('categoria.consultar',['dep'=>$dep]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamento.index');
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
        $dep=new Departamento();
        $dep->descricao=$request->descricao;
        $dep->sigla=$request->sigla;
        $dep->save();
        return view('departamento.index',['sms'=>'Departamento registada com sucesso']);
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
        $d=Departamento::findOrFail(addslashes($id));
        return view('departamento.editar',['d'=>$d]);
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
        $s=['descricao'=> addslashes($request->descricao), 'sigla'=>addslashes($request->sigla)];
        $d=Departamento::findOrFail(addslashes($request->id));
        $d->update($s);
        $dep=Departamento::all();
        
        return view('departamento.consultar',['sms'=>'departamento alterado com sucesso','dep'=>$dep]);


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


    public function all()
    {
      //  $categorias=CategoriaModel::all();
        $dep=Departamento::all();
        

       // dd($dep);

        return view('departamento.consultar',['dep'=>$dep]);

    }

    public function pesquisar(Request $request)
    {
        $dep=DB::table('departamentos')->where('descricao','LIKE','%'.$request->descricao.'%')
         ->get();

        

         if($dep->count()>0)
         {
            return  view('departamento.consultar',['dep'=>$dep]);
         }

         return  view('departamento.consultar',['erro'=>'registo não encontrado']);

    }
}
