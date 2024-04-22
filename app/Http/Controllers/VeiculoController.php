<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAquisicaoModel;
use App\Models\Departamento;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MotivoAbate;
use App\Models\NotificacaoVeiculo as Notificao;
use DateTime;
use App\Models\TipoSeguro;
use App\Models\VeiculoPessoal;
use App\Models\Pessoal;
use App\Models\DepreciacaoVeiculo;


class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {
        //$this->calcularData();
    }

    public function pessoal()
    {
        $p=DB::table('pessoal')
         ->where('pessoal.departamento_id','=','')
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();
    }

     public function veiculos(){

        $p=DB::table('veiculos')
        ->join('veiculo_pessoal','veiculo_pessoal.veiculo_id','=','veiculos.id')
        ->join('pessoal','pessoal.id','=','veiculo_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
         ->where('veiculos.estado','=','ativo')
         ->where('veiculo_pessoal.estado','=','ativo')
         ->orderBy('veiculos.id', 'asc')
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' )
        ->get();
        return $p;

     }


    public function index()
    {
        $dep=Departamento::all();
        $not_veiculo=$this->Notificacoes();
       
        $total_notificao=$not_veiculo->count();
        $pessoal=Pessoal::all();

        $ve=$this->veiculos();
        return view('veiculo.consultar',['ve'=>$ve,'dep'=>$dep,'not_veiculo'=>$not_veiculo,'total_notificacao'=>$total_notificao,'pessoal'=>$pessoal]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposeguro=TipoSeguro::all();
        $dep=Departamento::all();
        $pessoal=Pessoal::all();
        $t= TipoAquisicaoModel::all();
        $not_veiculo=$this->Notificacoes();
        $total_notificao=$not_veiculo->count();
        return view('veiculo.index',['tipo'=>$t, 'dep'=>$dep,'not_veiculo'=>$not_veiculo,'total_notificacao'=>$total_notificao,'tiposeguro'=> $tiposeguro,'pessoal'=>$pessoal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Custo_aquisição_kz=null;
        $Custo_aquisição_usd=null;
        $Custo_aquisição_euro=null;
        $h=new HelperController();
       

        if(!is_null($request->Custo_aquisição_kz))
        {
            $Custo_aquisição_kz=$h->moeda(addslashes($request->Custo_aquisição_kz));
 
        }
 
        if(!is_null($request->Custo_aquisição_usd))
        {
         $Custo_aquisição_usd=$h->moeda(addslashes($request->Custo_aquisição_usd));
 
        }
 
        if(!is_null($request->Custo_aquisição_euro))
        {
         $Custo_aquisição_euro=$h->moeda(addslashes($request->Custo_aquisição_euro));
 
        }

        $valor_seguro=null;
       $nome_seguradora=""; $tiposeguro=null;$apolice=null; $datainicio=null; $datafim=null;
       if(!is_null($request->cobertura))
       {
        $tiposeguro=addslashes($request->cobertura);

       }
       if(!is_null($request->nome_seguradora))
       {
        $nome_seguradora=addslashes($request->nome_seguradora);

       }
       if(!is_null($request->valor_seguro))
       {
        $valor_seguro=addslashes($request->valor_seguro);

       }

       if(!is_null($request->apolice))
       {
        $apolice=addslashes($request->apolice);

       }
       if(!is_null($request->datainicio))
       {
        $datainicio=addslashes($request->datainicio);

       }


        $v= new Veiculo();
        $v->marca=addslashes($request->marca);
        $v->modelo=addslashes($request->modelo);
        $v->matricula=addslashes($request->matricula);
        $v->numero_chassi=addslashes($request->num_chassi);
        $v->num_motor=addslashes($request->num_motor);
        $v->tipo_caixavelocidade=addslashes($request->caixa_velocidade);
        $v->data_fabrico=addslashes($request->data_fabrico);
        $v->tipo_aquisicao=addslashes($request->tipoaquisicao);
        $v->tipo_combustivel=addslashes($request->tipocombustivel);
        $v->cor=addslashes($request->cor);
        $v->tipo_veiculo=addslashes($request->tipoveiculo);
        $v->custo_aquisicao_kz=$Custo_aquisição_kz;
        $v->custo_aquisicao_usd=$Custo_aquisição_usd;
        $v->custo_aquisicao_euro=$Custo_aquisição_euro;
        
        $v->dataAquisicao=addslashes($request->dataAquisicao);
        $v->nome_segurador= $nome_seguradora;
        $v->valor_seguro=$valor_seguro;
        $v->apolice=$apolice;
        $v->data_inicio= $datainicio;
        $v->data_fim=$datafim;
        
        $v->estado='ativo';
        $v->tiposguro_id=$tiposeguro;
        $v->valor_residual=$request->vresidual;
        $v->vida_util=addslashes($request->vidautil);
        $v->data_utilizacao=$request->datautilizacao;
        $v->save();

        $vp=new VeiculoPessoal();
        $vp->veiculo_id=$v->id;
        $vp->pessoal_id=$request->pessoal;
        $vp->estado='Ativo';
        $vp->save();

        //
        $depveiculo=new DepreciacaoVeiculo();
        $depveiculo->veiculo_id=$v->id;
        $depAnual=($v->custo_aquisicao_kz-$v->valor_residual)/$v->vida_util;
        $depveiculo->dp_anual=$depAnual;
        $depveiculo->save();

       

        /*if($this->compararData($request->dataAquisicao))
        {
            $this->inserirNotificao($v->id);

        }*/

        

        $dep=Departamento::all();
        $t= TipoAquisicaoModel::all();
        $tiposeguro=TipoSeguro::all();
        return view('veiculo.index',['sms'=>'Veículo registada com sucesso', 'dep'=>$dep,'tipo'=>$t,'tiposeguro'=> $tiposeguro]);

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
    public function update(Request $request)
  
    {
        $h=new HelperController();
       $valor_seguro=null;
       $nome_seguradora=""; $tiposeguro=null;$apolice=null; $datainicio=null; $datafim=null;

       if(!is_null($request->tiposeguro))
       {
        $tiposeguro=addslashes($request->tiposeguro);

       }
       if(!is_null($request->nome_seguradora))
       {
        $nome_seguradora=addslashes($request->nome_seguradora);

       }
       if(!is_null($request->valor_seguro))
       {
        $valor_seguro=addslashes($request->valor_seguro);

       }

       if(!is_null($request->apolice))
       {
        $apolice=addslashes($request->apolice);

       }
       if(!is_null($request->datainicio))
       {
        $datainicio=addslashes($request->datainicio);

       }

       if(!is_null($request->datafim))
       {
        $datafim=addslashes($request->datafim);

       }

       $Custo_aquisição_kz=null;
        $Custo_aquisição_usd=null;
        $Custo_aquisição_euro=null;

        if(!is_null($request->Custo_aquisição_kz))
        {
            $Custo_aquisição_kz=$h->moeda(addslashes($request->Custo_aquisição_kz));
 
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
            'marca'=>addslashes($request->marca),
            'modelo'=>addslashes($request->modelo),
            'matricula'=>addslashes($request->matricula),
            'numero_chassi'=>addslashes($request->num_chassi),
            'num_motor'=>addslashes($request->num_motor),
            'tipo_caixavelocidade'=>addslashes($request->caixa_velocidade),
            'data_fabrico'=>addslashes($request->data_fabrico),
            'tipo_aquisicao'=>addslashes($request->tipoaquisicao),
            'tipo_combustivel'=>addslashes($request->tipocombustivel),
            'cor'=>addslashes($request->cor),
            'tipo_veiculo'=>addslashes($request->tipoveiculo),
            'custo_aquisicao_kz'=>$Custo_aquisição_kz,
            'custo_aquisicao_usd'=>$Custo_aquisição_usd,
            'custo_aquisicao_euro'=>$Custo_aquisição_euro,
            'nome_segurador'=>$nome_seguradora,
            'valor_seguro'=>$valor_seguro,
            'apolice'=>$apolice,
            'data_inicio'=>$datainicio,
            'data_fim'=> $request->datafim,
            'departamento_id'=>addslashes($request->departamento),
            'vida_util'=>addslashes($request->vidautil),
            'dataAquisicao'=>addslashes($request->dataAquisicao),
            'tiposguro_id'=>$tiposeguro
        ];

        $v=Veiculo::findOrFail(addslashes($request->id));
        $v->update($s);

        //actualizar dados de depreciação
         //atualizar dados da depreciação
         $dep=DepreciacaoVeiculo::where('veiculo_id', $v->id)->first();
         $depAnual=($v->custo_aquisicao_kz-$v->valor_residual)/$v->vida_util;
         $s=['veiculo_id'=>$v->id,
         'dp_anual'=>$depAnual,
         ];
 
        DepreciacaoResidencia::findOrFail($dep->id)->update($s);
        $ve=$this->veiculos();
        return view('veiculo.consultar',['ve'=>$ve,'sms'=>'Veículo alterado com sucesso']);
        
  
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
    public function editar($id)
    {
        $p=$this->veiculo(addslashes($id));
       
        if($p->count()>0)
        {
            $dep=Departamento::all();
            $t= TipoAquisicaoModel::all();
            $tiposeguro=TipoSeguro::all();
            return view('veiculo.editar',['v'=>$p->first(),'tipo'=>$t, 'dep'=>$dep,'tiposeguro'=>$tiposeguro]);

        }

       

       
        
    }


    public function veiculo($id)
    {
      
        $p=DB::table('veiculos')
        ->join('veiculo_pessoal','veiculo_pessoal.veiculo_id','=','veiculos.id')
        ->join('pessoal','pessoal.id','=','veiculo_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
         ->where('veiculos.estado','=','ativo')
         ->where('veiculo_pessoal.estado','=','ativo')
         ->where('veiculos.id','=',addslashes($id))
         ->orderBy('veiculos.id', 'asc')
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' )
        ->get();
        return $p;
    }

    public function veiculoByMatricula($matricula)
    {
        $p=DB::table('veiculos')
        ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
        ->where('veiculos.matricula','=',addslashes($matricula))
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();
        return $p;
    }

    public function veiculoByMarca($marca)
    {
        $p=DB::table('veiculos')
        ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
        ->where('veiculos.marca','=',addslashes($marca))
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();
        return $p;
    }



    public function comprovativo($id)
    {


         $p=$this->veiculo($id);
         PDF::setOption(['isRemoteEnabled' => true]);
         //dd($p->first());
         $pdf=PDF::loadView('relatorios.comprovativo-veiculo',['v'=>$p->first()]);
         return $pdf->setPaper('a4')->stream('teste.pdf');

    }


    public function pesquisar(Request $request)
    {
        if($request->selectbusca=='Matricula')
        {
            $ve=$this->veiculoByMatricula($request->descricao);
            return view('veiculo.consultar',['ve'=>$ve]);
        }

        if($request->selectbusca=='Marca')
        {
            $ve=$this->veiculoByMarca($request->descricao);
          
            return view('veiculo.consultar',['ve'=>$ve]);
        }

    }


    public function veiculosConsultar(){

        $p=DB::table('veiculos')
        ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
       
       // ->where('trabalhos.tipo','!=','Auto-Arquivamento')
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->paginate(3);
        //->get();

        return $p;

     }

     //abates


    public function consultarVeiculo()
    {

        $abate=MotivoAbate::all();
        $ve=$this->veiculosConsultar();
        return view('abates.veiculos',['ve'=>$ve,'abates'=>$abate]);
    }


    public function pesquisarVeiculos(Request $request)
    {
        if($request->selectbusca=='Matricula')
        {
            $ve=$this->veiculoByMatriculaAbate($request->descricao);
            $abate=MotivoAbate::all();
            if($ve->count()>0)
            {
                return view('abates.veiculos',['ve'=>$ve,'abates'=>$abate]);
            }
            return view('abates.veiculos',['erro'=>'Veículo não encontrado']);
            
        }


        if($request->selectbusca=='Marca')
        {
            $ve=$this->veiculoByMarcaAbate($request->descricao);
            $abate=MotivoAbate::all();
          
            if($ve->count()>0)
            {
                return view('abates.veiculos',['ve'=>$ve, 'abates'=>$abate]);
            }
            return view('abates.veiculos',['erro'=>'Veículo não encontrado']);
        }
    }

       
        public function veiculoByMarcaAbate($marca)
        {
            $p=DB::table('veiculos')
            ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
            ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
            ->where('veiculos.marca','=',addslashes($marca))
            ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
            ->paginate(3);
            return $p;
        }


        public function veiculoByMatriculaAbate($matricula)
        {
            $p=DB::table('veiculos')
            ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
            ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
            ->where('veiculos.matricula','=',addslashes($matricula))
            ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
           // ->get();
           ->paginate(3);
            return $p;
        }



        public function transferir(Request $request)
        {

            $vp=VeiculoPessoal::where('estado', 'Ativo')->where('veiculo_id', $request->id_veiculo)->first();
            $s=['estado'=>'cessado'];
            VeiculoPessoal::findOrFail($vp->id)->update($s);
       
            //salvando o historico da atribuição do material ao pessoal
               $new_veiculo_pessoal=new VeiculoPessoal();
               $new_veiculo_pessoal->pessoal_id=$request->pessoal;
               $new_veiculo_pessoal->veiculo_id=$request->id_veiculo;
               $new_veiculo_pessoal->estado='Ativo';
               $new_veiculo_pessoal->save();
       


            //

            $pessoal=Pessoal::all();
            $ve=$this->veiculos();
            return view('veiculo.consultar',['ve'=>$ve,'pessoal'=>$pessoal, 'sms'=>'Veiculo Atribuído com sucesso']);


        }



        public function calcularData()
        {
            $veiculos=Veiculo::all();
           // $v=Veiculo::findOrFail(8);
            foreach($veiculos as $v)
            {
                $dataAquisicao = $v->dataAquisicao;
                $hoje=new DateTime();
                $dateaquisicao=new DateTime($v->dataAquisicao);
                $diferenca=$hoje->diff($dateaquisicao);
                $vida_util=$v->vida_util;
                $dif_em_ano=$this->diasEmAno($vida_util, $diferenca->days);
                
                if(!$this->veiculoNotificado($v->id))
                {
                   
                    if($dif_em_ano-$vida_util>=0)
                    {
                        $this->inserirNotificao($v->id);

                    }

                }
            }   
        }



        public function compararData($data)
        {
            $hoje=new DateTime();
            $dateaquisicao=new DateTime($v->data);
            return $hoje>$dateaquisicao;
        }


        public function inserirNotificao($id)
        {
            $n=new Notificao();
            $n->veiculo_id=$id;
            $n->descricao="O tempo de vida útil para este veículo terminou";
            $n->estado="não visto";
            $n->save();
            return true;
        }


        public function diasEmAno($anos, $dias)
        {
            $result=$dias/365;
            return $result;

        }


        public function veiculoNotificado($id)
        {
            

                $p=DB::table('notificacao_veiculo')
                ->join('veiculos','veiculos.id','=','notificacao_veiculo.veiculo_id')
                ->where('veiculos.id','=',$id)
                ->select('notificacao_veiculo.*')
                ->get();

                if( $p->count()>0)
                {
                    return true;
                }

                return false;
        
             
        }



        public function notificacaoByVeiculo($id_veiculo)
        {
                $p=DB::table('notificacao_veiculo')
                ->join('veiculos','veiculos.id','=','notificacao_veiculo.veiculo_id')
                ->where('veiculos.id','=',$id_veiculo)
                ->select('notificacao_veiculo.*')
                ->get();
                return  $p->first();
        
             
        }


        public function Notificacoes()
        {
                $p=DB::table('notificacao_veiculo')
                ->join('veiculos','veiculos.id','=','notificacao_veiculo.veiculo_id')
                ->where('notificacao_veiculo.estado','=','não visto')
                ->select('notificacao_veiculo.*')
                ->get();
                return $p;
        }

        public function veiculo_vencido($id)
        {
            $ve=$this->veiculo(addslashes($id));
            $id_notificacao=$this->notificacaoByVeiculo($id)->id;
            $notificacao=Notificao::findOrFail( $id_notificacao);
            $s=['estado'=>'visto'];
            $notificacao->update($s);
            return view('veiculo.veiculoExpirado',['ve'=> $ve]);

        }


        public function historicoAtribuicoes($id)
        {
           $mat=DB::table('veiculo_pessoal')
           ->join('pessoal','pessoal.id','=','veiculo_pessoal.pessoal_id')
           ->join('departamentos','departamentos.id','=','pessoal.departamento_id')
           ->where('veiculo_pessoal.veiculo_id','=',addslashes($id))
           ->select('veiculo_pessoal.*','pessoal.nome as pessoal','veiculo_pessoal.created_at as dataregisto','departamentos.descricao as departamento','pessoal.funcao')
           ->orderBy('veiculo_pessoal.created_at', 'asc')
           ->get();
   
           return view('veiculo.detalhes',['mat'=>$mat]);
   
   
        }




    public function historicoDepreciacao($id)
    {
    $dep=DB::table('depreciacao_veiculo')
                ->join('veiculos','veiculos.id','=','depreciacao_veiculo.veiculo_id')
                ->where('veiculos.id','=',$id)
                ->select('depreciacao_veiculo.*','veiculos.custo_aquisicao_kz as valoraquisicao','veiculos.valor_residual as valorresidual','veiculos.vida_util as vidautil','veiculos.data_utilizacao as datainicio','veiculos.id as numeroimovel') 
                ->get();
    $dados= $dep->first();

    $h=new Helper();
    $vidautilRestante=$h->calcularVidaUtilRestante($dados-> datainicio, $dados->vidautil);
    $dado=$h->calcularDepreciacaoAcumuladaEValorContabil($dados->vidautil, $dados-> datainicio, $dados->valorresidual, $dados->dp_anual, $dados->valoraquisicao);


              
   
    return view('veiculo.historicoDepreciacao',['dep'=>$dep,'vidautilRestante'=>$vidautilRestante,'dado'=>$dado]);
    
}
   


    
    

    }


    

