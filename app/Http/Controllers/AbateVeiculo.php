<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbateVeiculo as AbateModel;
use App\Models\MotivoAbate;
use Illuminate\Support\Facades\DB;
use App\Models\Veiculo;
use App\Http\Controllers\VeiculoController;


class AbateVeiculo extends Controller
{
    


    public function registarAbate(Request $request)
    {
        $abate=new AbateModel();
        $veiculoController=new VeiculoController();

        $abate->veiculo_id=$request->id_veiculo;
        $abate->motivoAbate_id=$request->abate;
        $abate->dataAbate=date('y-m-d');
        $abate->save();

        $s=['estado'=>addslashes('abatido') ];
        $v=Veiculo::findOrFail(addslashes($request->id_veiculo));
        $v->update($s);

        $abate=MotivoAbate::all();
        $ve=$veiculoController->veiculosConsultar();
        return view('abates.veiculos',['ve'=>$ve,'abates'=>$abate,'sms'=>'abate registado com sucesso']);

       
    }

    public function informacaoAbate($id)
    {
        $p=DB::table('abate_veiculo')
        ->join('veiculos','veiculos.id','=','abate_veiculo.veiculo_id')
        ->join('motivos_abate','motivos_abate.id','=','abate_veiculo.motivoAbate_id')
         ->where('veiculos.id','=',addslashes($id))
        ->select('abate_veiculo.*','motivos_abate.descricao as motivoAbate')
        ->get();

        return view('abates.informacao',['dados'=>$p]);
   
    }



}
