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
use App\Models\Pessoal;
use App\Models\DepreciacaoMatEscritorio;
use App\Models\matescritorio_pessoal;
use App\Models\NotificacaoMat_Escritorio as Notificacao;
use DateTime;
use App\Http\Controllers\Helper;


class MaterialEscritorio extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct() {
        $this->calcularData();
    }
    
     public function material_escritorios(){

        $p=DB::table('materialescritorio')
        ->join('matescritorio_pessoal','matescritorio_pessoal.material_id','=','materialescritorio.id')
        ->join('pessoal','pessoal.id','=','matescritorio_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->where('materialescritorio.estado','=','ativo')
        ->where('matescritorio_pessoal.estado','=','ativo')
        ->orderBy('materialescritorio.id', 'asc')
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' )
        ->get();

        return $p;

     }

     public function historicoAtribuicoes($id)
     {
        $mat=DB::table('matescritorio_pessoal')
        ->join('pessoal','pessoal.id','=','matescritorio_pessoal.pessoal_id')
        ->join('departamentos','departamentos.id','=','pessoal.departamento_id')
        ->where('matescritorio_pessoal.material_id','=',addslashes($id))
        ->select('matescritorio_pessoal.*','pessoal.nome as pessoal','matescritorio_pessoal.created_at as dataregisto','departamentos.descricao as departamento','pessoal.funcao')
        ->orderBy('created_at', 'asc')
        ->get();

        return view('material_escritorio.detalhes',['mat'=>$mat]);


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
        $not_mat_escritorio=$this->Notificacoes();
        $total_notificao=$not_mat_escritorio->count();
        $pessoal=Pessoal::all();
        
       

        $dep=Departamento::all();
        $material=$this->material_escritorios();

        return view('material_escritorio.consultar',['mat'=>$material,'dep'=> $dep, 'not_mat_escritorio'=>$not_mat_escritorio,'total_notificacao_mat_eletronico'=>$total_notificao,'pessoal'=>$pessoal]);
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
        $pessoal=Pessoal::all();

        
        return view('material_escritorio.index',['dep'=>$dep, 'tipo'=>$t, 'for'=>$fornecedores,'pessoal'=>$pessoal]);
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
        $m->estado='ativo';
        $m->custo_aquisicao_usd=$Custo_aquisição_usd;
        $m->custo_aquisicao_euro= $Custo_aquisição_euro;
        $m->vida_util=addslashes($request->vidautil);
        $m->valor_residual=addslashes($request->vresidual);
        $m->data_utilizacao=addslashes($request->datautilizacao);
        $m->save();

        $matp=new matescritorio_pessoal();
        //salvando o historico da atribuição do material ao pessoal
        $matp->pessoal_id=$request->pessoal;
        $matp->material_id=$m->id;
        $matp->estado='ativo';
        $matp->save();

        $fornecedores=FornecedorMovel::all();
        $pessoal=Pessoal::all();
        $dep=Departamento::all();
        $t=TipoAquisicaoModel::all();
        //dados da depreciação
        $dep=new DepreciacaoMatEscritorio();
      
        $depAnual=($m->valor_aquisicao-$m->valor_residual)/$m->vida_util;
        $dep->material_id=$m->id;
        $dep->dp_anual=$depAnual;
        $dep->save();

        return view('material_escritorio.index',['sms'=>'Material registado com sucesso','dep'=>$dep, 'tipo'=>$t, 'for'=>$fornecedores,'pessoal'=>$pessoal]);

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
        ->join('matescritorio_pessoal','matescritorio_pessoal.material_id','=','materialescritorio.id')
        ->join('pessoal','pessoal.id','=','matescritorio_pessoal.pessoal_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->where('materialescritorio.estado','=','ativo')
        ->where('matescritorio_pessoal.estado','=','ativo')
        ->where('materialescritorio.id','=',addslashes($id))
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','pessoal.nome as pessoal' )
        ->get();



        if($p->count()>0){
            $m=$p->first();
            $dep=Departamento::all();
            $pessoal=Pessoal::all();
            $t=TipoAquisicaoModel::all();
            $fornecedores=FornecedorMovel::all();
            return view('material_escritorio.editar', ["m" =>$m, 'dep'=>$dep, 'tipo'=>$t, 'for'=>$fornecedores,'pessoal'=>$pessoal]);
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
            'custo_aquisicao_usd'=>$Custo_aquisição_usd,
             'custo_aquisicao_euro'=>$Custo_aquisição_euro,
             'vida_util'=>addslashes($request->vidautil),
             'valor_residual'=>addslashes($request->vresidual),
             'data_utilizacao'=>addslashes($request->datautilizacao)
    ];
   
       
    
        $m=MaterialEscritorioModel::findOrFail(addslashes($request->id));
        $m->update($s);

        //

        $mat=matescritorio_pessoal::where('estado', 'ativo')->where('material_id', $m->id)->first();
        $s=['pessoal_id'=>addslashes($request->pessoal)];
        matescritorio_pessoal::findOrFail($mat->id)->update($s);
        //atualizar dados da depreciação
        $dep=new DepreciacaoMatEscritorio();
       
        $dep=DepreciacaoMatEscritorio::where('material_id', $m->id)->first();
        $depAnual=($m->valor_aquisicao-$m->valor_residual)/$m->vida_util;
        $s=['material_id'=>$m->id,
        'dp_anual'=>$depAnual,
        ];

        DepreciacaoMatEscritorio::findOrFail($dep->id)->update($s);
        //carregar os dados actualizados
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
        
        ->join('tipoaquisicao','tipoaquisicao.id','=','materialescritorio.tipo_aquisicao')
        ->join('fornecedor','fornecedor.id','=','materialescritorio.fornecedor_id')
        ->join('matescritorio_pessoal','matescritorio_pessoal.material_id','=','materialescritorio.id')
        ->join('pessoal','pessoal.id','=','matescritorio_pessoal.pessoal_id')
       
        ->where('materialescritorio.estado','=','ativo')
        ->where('matescritorio_pessoal.estado','=','ativo')
       
        ->where('materialescritorio.id','=',addslashes($id))
        ->select('materialescritorio.*','tipoaquisicao.descricao as tipoaquisicao_desc','fornecedor.nome as fornecedor','pessoal.nome as pessoal' )
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

    

    public function transferir(Request $request)
    {
     /** transferir o bem para outra pessoa */
     //alterar o estado do antigo registo
     $m=matescritorio_pessoal::where('estado', 'ativo')->where('material_id', $request->material_id)->first();
     $s=['estado'=>'cessado'];
     matescritorio_pessoal::findOrFail($m->id)->update($s);

     //salvando o historico da atribuição do material ao pessoal
        $matp=new matescritorio_pessoal();
        $matp->pessoal_id=$request->pessoal_id;
        $matp->material_id=$request->material_id;
        $matp->estado='ativo';
        $matp->save();

    
        $pessoal=Pessoal::all();
        $material=$this->material_escritorios();
        return view('material_escritorio.consultar',['mat'=>$material, 'sms'=>'Móvel transferido com sucesso','pessoal'=>$pessoal]);

    }


    public function movel_vencido($id)
    {
        $mat=$this->material_escritorio(addslashes($id));
        $id_notificacao=$this->notificacaoByMovel($id)->id;
        $notificacao=Notificacao::findOrFail( $id_notificacao);
        $s=['estado'=>'visto'];
        $notificacao->update($s);
        return view('material_escritorio.movelExpirado',['mat'=> $mat]);

    }

    public function inserirNotificao($id)
    {
        $n=new Notificacao();
        $n->material_escritorio_id=$id;
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
            $p=DB::table('notificacao_mat_escritorio')
            ->join('materialescritorio','materialescritorio.id','=','notificacao_mat_escritorio.material_escritorio_id')
            ->where('materialescritorio.id','=',$id)
            ->select('notificacao_mat_escritorio.*')
            ->get();

            if( $p->count()>0)
            {
                return true;
            }

            return false;
    
         
    }


    public function notificacaoByMovel($id)
    {
        $p=DB::table('notificacao_mat_escritorio')
        ->join('materialescritorio','materialescritorio.id','=','notificacao_mat_escritorio.material_escritorio_id')
        ->where('materialescritorio.id','=',$id)
        ->select('notificacao_mat_escritorio.*')
        ->get();

            return  $p->first();
    
         
    }


    public function Notificacoes()
        {
                $p=DB::table('notificacao_mat_escritorio')
                ->join('materialescritorio','materialescritorio.id','=','notificacao_mat_escritorio.material_escritorio_id')
                ->where('notificacao_mat_escritorio.estado','=','não visto')
                ->select('notificacao_mat_escritorio.*') 
                ->get() ;
                return $p;
        }


        public function calcularData()
        {
            $mat=MaterialEscritorioModel::all();
            $h=new Helper();
           // $v=Veiculo::findOrFail(8);
            foreach($mat as $m)
            {  
                if(!$this->MaterialNotificado($m->id))
                {
                   if($h->verificarVidaUtilExpirada($m->data_utilizacao, $m->vida_util))
                   {
                    $this->inserirNotificao($m->id);
                   }
                    
                }
            }   
        }


public function historicoDepreciacao($id)
{
    $dep=DB::table('depreciacao__mat__escritorio')
                ->join('materialescritorio','materialescritorio.id','=','depreciacao__mat__escritorio.material_id')
                ->where('materialescritorio.id','=',$id)
                ->select('depreciacao__mat__escritorio.*','materialescritorio.valor_aquisicao as valoraquisicao','materialescritorio.valor_residual as valorresidual','materialescritorio.vida_util as vidautil','materialescritorio.data_utilizacao as datainicio','materialescritorio.num_mobilizado as numeroimovel') 
                ->get();
    $dados= $dep->first();

    $h=new Helper();
    $vidautilRestante=$h->calcularVidaUtilRestante($dados-> datainicio, $dados->vidautil);
    $dado=$h->calcularDepreciacaoAcumuladaEValorContabil($dados->vidautil, $dados-> datainicio, $dados->valorresidual, $dados->dp_anual, $dados->valoraquisicao);


              
   
    return view('material_escritorio.historicoDepreciacao',['dep'=>$dep,'vidautilRestante'=>$vidautilRestante,'dado'=>$dado]);
    
}
        



}
