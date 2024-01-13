<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnderecoModel;
use App\Models\Residencia;
use Illuminate\Support\Facades\DB;
use App\Models\TipoAquisicaoModel;
use App\Http\Controllers\HelperController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MotivoAbate;
use App\Models\NotificacaoResidencia as Notificacao;
use DateTime;


class ResidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct() {
        $this->calcularData();
    }

     public function residencias()
     {
        $p=DB::table('residencia')
        ->join('endereco','endereco.id','=','residencia.endereco_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','residencia.tipo_aquisicao')
        ->where('residencia.estado','=','ativo')
        ->select('residencia.*','endereco.*','tipoaquisicao.descricao as tipo_desc','residencia.id as codigo')
        ->get();

        return $p;
     }

     public function residenciasConsultar()
     {
        $p=DB::table('residencia')
        ->join('endereco','endereco.id','=','residencia.endereco_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','residencia.tipo_aquisicao')
        ->select('residencia.*','endereco.*','tipoaquisicao.descricao as tipo_desc','residencia.id as codigo')
        ->paginate(5);

        return $p;
     }

     public function residencia($id)
     {
        $p=DB::table('residencia')
        ->join('endereco','endereco.id','=','residencia.endereco_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','residencia.tipo_aquisicao')
       ->where('residencia.id','=',addslashes($id))
        ->select('residencia.*','endereco.*','residencia.id as codigo','residencia.descricao as desc','tipoaquisicao.descricao as tipo_desc')
        ->get();

        return $p;
     }


     public function residenciaByNumImobilizado($num)
     {
        $p=DB::table('residencia')
        ->join('endereco','endereco.id','=','residencia.endereco_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','residencia.tipo_aquisicao')
       ->where('residencia.num_imobilizado','=',addslashes($num))
       ->where('residencia.estado','=','ativo')
        ->select('residencia.*','endereco.*','tipoaquisicao.descricao as tipo_desc','residencia.id as codigo')
        ->get();

        return $p;
     }

    public function index()
    {
        $not_residencia=$this->Notificacoes();
        $total_notificao_residencia=$not_residencia->count();

        $p=$this->residencias();
         return view('residencia.consultar',['res'=>$p,'not_residencia'=>$not_residencia, 'total_notificao_residencia'=>$total_notificao_residencia]);

    }

    public function showFrom()
    {
        return view('residencia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $t= TipoAquisicaoModel::all();
        return view('residencia.index',['tipo'=>$t]);
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
        $r=new Residencia();

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
        $r->num_imobilizado=addslashes($request->numimobilizado);
        $r->descricao=addslashes($request->descricao);
        $r->valor_aquisicao=$valoraquisicao;
        $r->custo_aquisicao_usd=$Custo_aquisiçao_usd;
        $r->custo_aquisicao_euro=$Custo_aquisiçao_euro;
        $r->finalidade=addslashes($request->finalidade);
        $r->tipo_aquisicao=addslashes($request->tipoaquisicao);
        $r->data_aquisicao=addslashes($request->dataaquisicao);
        $r->dimensao=addslashes($request->dimensao);
        $r->num_compartimento=addslashes($request->numcompartimento);
        $r->endereco_id=addslashes($e->id);
        $r->estado='ativo';
        $r->vida_util=addslashes($request->vidautil);
        $r->save();

        return view('residencia.index',['sms'=>'Residencia registada com sucesso']);




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
        $r=$this->residencia($id);
        $t= TipoAquisicaoModel::all();
      
        if($r->count()>0)
        {
            return view('residencia.editar',['r'=> $r->first(),'tipo'=>$t]);
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
        $res=Residencia::findOrFail(addslashes($request->id));;
        $aux_res=[
            'num_imobilizado'=>addslashes($request->numimobilizado),
            'descricao'=>addslashes($request->descricao),
            'valor_aquisicao'=>$valoraquisicao,
            'custo_aquisicao_usd'=>$Custo_aquisiçao_usd,
            'custo_aquisicao_euro'=>$Custo_aquisiçao_euro,
            'finalidade'=>addslashes($request->finalidade),
            'tipo_aquisicao'=>addslashes($request->tipoaquisicao),
            'data_aquisicao'=>addslashes($request->dataaquisicao),
            'dimensao'=>addslashes($request->dimensao),
            'num_compartimento'=>addslashes($request->numcompartimento),
            'endereco_id'=>addslashes($e->id),
            'vida_util'=>addslashes($request->vidautil),
        ];
        $res->update($aux_res);

        $p=$this->residencias();

         return view('residencia.consultar',['res'=>$p,'sms'=>'Registo alterado com sucesso']);



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
       
        $res=$this->residenciaByNumImobilizado($request->num_mobilizado);
     
        if($res->count()>0)
        {
            return view('residencia.consultar',['res'=>$res]);
        }

       

        return view('residencia.consultar',['erro'=> 'registo não encontrado']);


    }


    public function comprovativo($id)
    {


         $p=$this->residencia(addslashes($id));
         PDF::setOption(['isRemoteEnabled' => true]);
        // dd($p->first());
         $pdf=PDF::loadView('relatorios.comprovativo-residencia',['v'=>$p->first()]);
         return $pdf->setPaper('a4')->stream('teste.pdf');

    }


    public function consultar()
    {
        $res=$this->residenciasConsultar();
        $abate=MotivoAbate::all();
        return view('abates.residencia',['abates'=>$abate,'res'=>$res]);
    }


    public function Residencia_vencida($id)
    {
        $re=$this->residencia(addslashes($id));
      
       
        $id_notificacao=$this->notificacaoByResidencia($id)->id;
        $notificacao=Notificacao::findOrFail( $id_notificacao);
        $s=['estado'=>'visto'];
        $notificacao->update($s);
        return view('residencia.residenciaExpirado',['ve'=> $re]);

    }

    public function inserirNotificao($id)
    {
        $n=new Notificacao();
        $n->residencia_id=$id;
        $n->descricao="O tempo de vida útil para esta Residencia terminou";
        $n->estado="não visto";
        $n->save();
        return true;
    }


    public function diasEmAno($anos, $dias)
    {
        $result=$dias/365;
        return $result;

    }

    public function ResidenciaNotificado($id)
    {
            $p=DB::table('_notificacao_residencia')
            ->join('residencia','residencia.id','=','_notificacao_residencia.residencia_id')
            ->where('_notificacao_residencia.id','=',$id)
            ->select('_notificacao_residencia.*')
            ->get();

            if( $p->count()>0)
            {
                return true;
            }

            return false;
    
         
    }

    public function notificacaoByResidencia($id)
    {
        $p=DB::table('_notificacao_residencia')
            ->join('residencia','residencia.id','=','_notificacao_residencia.residencia_id')
            ->where('_notificacao_residencia.id','=',$id)
            ->select('_notificacao_residencia.*')
            ->get();
            return  $p->first();      
    }


    public function Notificacoes()
    {

        $p=DB::table('_notificacao_residencia')
            ->join('residencia','residencia.id','=','_notificacao_residencia.residencia_id')
            ->where('_notificacao_residencia.estado','=','não visto')
            ->select('_notificacao_residencia.*')
            ->get();
            return $p;
    }


    public function calcularData()
    {
        $te=Residencia::all();
       // $v=Veiculo::findOrFail(8);
        foreach($te as $t)
        {
            $dataAquisicao = $t->dataAquisicao;
            $hoje=new DateTime();
            $dateaquisicao=new DateTime($t->data_aquisicao);
            $diferenca=$hoje->diff($dateaquisicao);
            $vida_util=$t->vida_util;
            $dif_em_ano=$this->diasEmAno($vida_util, $diferenca->days);
            
            if(!$this->ResidenciaNotificado($t->id))
            {
               
                if($dif_em_ano-$vida_util>=0)
                {
                    $this->inserirNotificao($t->id);

                }

            }
        }   
    }


}
