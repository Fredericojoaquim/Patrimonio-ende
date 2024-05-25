<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAquisicaoModel;
use App\Models\Terreno;
use App\Models\EnderecoModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MotivoAbate;
use DateTime;
use App\Models\NotificacaoTerreno as Notificacao;


class TerrenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct() {
        $this->calcularData();
    }

     public function terrenos()
     {
        $te=DB::table('terrenos')
         ->join('endereco','terrenos.endereco_id','=','endereco.id')
         ->join('tipoaquisicao','tipoaquisicao.id','=','terrenos.tipo_aquisicao')
         ->where('terrenos.estado','=','ativo')
         ->select('terrenos.*','terrenos.id as codigo','endereco.*')
         ->get();

         return $te;

     }


     public function terreno($id)
     {
        $te=DB::table('terrenos')
         ->join('endereco','terrenos.endereco_id','=','endereco.id')
         ->join('tipoaquisicao','tipoaquisicao.id','=','terrenos.tipo_aquisicao')
         ->where('terrenos.id','=',addslashes($id))
       
         ->select('terrenos.*','terrenos.id as codigo','endereco.*','tipoaquisicao.descricao as desctipo')
         ->get();
         return $te;

     }

    

    public function index()
    {
        $not_terrenos=$this->Notificacoes();
        $total_notificao_terrenos=$not_terrenos->count();

        $te=$this->terrenos();
      

         return view('terreno.consultar',['te'=>$te,'not_terrenos'=>$not_terrenos,'total_notificao_terreno'=>$total_notificao_terrenos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $t=  TipoAquisicaoModel::all();
        return view('terreno.index',['tipo'=>$t]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $t=new Terreno();
        $e=new EnderecoModel();

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
        $t->num_imobilizado=$request->numimobilizado;
        $t->descricao=$request->descricao;
        $t->valor_aquisicao=$valoraquisicao;
        $t->custo_aquisicao_usd=$Custo_aquisiçao_usd;
        $t->custo_aquisicao_euro=$Custo_aquisiçao_euro;
        $t->finalidade=addslashes($request->finalidade);
        $t->dimensao=addslashes($request->dimensao);
        $t->tipo_aquisicao=addslashes($request->tipoaquisicao);
        $t->data_aquisicao=addslashes($request->dataaquisicao);
        $t->endereco_id=addslashes($e->id);
        $t->estado='ativo';

        $t->save();

        $t=  TipoAquisicaoModel::all();
        return view('terreno.index',['sms'=>'Edificio registada com sucesso','tipo'=>$t]);
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
        $te=$this->terreno($id);
        $tipo=  TipoAquisicaoModel::all();

      
        return view('terreno.editar',['te'=>$te->first(),'tipo'=>$tipo]);
        
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
       
        $e=EnderecoModel::findOrFail(addslashes($request->endereco_id));

        $auxendereco=[
            'provincia'=>addslashes($request->provincia),
            'municipio'=>addslashes($request->municipio),
            'rua'=>addslashes($request->rua),
             'bairro'=>addslashes($request->bairro),
        ];
        //atualizar o endereço
        $e->update($auxendereco);
        //endereço
        $aux_ter = [
        'num_imobilizado'=>$request->numimobilizado,
        'descricao'=>$request->descricao,
        'valor_aquisicao'=>$valoraquisicao,
        'custo_aquisicao_usd'=>$Custo_aquisiçao_usd,
        'custo_aquisicao_euro'=>$Custo_aquisiçao_euro,
        'finalidade'=>addslashes($request->finalidade),
        'dimensao'=>addslashes($request->dimensao),
        'tipo_aquisicao'=>addslashes($request->tipoaquisicao),
        'data_aquisicao'=>addslashes($request->dataaquisicao),
        'vida_util'=>addslashes($request->vidautil),
    ];

    $te= Terreno::findOrFail(addslashes($request->id));
    $te->update($aux_ter);

    return view('terreno.consultar',['te'=>$this->terrenos(),'sms'=>'Registo alterado com sucesso']);
        
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


    public function comprovativo($id)
    {


         $p=$this->terreno(addslashes($id));
     
         PDF::setOption(['isRemoteEnabled' => true]);
         //dd($p->first());
         $pdf=PDF::loadView('relatorios.comprovativo-terreno',['v'=>$p->first()]);
         return $pdf->setPaper('a4')->stream('teste.pdf');

    }


    public function terrenoByNumImobilizado($num)
    {
      
       $te=DB::table('terrenos')
        ->join('endereco','terrenos.endereco_id','=','endereco.id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','terrenos.tipo_aquisicao')
        ->where('terrenos.num_imobilizado','=',addslashes($num))
        ->where('terrenos.estado','=','ativo')
        ->select('terrenos.*','terrenos.id as codigo','endereco.*','tipoaquisicao.descricao as desctipo')
        ->get();

        return $te;

    }


    public function pesquisar(Request $request)
    {
        
        $ed=$this->terrenoByNumImobilizado(addslashes($request->num_mobilizado));
      
        if($ed->count()>0)
        {
            return view('terreno.consultar',['te'=>$ed]);
        }

       

        return view('terreno.consultar',['erro'=> 'registo não encontrado']);


    }


    public function terrenosConsultar()
    {
       $te=DB::table('terrenos')
        ->join('endereco','terrenos.endereco_id','=','endereco.id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','terrenos.tipo_aquisicao')
      
        ->select('terrenos.*','terrenos.id as codigo','endereco.*')
        ->paginate(5);

        return $te;

    }


    public function consultar()
    {
        $te=$this->terrenosConsultar();
        $abate=MotivoAbate::all();
        return view('abates.terrenos',['abates'=>$abate,'te'=>$te]);
    }


    public function terreno_vencido($id)
    {
        $ve=$this->terreno(addslashes($id));
       
        $id_notificacao=$this->notificacaoByTerreno($id)->id;
        $notificacao=Notificacao::findOrFail( $id_notificacao);
        $s=['estado'=>'visto'];
        $notificacao->update($s);
        return view('terreno.terrenovencido',['ve'=> $ve]);

    }


    public function inserirNotificao($id)
    {
        $n=new Notificacao();
        $n->terreno_id=$id;
        $n->descricao="O tempo de vida útil para este terreno terminou";
        $n->estado="não visto";
        $n->save();
        return true;
    }


    public function diasEmAno($anos, $dias)
    {
        $result=$dias/365;
        return $result;

    }

    public function TerrenoNotificado($id)
    {
            $p=DB::table('_notificacao_terreno')
            ->join('terrenos','terrenos.id','=','_notificacao_terreno.terreno_id')
            ->where('_notificacao_terreno.id','=',$id)
            ->select('_notificacao_terreno.*')
            ->get();

            if( $p->count()>0)
            {
                return true;
            }

            return false;
    
         
    }


    public function notificacaoByTerreno($id)
    {
        $p=DB::table('_notificacao_terreno')
        ->join('terrenos','terrenos.id','=','_notificacao_terreno.terreno_id')
        ->where('_notificacao_terreno.id','=',$id)
        ->select('_notificacao_terreno.*')
        ->get();

            return  $p->first();      
    }


    public function Notificacoes()
    {
        $p=DB::table('_notificacao_terreno')
        ->join('terrenos','terrenos.id','=','_notificacao_terreno.terreno_id')
        ->where('_notificacao_terreno.estado','=','não visto')
        ->select('_notificacao_terreno.*')
        ->get();
            return $p;
    }


    public function calcularData()
    {
        $te=Terreno::all();
       // $v=Veiculo::findOrFail(8);
        foreach($te as $t)
        {
            $dataAquisicao = $t->dataAquisicao;
            $hoje=new DateTime();
            $dateaquisicao=new DateTime($t->data_aquisicao);
            $diferenca=$hoje->diff($dateaquisicao);
            $vida_util=$t->vida_util;
            $dif_em_ano=$this->diasEmAno($vida_util, $diferenca->days);
            
            if(!$this->TerrenoNotificado($t->id))
            {
               
                if($dif_em_ano-$vida_util>=0)
                {
                    $this->inserirNotificao($t->id);

                }

            }
        }   
    }




}
