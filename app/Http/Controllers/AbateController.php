<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbateMatEletronico;
use App\Models\AbateMatEscritorio;
use App\Http\Controllers\MaterialElectronicoController;
use App\Http\Controllers\MaterialEscritorio;
use App\Http\Controllers\HelperController;
use App\Models\MaterialEscritorioModel;
use App\Models\MotivoAbate;
use App\Models\MaterialElectronico;
use App\Models\AbateEdificio;
use App\Models\Edificio;
use App\Http\Controllers\EdificioController;
use App\Models\Terreno;
use App\Http\Controllers\TerrenoController;
use App\Models\AbateTerreno;
use App\Http\Controllers\ResidenciaController;
use App\Models\AbateResidencia;
use App\Models\Residencia;
use Illuminate\Support\Facades\DB;

class AbateController extends Controller
{
    

    public function abateMatEscritorio(Request $request)
    {
        $abate=new AbateMatEscritorio();
        $matController=new MaterialEscritorio();
        $h=new HelperController();
        
        $abate->materialescitorio_id=$h->clear($request->id_material);
        $abate->motivoAbate_id=$h->clear($request->abate);
        $abate->dataAbate=date('y-m-d');
        $abate->save();

        $s=['estado'=>addslashes('abatido') ];
        $mat=MaterialEscritorioModel::findOrFail(addslashes($h->clear($request->id_material)));
        $mat->update($s);

      
        $materiaescritorios=$matController-> material_escritoriosConsultar();
        
        $abate=MotivoAbate::all();
    

        return view('abates.materialEscritorio',['mat'=>$materiaescritorios,'abates'=>$abate,'sms'=>'abate registado com sucesso']);

    }



    public function abateMatElectronico(Request $request)
    {
        $abate=new  AbateMatEletronico();
        $matController=new MaterialElectronicoController();
        $h=new HelperController();
       // dd($h->clear($request->id_materiald));
        $abate->materialeletronico_id=$h->clear($request->id_material);
        $abate->motivoAbate_id=$h->clear($request->abate);
        $abate->dataAbate=date('y-m-d');
        $abate->save();

        $s=['estado'=>addslashes('abatido') ];
        $mat=MaterialElectronico::findOrFail(addslashes($h->clear($request->id_material)));
        $mat->update($s);

      
        $mateletronico=$matController->material_eletronicosConsultar();
        
        $abate=MotivoAbate::all();
    

        return view('abates.materialeletronico',['mat'=>$mateletronico,'abates'=>$abate,'sms'=>'abate registado com sucesso']);

    }
    
    public function AbateEdificio(Request $request)
    {

        $abate=new AbateEdificio();
        $edController=new EdificioController();
        $h=new HelperController();
        //dd($request->edificio_id);
       // dd($h->clear($request->id_materiald));
        $abate->edificio_id=$h->clear($request->edificio_id);
        $abate->motivoAbate_id=$h->clear($request->abate);
        $abate->dataAbate=date('y-m-d');
        $abate->save();

        $s=['estado'=>addslashes('abatido') ];
        $ed=Edificio::findOrFail(addslashes($h->clear($request->edificio_id)));
        $ed->update($s);

      
        $edificios= $edController->edificiosConsultar();
        
        $abate=MotivoAbate::all();
    

        return view('abates.edificio',['edificio'=>$edificios,'abates'=>$abate,'sms'=>'abate registado com sucesso']);

    }


    public function AbateTerreno(Request $request)
    {
        $abate=new AbateTerreno();
        $teController=new TerrenoController();
        $h=new HelperController();
        //dd($request->edificio_id);
       // dd($h->clear($request->id_materiald));
        $abate->terreno_id=$h->clear($request->terreno_id);
        $abate->motivoAbate_id=$h->clear($request->abate);
        $abate->dataAbate=date('y-m-d');
        $abate->save();

        $s=['estado'=>addslashes('abatido') ];
        $t=Terreno::findOrFail(addslashes($h->clear($request->terreno_id)));
        $t->update($s);

      
        $ter= $teController->terrenosConsultar();
        
        $abate=MotivoAbate::all();
    

        return view('abates.terrenos',['te'=>$ter,'abates'=>$abate,'sms'=>'abate registado com sucesso']);

    }


    public function AbateResidencia(Request $request)
    {
        $abate=new AbateResidencia();
        $resController=new ResidenciaController();
        $h=new HelperController();
        //dd($request->edificio_id);
       // dd($h->clear($request->id_materiald));
        $abate->residencia_id=$h->clear($request->residencia_id);
        $abate->motivoAbate_id=$h->clear($request->abate);
        $abate->dataAbate=date('y-m-d');
        $abate->save();

        $s=['estado'=>addslashes('abatido') ];
        $r=Residencia::findOrFail(addslashes($h->clear($request->residencia_id)));
        $r->update($s);

      
        $res=$resController->residenciasConsultar();
        
        $abate=MotivoAbate::all();
    

        return view('abates.residencia',['res'=>$res,'abates'=>$abate,'sms'=>'abate registado com sucesso']);

    }


    public function informacaoAbateMaterialEletronico($id)
    {
        $p=DB::table('abate_materialeletronico')
        ->join('materiaeletronico','materiaeletronico.id','=','abate_materialeletronico.materialeletronico_id')
        ->join('motivos_abate','motivos_abate.id','=','abate_materialeletronico.motivoAbate_id')
         ->where('materiaeletronico.id','=',addslashes($id))
        ->select('abate_materialeletronico.*','motivos_abate.descricao as motivoAbate')
        ->get();
        return view('abates.informacao',['dados'=>$p]);
   
    }

    public function informacaoAbateMaterialEscritorio($id)
    {
        $p=DB::table('abate_material_escritorio')
        ->join('materialescritorio','materialescritorio.id','=','abate_material_escritorio.materialescitorio_id')
        ->join('motivos_abate','motivos_abate.id','=','abate_material_escritorio.motivoAbate_id')
         ->where('materialescritorio.id','=',addslashes($id))
        ->select('abate_material_escritorio.*','motivos_abate.descricao as motivoAbate')
        ->get();
        return view('abates.informacao',['dados'=>$p]);
   
    }


    public function informacaoAbateEdificio($id)
    {
        $p=DB::table('abate_edificio')
        ->join('edificio','edificio.id','=','abate_edificio.edificio_id')
        ->join('motivos_abate','motivos_abate.id','=','abate_edificio.motivoAbate_id')
         ->where('edificio.id','=',addslashes($id))
        ->select('abate_edificio.*','motivos_abate.descricao as motivoAbate')
        ->get();
        return view('abates.informacao',['dados'=>$p]);
   
    }


    public function informacaoAbateTerreno($id)
    {
        $p=DB::table('abate_terreno')
        ->join('terrenos','terrenos.id','=','abate_terreno.terreno_id')
        ->join('motivos_abate','motivos_abate.id','=','abate_terreno.motivoAbate_id')
         ->where('terrenos.id','=',addslashes($id))
        ->select('abate_terreno.*','motivos_abate.descricao as motivoAbate')
        ->get();
        return view('abates.informacao',['dados'=>$p]);
   
    }


    public function informacaoAbateResidencia($id)
    {
        $p=DB::table('abate_residencia')
        ->join('residencia','residencia.id','=','abate_residencia.residencia_id')
        ->join('motivos_abate','motivos_abate.id','=','abate_residencia.motivoAbate_id')
         ->where('residencia.id','=',addslashes($id))
        ->select('abate_residencia.*','motivos_abate.descricao as motivoAbate')
        ->get();
        return view('abates.informacao',['dados'=>$p]);
   
    }




}
