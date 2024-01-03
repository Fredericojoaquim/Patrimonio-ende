<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialElectronico ;
use App\Models\TipoAquisicaoModel;
use App\Models\FornecedorMovel;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\HelperController;
use App\Models\MotivoAbate;

class MaterialElectronicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function material_eletronicos(){

        $p=DB::table('materiaeletronico')
        ->join('departamentos','departamentos.id','=','materiaeletronico.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
        ->where('materiaeletronico.estado','=','ativo')
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos', 'fornecedor.nome as fornecedor' )
        ->get();

        return $p;

     }

     


    public function index()
    {
      
        $dep=Departamento::all();
        return view('material_eletronico.consultar',['mat'=>$this->material_eletronicos(),'dep'=>$dep]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dep=Departamento::all();
        $t= TipoAquisicaoModel::all();
        $fornecedores=FornecedorMovel::all();
        return view('material_eletronico.registar',['fornecedor'=>$fornecedores, 'tipo'=>$t,'dep'=>$dep]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valoraquisicao=null;
        $Custo_aquisição_usd=null;
        $Custo_aquisição_euro=null;
        $h=new HelperController();





        if(!is_null($request->valoraquisicao))
       {
        
        $valoraquisicao=$h->moeda(addslashes($request->valoraquisicao));
       

       }

       if(!is_null($request->Custo_aquisição_usd))
       {
        $Custo_aquisição_usd=$h->moeda(addslashes($request->Custo_aquisição_usd));

       }

       if(!is_null($request->Custo_aquisição_euro))
       {
        $Custo_aquisição_euro=$h->moeda(addslashes($request->Custo_aquisição_euro));

       }


        $m=new MaterialElectronico ();
        $m->num_mobilizado=addslashes($request->numimobilizado);
        $m->descricao=addslashes($request->descricao);
        $m->descricao=addslashes($request->valoraquisicao);
        $m->tipoaquisicao_id=addslashes($request->tipoaquisicao);
        $m->data_aquisicao=addslashes($request->dataaquisicao);
        $m->marca=addslashes($request->marca);
        $m->modelo=addslashes($request->modelo);
        $m->cor=addslashes($request->cor);
        $m->estado='ativo';
        $m->ram=addslashes($request->ram);
        $m->armazenamento=addslashes($request->armazenamento);
        $m->tipo=addslashes($request->tipo);
        $m->fornecedor_id=addslashes($request->fornecedor);
        $m->valor_aquisicao=$valoraquisicao;
        $m->departamento_id=addslashes($request->departamento);
        $m->custo_aquisicao_usd=$Custo_aquisição_usd;
        $m->custo_aquisicao_euro=$Custo_aquisição_euro;
        
        $m->save();
        return view('material_eletronico.registar',['sms'=>'Material Registado com sucesso']);

        

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
        $p=DB::table('materiaeletronico')
        ->join('departamentos','departamentos.id','=','materiaeletronico.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
        ->where('materiaeletronico.id','=',addslashes($id))
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos', 'fornecedor.nome as fornecedor' )
        ->get();
        if($p->count()>0)
        {
            $dep=Departamento::all();
            $t= TipoAquisicaoModel::all();
            $fornecedores=FornecedorMovel::all();
            //dd($p->first());
            return view('material_eletronico.editar',['m'=>$p->first(),'fornecedor'=>$fornecedores, 'tipo'=>$t,'dep'=>$dep]);

        }
        
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
        $h=new HelperController();
        $valoraquisicao=null;
        $Custo_aquisição_usd=null;
        $Custo_aquisição_euro=null;



        if(!is_null($request->valoraquisicao))
        {
         $valoraquisicao=$h->moeda(addslashes($request->valoraquisicao));
         dd($valoraquisicao);
 
        }
 
        if(!is_null($request->Custo_aquisição_usd))
        {
         $Custo_aquisição_usd=$h->moeda(addslashes($request->valoraquisicao));
 
        }
 
        if(!is_null($request->Custo_aquisição_euro))
        {
         $Custo_aquisição_euro=$h->moeda(addslashes($request->Custo_aquisição_euro));
 
        }
        

        $s=[
            'num_mobilizado'=>addslashes($request->numimobilizado),
            'descricao'=>addslashes($request->descricao),
            'descricao'=>addslashes($request->valoraquisicao),
            'tipoaquisicao_id'=>addslashes($request->tipoaquisicao),
            'data_aquisicao'=>addslashes($request->dataaquisicao),
            'marca'=>addslashes($request->marca),
            'modelo'=>addslashes($request->modelo),
            'cor'=>addslashes($request->cor),
            'ram'=>addslashes($request->ram),
            'armazenamento'=>addslashes($request->armazenamento),
            'tipo'=>addslashes($request->tipo),
            'fornecedor_id'=>addslashes($request->fornecedor),
            'valor_aquisicao'=>$valoraquisicao,
            'departamento_id'=>addslashes($request->departamento),
            'custo_aquisicao_usd'=>$Custo_aquisição_usd,
             'custo_aquisicao_euro'=>$Custo_aquisição_euro
    ];

    $m=MaterialElectronico::findOrFail(addslashes($request->id));
    $m->update($s);
    return view('material_eletronico.consultar',['mat'=>$this->material_eletronicos(),'sms'=>'Registo alterado com sucesso']);

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

    public function material_eletronico($id){

        $p=DB::table('materiaeletronico')
        ->join('departamentos','departamentos.id','=','materiaeletronico.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
        ->where('materiaeletronico.id','=',addslashes($id))
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos', 'fornecedor.nome as fornecedor' )
        ->get();

        return $p;

     }


    public function comprovativo($id)
    {


         $p=$this->material_eletronico($id);
        
         PDF::setOption(['isRemoteEnabled' => true]);
        // dd($p->first());
         $pdf=PDF::loadView('relatorios.comprovativo-mateletronico',['v'=>$p->first()]);
         return $pdf->setPaper('a4')->stream('teste.pdf');

    }

    public function material_eletronicosConsultar(){

        $p=DB::table('materiaeletronico')
        ->join('departamentos','departamentos.id','=','materiaeletronico.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
      
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos', 'fornecedor.nome as fornecedor' )
        ->paginate(3);;

        return $p;

     }


     public function consultar()
     {
        $abate=MotivoAbate::all();
        $mat=$this->material_eletronicosConsultar();
   
        return view('abates.materialeletronico',['mat'=>$mat,'abates'=>$abate]);
     }



     public function transferir(Request $request)
     {
         $s=['departamento_id'=>addslashes($request->departamento)];
         $m=MaterialElectronico::findOrFail(addslashes($request->material_id));
         $m->update($s);
         $dep=Departamento::all();
 

         $dep=Departamento::all();
         
         return view('material_eletronico.consultar',['mat'=>$this->material_eletronicos(),'dep'=>$dep,'sms'=>'Móvel transferido com sucesso']);
     }


}



