<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnderecoModel;
use App\Models\Edificio;
use Illuminate\Support\Facades\DB;
use App\Models\TipoAquisicaoModel;
use App\Http\Controllers\HelperController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MotivoAbate;



class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function edificios()
     {
        $ed=DB::table('edificio')
        ->join('endereco','edificio.endereco_id','=','endereco.id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','edificio.tipo_aquisicao')
        ->where('edificio.estado','=','ativo')
        //->where('edificio.estado','!=','ativo')
        ->select('edificio.*','edificio.id as codigo','endereco.*','tipoaquisicao.descricao as desctipo')
        ->get();

        
        return $ed;

     }

     public function edificiosConsultar()
     {
        $ed=DB::table('edificio')
        ->join('endereco','edificio.endereco_id','=','endereco.id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','edificio.tipo_aquisicao')
      //  ->where('edificio.estado','=','ativo')
        //->where('edificio.estado','!=','ativo')
        ->select('edificio.*','edificio.id as codigo','endereco.*','tipoaquisicao.descricao as desctipo')
        ->paginate(3);

        
        return $ed;

     }


     public function edificio($id)
     {
        $ed=DB::table('edificio')
        ->join('endereco','edificio.endereco_id','=','endereco.id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','edificio.tipo_aquisicao')
        ->where('edificio.id','=',$id)
        ->where('edificio.estado','=','ativo')
        ->select('edificio.*','edificio.id as codigo','endereco.*','tipoaquisicao.descricao as desctipo')
        ->get();

        return $ed;

     }

     public function edificioByNumImobilizado($num)
     {
        $ed=DB::table('edificio')
        ->join('endereco','edificio.endereco_id','=','endereco.id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','edificio.tipo_aquisicao')
        ->where('edificio.num_imobilizado','=',$num)
        ->where('edificio.estado','=','ativo')
        ->select('edificio.*','edificio.id as codigo','endereco.*','tipoaquisicao.descricao as desctipo')
        ->get();

        return $ed;

     }

    public function index()
    {
        $ed=$this->edificios();
        
         return view('edificio.consultar',['edificio'=>$ed]);
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $t=  TipoAquisicaoModel::all();
        return view('edificio.index',['tipo'=>$t]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $e=new EnderecoModel();
        $ed=new Edificio ();
        $valoraquisicao=null;
        $Custo_aquisiçao_usd=null;
        $Custo_aquisiçao_euro=null;
        $h=new HelperController();
        
        if(!is_null($request->valoraquisicao))
        {
         
         $valoraquisicao=$h->moeda(addslashes($request->valoraquisicao));
        
 
        }
 
        if(!is_null($request->Custo_aquisiçao_usd))
        {
         $Custo_aquisiçao_usd=$h->moeda(addslashes($request->Custo_aquisiçao_usd));
 
        }
 
        if(!is_null($request->Custo_aquisiçao_euro))
        {
         $Custo_aquisiçao_euro=$h->moeda(addslashes($request->Custo_aquisiçao_euro));
 
        }

        $e->provincia=addslashes($request->provincia);
        $e->municipio=addslashes($request->municipio);
        $e->rua=addslashes($request->rua);
        $e->bairro=addslashes($request->bairro);
        $e->save();
        //endereço
        $ed->num_imobilizado=addslashes($request->numimobilizado);
        $ed->descricao=addslashes($request->descricao);
        $ed->valor_aquisicao=$valoraquisicao;
        $ed->custo_aquisicao_usd=$Custo_aquisiçao_usd;
        $ed->custo_aquisicao_euro=$Custo_aquisiçao_euro;
        $ed->finalidade=addslashes($request->finalidade);
        $ed->tipo_aquisicao=addslashes($request->tipoaquisicao);
        $ed->data_aquisicao=addslashes($request->dataaquisicao);
        $ed->num_apartamento=addslashes($request->numapartamento);
        $ed->num_andar=addslashes($request->numandar);
        $ed->endereco_id=addslashes($e->id);
        $ed->estado='ativo';
        
        $ed->save();
        return view('edificio.index',['sms'=>'Edificio registada com sucesso']);
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
        $ed=$this->edificio($id);
        $t=  TipoAquisicaoModel::all();
       
        return view('edificio.editar',['ed'=>$ed->first(),'tipo'=>$t]);
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
         
        $e=EnderecoModel::findOrFail(addslashes($request->endereco_id));
       
        $auxendereco=[
            'provincia'=>addslashes($request->provincia),
            'municipio'=>addslashes($request->municipio),
            'rua'=>addslashes($request->rua),
             'bairro'=>addslashes($request->bairro),
        ];
        //atualizar o endereço
        $e->update($auxendereco);

        
        $valoraquisicao=null;
        $Custo_aquisiçao_usd=null;
        $Custo_aquisiçao_euro=null;
        $h=new HelperController();
        
        if(!is_null($request->valoraquisicao))
        {
         
         $valoraquisicao=$h->moeda(addslashes($request->valoraquisicao));
        
 
        }
 
        if(!is_null($request->Custo_aquisiçao_usd))
        {
         $Custo_aquisiçao_usd=$h->moeda(addslashes($request->Custo_aquisiçao_usd));
 
        }
 
        if(!is_null($request->Custo_aquisiçao_euro))
        {
         $Custo_aquisiçao_euro=$h->moeda(addslashes($request->Custo_aquisiçao_euro));
 
        }
        $ed=Edificio::findOrFail(addslashes($request->id));;
        $auxed=[
        'num_imobilizado'=>addslashes($request->numimobilizado),
        'descricao'=>addslashes($request->descricao),
        'valor_aquisicao'=>$valoraquisicao,
        'custo_aquisicao_usd'=>$Custo_aquisiçao_usd,
        'custo_aquisicao_euro'=>$Custo_aquisiçao_euro,
        'finalidade'=>addslashes($request->finalidade),
        'tipo_aquisicao'=>addslashes($request->tipoaquisicao),
        'data_aquisicao'=>addslashes($request->dataaquisicao),
        'num_apartamento'=>addslashes($request->numapartamento),
        'num_andar'=>addslashes($request->numandar),
        'endereco_id'=>addslashes($e->id),
        ];

        $ed->update($auxed);

        return view('edificio.consultar',['edificio'=>$this->edificios(),'sms'=>'registo alterado com sucesso']);

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
        $ed=$this->edificioByNumImobilizado(addslashes($request->num_mobilizado));
        if($ed->count()>0)
        {
            return view('edificio.consultar',['edificio'=>$ed]);
        }

       

        return view('edificio.consultar',['erro'=> 'registo não encontrado']);


    }


    public function comprovativo($id)
    {


         $p=$this->edificio(addslashes($id));
         PDF::setOption(['isRemoteEnabled' => true]);
         //dd($p->first());
         $pdf=PDF::loadView('relatorios.comprovativo-edificio',['v'=>$p->first()]);
         return $pdf->setPaper('a4')->stream('teste.pdf');

    }


    public function consultar()
    {
        $ed=$this->edificiosConsultar();
        $abate=MotivoAbate::all();
        
        return view('abates.edificio',['edificio'=>$ed,'abates'=>$abate]);

     
    }
}
