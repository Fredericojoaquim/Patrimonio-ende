<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialElectronico ;
use App\Models\TipoAquisicaoModel;
use App\Models\FornecedorMovel;
use App\Models\Departamento;
use App\Models\Pessoal;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\HelperController;
use App\Models\MotivoAbate;
use App\Models\DepreciacaoMatEletronico;
use App\Models\MatEletronico_pessoal ;
use App\Models\NotificacaoMat_eletronico as Notificacao;
use DateTime;
use App\Http\Controllers\Helper;



class MaterialElectronicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     function __construct() {
        $this->calcularData();
    }

    
     public function material_eletronicos(){

        $p=DB::table('materiaeletronico')
        ->join('mateletronico_pessoal','mateletronico_pessoal.material_id','=','materiaeletronico.id')
        ->join('pessoal','pessoal.id','=','mateletronico_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
        ->where('materiaeletronico.estado','=','ativo')
        ->where('mateletronico_pessoal.estado','=','ativo')
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' , 'fornecedor.nome as fornecedor' )
        ->get();

        


        return $p;

     }

    

     


    public function index()
    {
        $not_mat_eletronico=$this->Notificacoes();
        $total_notificao=$not_mat_eletronico->count();
        $dep=Departamento::all();
        $pessoal=Pessoal::all();
        return view('material_eletronico.consultar',['mat'=>$this->material_eletronicos(),'dep'=>$dep,'not_mat_eletronico'=>$not_mat_eletronico,'total_notificao_eletronico'=> $total_notificao,'pessoal'=>$pessoal]);
        
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
        $pessoal=Pessoal::all();
        return view('material_eletronico.registar',['fornecedor'=>$fornecedores, 'tipo'=>$t,'dep'=>$dep,'pessoal'=>$pessoal]);
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
       
        $m->custo_aquisicao_usd=$Custo_aquisição_usd;
        $m->custo_aquisicao_euro=$Custo_aquisição_euro;
       
        $m->vida_util=addslashes($request->vidautil);
        $m->valor_residual=$h->moeda(addslashes($request->vresidual));
        $m->data_utilizacao=addslashes($request->datautilizacao);
       
        $m->save();
        
        //
        $mat=new MatEletronico_pessoal();
        $mat->pessoal_id=addslashes($request->pessoal);
        $mat->material_id=$m->id;
        $mat->estado='ativo';
        $mat->save();
        //
        $dep=new DepreciacaoMatEletronico();
        $depAnual=($m->valor_aquisicao-$m->valor_residual)/$m->vida_util;
        $dep->material_id=$m->id;
        $dep->dp_anual=$depAnual;
        $dep->save();


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
       
        $p=$this->material_eletronico($id);
      

        if($p->count()>0)
        {
            $dep=Departamento::all();
            $t= TipoAquisicaoModel::all();
            $fornecedores=FornecedorMovel::all();
            $pessoal=Pessoal::all();
            //dd($p->first());
            return view('material_eletronico.editar',['m'=>$p->first(),'fornecedor'=>$fornecedores, 'tipo'=>$t,'dep'=>$dep,'pessoal'=>$pessoal]);

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
            'custo_aquisicao_usd'=>$Custo_aquisição_usd,
            'custo_aquisicao_euro'=>$Custo_aquisição_euro,
            'vida_util'=>addslashes($request->vidautil),
            'valor_residual'=>addslashes($request->vresidual),
            'data_utilizacao'=>addslashes($request->datautilizacao),
    ];

    $m=MaterialElectronico::findOrFail(addslashes($request->id));
    $m->update($s);
    //atualizar a tabela de materia-pessoal
    $mat=MatEletronico_pessoal::where('estado', 'ativo')->where('material_id', $m->id)->first();
        $s=['pessoal_id'=>addslashes($request->pessoal)];
        MatEletronico_pessoal::findOrFail($mat->id)->update($s);
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
        ->join('mateletronico_pessoal','mateletronico_pessoal.material_id','=','materiaeletronico.id')
        ->join('pessoal','pessoal.id','=','mateletronico_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
       
        ->where('mateletronico_pessoal.estado','=','ativo')
        ->where('materiaeletronico.id','=',addslashes($id))
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' , 'fornecedor.nome as fornecedor' )
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
        ->join('mateletronico_pessoal','mateletronico_pessoal.material_id','=','materiaeletronico.id')
        ->join('pessoal','pessoal.id','=','mateletronico_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materiaeletronico.tipoaquisicao_id')
        ->join('fornecedor','fornecedor.id','=','materiaeletronico.fornecedor_id')
       
        ->where('mateletronico_pessoal.estado','=','ativo')
        ->select('materiaeletronico.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' , 'fornecedor.nome as fornecedor' )
        ->get();

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

        /*/  */
        $m=MatEletronico_pessoal::where('estado', 'ativo')->where('material_id', $request->material_id)->first();
        $s=['estado'=>'cessado'];
        MatEletronico_pessoal::findOrFail($m->id)->update($s);

     //salvando o historico da atribuição do material ao pessoal
        $matp=new MatEletronico_pessoal();
        $matp->pessoal_id=$request->pessoal_id;
        $matp->material_id=$request->material_id;
        $matp->estado='ativo';
        $matp->save();

        /** */
         $dep=Departamento::all();
         $pessoal=Pessoal::all();
         
         return view('material_eletronico.consultar',['mat'=>$this->material_eletronicos(),'dep'=>$dep,'sms'=>'Móvel transferido com sucesso','pesssoal'=>$pessoal]);
     }



     public function movel_vencido($id)
     {
         $mat=$this->material_eletronico(addslashes($id));
         $id_notificacao=$this->notificacaoByMovel($id)->id;
         $notificacao=Notificacao::findOrFail( $id_notificacao);
         $s=['estado'=>'visto'];
         $notificacao->update($s);
         return view('material_eletronico.materialExpirado',['mat'=> $mat]);
 
    }


    public function inserirNotificao($id)
    {
        $n=new Notificacao();
        $n->materiaeletronico_id=addslashes($id);
        $n->descricao="O tempo de vida útil para este Móvel terminou";
        $n->estado="não visto";
        $n->save();
        return true;
    }

    public function diasEmAno($anos, $dias)
    {
        $result=$dias/365;
        return $result;

    }

    public function MaterialNotificado($id)
    {
            $p=DB::table('_notificacao_mat_eletronico')
            ->join('materiaeletronico','materiaeletronico.id','=','_notificacao_mat_eletronico.materiaeletronico_id')
            ->where('materiaeletronico.id','=',$id)
            ->select('_notificacao_mat_eletronico.*')
            ->get();

            if( $p->count()>0)
            {
                return true;
            }

            return false;
    
         
    }

    public function notificacaoByMovel($id)
    {
        $p=DB::table('_notificacao_mat_eletronico')
        ->join('materiaeletronico','materiaeletronico.id','=','_notificacao_mat_eletronico.materiaeletronico_id')
        ->where('materiaeletronico.id','=',$id)
        ->select('_notificacao_mat_eletronico.*')
        ->get();

            return  $p->first();      
    }


    public function Notificacoes()
    {
            $p=DB::table('_notificacao_mat_eletronico')
            ->join('materiaeletronico','materiaeletronico.id','=','_notificacao_mat_eletronico.materiaeletronico_id')
            ->where('_notificacao_mat_eletronico.estado','=','não visto')
            ->select('_notificacao_mat_eletronico.*')
            ->get();

            return $p;
    }


    public function calcularData()
        {
            $mat=MaterialElectronico::all();
           // $v=Veiculo::findOrFail(8);
            foreach($mat as $m)
            {
                $dataAquisicao = $m->dataAquisicao;
                $hoje=new DateTime();
                $dateaquisicao=new DateTime($m->data_aquisicao);
                $diferenca=$hoje->diff($dateaquisicao);
                $vida_util=$m->vida_util;
                $dif_em_ano=$this->diasEmAno($vida_util, $diferenca->days);
                
                if(!$this->MaterialNotificado($m->id))
                {
                   
                    if($dif_em_ano-$vida_util>=0)
                    {
                        $this->inserirNotificao($m->id);

                    }

                }
            }   
        }


        public function historicoAtribuicoes($id)
        {   
           $mat=DB::table('mateletronico_pessoal')
           ->join('pessoal','pessoal.id','=','mateletronico_pessoal.pessoal_id')
           ->join('departamentos','departamentos.id','=','pessoal.departamento_id')
           ->where('mateletronico_pessoal.material_id','=',addslashes($id))
           ->select('mateletronico_pessoal.*','pessoal.nome as pessoal','mateletronico_pessoal.created_at as dataregisto','departamentos.descricao as departamento','pessoal.funcao')
           ->orderBy('created_at', 'asc')
           ->get();
   
           return view('material_eletronico.detalhes',['mat'=>$mat]);
   
   
        }

        public function historicoDepreciacao($id)
        {
 
            $dep=DB::table('depreciacao__mat__eletronico')
            ->join('materiaeletronico','materiaeletronico.id','=','depreciacao__mat__eletronico.material_id')
            ->where('materiaeletronico.id','=',$id)
            ->select('depreciacao__mat__eletronico.*','materiaeletronico.valor_aquisicao as valoraquisicao','materiaeletronico.valor_residual as valorresidual','materiaeletronico.vida_util as vidautil','materiaeletronico.data_utilizacao as datainicio','materiaeletronico.num_mobilizado as numeroimovel') 
            ->get();
            $dados= $dep->first();
     
            $h=new Helper();
            $vidautilRestante=$h->calcularVidaUtilRestante($dados-> datainicio, $dados->vidautil);
            $dado=$h->calcularDepreciacaoAcumuladaEValorContabil($dados->vidautil, $dados-> datainicio, $dados->valorresidual, $dados->dp_anual, $dados->valoraquisicao);


                    
        
            return view('material_eletronico.historicoDepreciacao',['dep'=>$dep,'vidautilRestante'=>$vidautilRestante,'dado'=>$dado]);
    
        }




}



