<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAquisicaoModel;
use App\Models\Departamento;
use App\Models\Veiculo;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MotivoAbate;


class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function veiculos(){

        $p=DB::table('veiculos')
        ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
       
         ->where('veiculos.estado','=','ativo')
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
        ->get();
       

        return $p;

     }


    public function index()
    {
        
        $ve=$this->veiculos();
        return view('veiculo.consultar',['ve'=>$ve]);

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
        return view('veiculo.index',['tipo'=>$t, 'dep'=>$dep]);
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
       $nome_seguradora=""; $cobertura=null;$apolice=null; $datainicio=null; $datafim=null;
       if(!is_null($request->cobertura))
       {
        $cobertura=addslashes($request->cobertura);

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
      
        $v->nome_segurador= $nome_seguradora;
        $v->cobertura=$cobertura;
        $v->valor_seguro=$valor_seguro;
        $v->apolice=$apolice;
        $v->data_inicio= $datainicio;
        $v->data_fim=$datafim;
        $v->departamento_id=addslashes($request->departamento);
        $v->estado='ativo';
        $v->save();
        $dep=Departamento::all();
        $t= TipoAquisicaoModel::all();
        return view('veiculo.index',['sms'=>'Veículo registada com sucesso', 'dep'=>$dep,'tipo'=>$t]);

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
       $nome_seguradora=""; $cobertura=null;$apolice=null; $datainicio=null; $datafim=null;

       if(!is_null($request->cobertura))
       {
        $cobertura=addslashes($request->cobertura);

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
            'cobertura'=>$cobertura,
            'valor_seguro'=>$valor_seguro,
            'apolice'=>$apolice,
            'data_inicio'=>$datainicio,
            'data_fim'=> $request->datafim,
            'departamento_id'=>addslashes($request->departamento),
        ];

        $v=Veiculo::findOrFail(addslashes($request->id));
        $v->update($s);
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
        $p=$this->veiculo($id);
       
        if($p->count()>0)
        {
            $dep=Departamento::all();
            $t= TipoAquisicaoModel::all();
            return view('veiculo.editar',['v'=>$p->first(),'tipo'=>$t, 'dep'=>$dep]);

        }

       
        
    }


    public function veiculo($id)
    {
        $p=DB::table('veiculos')
        ->join('departamentos','departamentos.id','=','veiculos.departamento_id')
        ->join('tipoaquisicao','tipoaquisicao.id','=','veiculos.tipo_aquisicao')
        ->where('veiculos.id','=',addslashes($id))
        ->select('veiculos.*','tipoaquisicao.descricao as tipoaquisicao_desc','departamentos.descricao as departamentos' )
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


    
    

    }


    

