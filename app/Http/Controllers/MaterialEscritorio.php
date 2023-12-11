<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\TipoAquisicaoModel;
use App\Models\MaterialEscritorioModel;
use App\Models\FornecedorMovel;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\HelperController;
use App\Models\MotivoAbate;


class MaterialEscritorio extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
     public function material_escritorios(){

        $p=DB::table('materialescritorio')
        ->join('departamentos','departamentos.id','=','materialescritorio.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->where('materialescritorio.estado','=','ativo')
      
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();

        return $p;

     }

     public function material_escritoriosConsultar(){

        $p=DB::table('materialescritorio')
        ->join('departamentos','departamentos.id','=','materialescritorio.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
       
       // ->where('trabalhos.tipo','!=','Auto-Arquivamento')
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->paginate(3);

        return $p;

     }


    public function index()
    {
        $material=$this->material_escritorios();
        return view('material_escritorio.consultar',['mat'=>$material]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores=FornecedorMovel::all();
       
        $dep=Departamento::all();
        $t=TipoAquisicaoModel::all();

        
        return view('material_escritorio.index',['dep'=>$dep, 'tipo'=>$t, 'for'=>$fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $m=new MaterialEscritorioModel();

        $valor_aquisicao=null;
        $Custo_aquisição_usd=null;
        $Custo_aquisição_euro=null;
        $h=new HelperController();



        

        if(!is_null($request->valor))
       {
        $valor_aquisicao=$h->moeda(addslashes($request->valor));

       }

       if(!is_null($request->Custo_aquisição_usd))
       {
        $Custo_aquisição_usd=$h->moeda(addslashes($request->Custo_aquisição_usd));

       }

       if(!is_null($request->Custo_aquisição_euro))
       {
        $Custo_aquisição_euro=$h->moeda(addslashes($request->Custo_aquisição_euro));

       }

        $m->num_mobilizado=$request->num_mobilizado;
        $m->descricao=$request->descricao;
        $m->marca=$request->marca;
        $m->valor_aquisicao=$valor_aquisicao;
        $m->finalidade=$request->finalidade;
        $m->tipo_aquisicao=$request->tipoaquisicao;
        $m->data_aquisicao=$request->dataaquisicao;
        $m->cor=$request->cor;
        $m->tipo=$request->tipomovel;
        $m->fornecedor_id=$request->fornecedor;
        $m->departamento_id=$request->departamento;
        $m->estado='ativo';
        $m->custo_aquisicao_usd=$Custo_aquisição_usd;
        $m->custo_aquisicao_euro= $Custo_aquisição_euro;
        
       
    
        $m->save();

        $fornecedores=FornecedorMovel::all();
       
        $dep=Departamento::all();
        $t=TipoAquisicaoModel::all();

        return view('material_escritorio.index',['sms'=>'Material registado com sucesso','dep'=>$dep, 'tipo'=>$t, 'for'=>$fornecedores]);

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
        $p=DB::table('materialescritorio')
        ->join('departamentos','departamentos.id','=','materialescritorio.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->where('materialescritorio.id','=',addslashes($id))
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();
        if($p->count()>0){
            $m=$p->first();
            $dep=Departamento::all();
            $t=TipoAquisicaoModel::all();
            $fornecedores=FornecedorMovel::all();
            return view('material_escritorio.editar', ["m" =>$m, 'dep'=>$dep, 'tipo'=>$t, 'for'=>$fornecedores]);
        }

        return view('material_escritorio.consultar', ["erro" =>'Registo não encontrado']);

       
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
        $valor_aquisicao=null;
        $Custo_aquisição_usd=null;
        $Custo_aquisição_euro=null;
        $h=new HelperController();


       // dd($request->valor);


        if(!is_null($request->valor))
       {
        $valor_aquisicao=$h->moeda(addslashes($request->valor));

       }

       if(!is_null($request->Custo_aquisição_usd))
       {
        $Custo_aquisição_usd=$h->moeda(addslashes($request->Custo_aquisição_usd));

       }

       if(!is_null($request->Custo_aquisição_euro))
       {
        $Custo_aquisição_euro=$h->moeda(addslashes($request->Custo_aquisição_euro));

       }


        $s=[
            'num_mobilizado'=> addslashes($request->num_mobilizado),
            'descricao'=>addslashes($request->descricao),
            'marca'=>addslashes($request->marca),
            'valor_aquisicao'=>$valor_aquisicao,
            'finalidade'=>addslashes($request->finalidade),
            'tipo_aquisicao'=>addslashes($request->tipoaquisicao),
            'data_aquisicao'=>addslashes($request->dataaquisicao),
            'cor'=>addslashes($request->cor),
            'tipo'=>addslashes( $request->tipomovel),
            'fornecedor_id'=>addslashes( $request->fornecedor),
            'departamento_id'=>addslashes($request->departamento),
            'custo_aquisicao_usd'=>$Custo_aquisição_usd,
             'custo_aquisicao_euro'=>$Custo_aquisição_euro,
    ];
    
        $m=MaterialEscritorioModel::findOrFail(addslashes($request->id));
        $m->update($s);
        $material=$this->material_escritorios();
        return view('material_escritorio.consultar',['mat'=>$material,'sms'=>'Registo alterado com sucesso']);
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
        $mat=DB::table('materialescritorio')
        ->join('departamentos','departamentos.id','=','materialescritorio.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->where('materialescritorio.num_mobilizado','=',addslashes($request->num_imobilizado))
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();

        

         if($mat->count()>0)
         {
            return  view('material_escritorio.consultar',['mat'=>$mat]);
         }

         return  view('material_escritorio.consultar',['erro'=>'registo não encontrado']);

    }

    public function material_escritorio($id){

        $p=DB::table('materialescritorio')
        ->join('departamentos','departamentos.id','=','materialescritorio.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->join('fornecedor','fornecedor.id','=','materialescritorio.fornecedor_id')
       
        ->where('materialescritorio.id','=',addslashes($id))
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos','fornecedor.nome as fornecedor' )
        ->get();

        return $p;

     }


    public function comprovativo($id)
    {


         $p=$this->material_escritorio($id);
        
         PDF::setOption(['isRemoteEnabled' => true]);
         //dd($p->first());
         $pdf=PDF::loadView('relatorios.comprovativo-matescritorio',['v'=>$p->first()]);
         return $pdf->setPaper('a4')->stream('teste.pdf');

    }


    public function consultarMaterial()
    {
        $mat=$this->material_escritoriosConsultar();
        $abate=MotivoAbate::all();
        
        return view('abates.materialEscritorio',['mat'=>$mat,'abates'=>$abate]);
    }

}
