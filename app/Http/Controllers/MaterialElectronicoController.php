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
use App\Models\NotificacaoMat_eletronico as Notificacao;
use DateTime;



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
        $not_mat_eletronico=$this->Notificacoes();
        $total_notificao=$not_mat_eletronico->count();
        $dep=Departamento::all();
        return view('material_eletronico.consultar',['mat'=>$this->material_eletronicos(),'dep'=>$dep,'not_mat_eletronico'=>$not_mat_eletronico,'total_notificao_eletronico'=> $total_notificao]);
        
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
        $m->vida_util=addslashes($request->vidautil);
        
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
            'custo_aquisicao_euro'=>$Custo_aquisição_euro,
            'vida_util'=>addslashes($request->vidautil),
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


        




}



