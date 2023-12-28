<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\fornecedorMovelController;
use App\Http\Controllers\TipoAquisicao;
use App\Http\Controllers\ResidenciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TerrenoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\MaterialEscritorio;
use App\Http\Controllers\OcorrenciaVeiculo;
use App\Http\Controllers\MaterialElectronicoController;
use App\Http\Controllers\MotivoAbateController;
use App\Http\Controllers\OcorrenciaEletronico;
use App\Http\Controllers\AbateVeiculo;
use App\Http\Controllers\AbateController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('auth.login');
    return view('login.login');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['CheckAdmin','auth'])->group(function () {
    //users
      //users
    Route::get('user/create', [ UserController ::class,'create']);
    Route::post('user/registar', [ UserController ::class,'store']);
    Route::get('user/consultar', [ UserController ::class,'index']);
    Route::get('user/editar/{id}', [ UserController ::class,'edit']);
    Route::put('user/editar/salvar', [ UserController ::class,'update']);
    Route::get('user/pesquisar', [UserController::class,'pesquisar']);
    Route::put('user/bloquear', [UserController::class,'bloquear']);
    Route::put('user/desbloquear', [UserController::class,'desbloquear']);

    //departamento
    Route::get('/departamento', [DepController::class,'create']);
    Route::get('/departamento/consultar', [DepController::class,'all']);
    Route::post('departamento/registar', [DepController::class,'store']);
    Route::get('departamento/editar/{id}', [DepController::class,'edit']);
    Route::put('departamento/update', [DepController::class,'update']);
    Route::get('departamento/pesquisar', [DepController::class,'pesquisar']);

    //fornecedor
Route::get('imoveis/fornecedorMovel/create', [fornecedorMovelController::class,'create']);
Route::get('fornecedor/consultar', [fornecedorMovelController::class,'index']);
Route::post('fornecedor/registar', [fornecedorMovelController::class,'store']);
Route::get('fornecedor/editar/{id}', [fornecedorMovelController::class,'edit']);
Route::put('fornecedor/editar/salvar', [fornecedorMovelController::class,'update']);
Route::get('fornecedor/pesquisar', [fornecedorMovelController::class,'pesquisar']);
//tipo aquisição
Route::get('tipoaquisicao/create', [TipoAquisicao::class,'create']);
Route::post('tipoaquisicao/registar', [TipoAquisicao::class,'store']);
Route::get('tipoaquisicao/consultar', [TipoAquisicao::class,'index']);
Route::get('tipoaquisicao/editar/{id}', [TipoAquisicao::class,'edit']);
Route::put('tipoaquisicao/update', [TipoAquisicao::class,'update']);
Route::get('tipoaquisicao/pesquisar', [TipoAquisicao::class,'pesquisar']);

//motivos abates
Route::get('motivo-abate/create', [MotivoAbateController::class,'create']);
Route::post('motivo-abate/salvar', [MotivoAbateController::class,'store']);
Route::get('motivo-abate/consultar', [MotivoAbateController::class,'index']);
Route::get('motivo-abate/editar/{id}', [MotivoAbateController::class,'edit']);
Route::put('motivo-abate/update', [MotivoAbateController::class,'update']);
Route::get('motivo-abate/pesquisar', [MotivoAbateController::class,'pesquisar']);

});


Route::middleware(['CheckGestVeiculo','auth'])->group(function () {
   //veiculos
Route::get('veiculo/create', [VeiculoController::class,'create']);
Route::post('veiculo/registar', [VeiculoController::class,'store']);
Route::get('veiculo/consultar', [VeiculoController::class,'index']);
Route::get('veiculo/editar/{id}', [VeiculoController::class,'editar']);
Route::put('veiculo/update', [VeiculoController::class,'update']);
Route::get('veiculo/pesquisar', [VeiculoController::class,'pesquisar']);
Route::get('veiculo/comprovativo/{id}', [VeiculoController::class,'comprovativo']);
Route::put('veiculo/transferir', [VeiculoController::class,'transferir']);

//ocorrencias de veiculos
Route::post('veiculo-ocorrencia/registar', [OcorrenciaVeiculo::class,'store']);
Route::get('historico-ocorrencia-veiculo/{id}', [OcorrenciaVeiculo::class,'index']);
Route::get('historico-ocorrencia-veiculo/editar/{id}', [OcorrenciaVeiculo::class,'edit']);
Route::put('historico-ocorrencia-veiculo/update', [OcorrenciaVeiculo::class,'update']);

Route::get('/testepdf', function () {
    //return view('auth.login');
    return view('relatorios.teste');
});

});

Route::middleware(['CheckGestImovel ','auth'])->group(function () {
    //terreno
Route::get('/terreno', [TerrenoController::class,'create']);
Route::post('imoveis/terreno/registar', [TerrenoController::class,'store']);
Route::get('imoveis/terreno/consultar', [TerrenoController::class,'index']);
Route::get('imoveis/terreno/editar/{id}', [TerrenoController::class,'edit']);
Route::put('imoveis/terreno/update', [TerrenoController::class,'update']);
Route::get('terreno/comprovativo/{id}', [TerrenoController::class,'comprovativo']);
Route::get('imoveis/terreno/pesquisar', [TerrenoController::class,'pesquisar']);

//residencia
Route::get('residencia/create', [ResidenciaController::class,'create']);
Route::get('residencia/listar', [ResidenciaController::class,'index'])->name('residencia.listar');
Route::post('imoveis/residencia/registar', [ResidenciaController::class,'store'])->name('residencia.registar');
Route::get('residencia/editar/{id}', [ResidenciaController::class,'edit']);
Route::put('residencia/update', [ResidenciaController::class,'update']);
Route::get('residencia/pesquisar', [ResidenciaController::class,'pesquisar']);
Route::get('imoveis/residencia/comprovativo/{id}', [ResidenciaController::class,'comprovativo']);

//Edifício
Route::get('imoveis/edificio/create', [EdificioController::class,'create']);
Route::get('imoveis/edificio/consultar', [EdificioController::class,'index']);
Route::post('imoveis/edificio/registar', [EdificioController::class,'store']);
Route::get('imoveis/edificio/editar/{id}', [EdificioController::class,'edit']);
Route::put('imoveis/edificio/update', [EdificioController::class,'update']);
Route::get('imoveis/edificio/pesquisar', [EdificioController::class,'pesquisar']);
Route::get('imoveis/edificio/comprovativo/{id}', [EdificioController::class,'comprovativo']);
});

Route::get('user/perfil', [UserController::class,'perfil'])->middleware('auth');
Route::post('user/perfil/alterar-foto', [UserController::class,'alterarFoto'])->middleware('auth');

//login
Route::post('/login', [AuthenticatedSessionController::class,'store']);


Route::middleware(['CheckGestImovel ','auth'])->group(function () {
//Material escritório
Route::get('material-escritorio/create', [MaterialEscritorio::class,'create']);
Route::post('material-escritorio/registar', [MaterialEscritorio::class,'store']);
Route::get('material-escritorio/consultar', [MaterialEscritorio::class,'index']);
Route::get('material-escritorio/editar/{id}', [MaterialEscritorio::class,'edit']);
Route::put('material-escritorio/update', [MaterialEscritorio::class,'update']);
Route::get('material-escritorio/pesquisar', [MaterialEscritorio::class,'pesquisar']);
Route::get('material-escritorio/comprovativo/{id}', [MaterialEscritorio::class,'comprovativo']);

//material electronico
Route::get('material-electronico/registar', [MaterialElectronicoController ::class,'create'])->name('material-eletronico.registar');
Route::post('material-electronico/salvar', [MaterialElectronicoController ::class,'store'])->name('material-eletronico.salvar');
Route::get('material-electronico/consultar', [MaterialElectronicoController ::class,'index'])->name('material-eletronico.consultar');
Route::get('material-electronico/editar/{id}', [MaterialElectronicoController ::class,'edit'])->name('material-eletronico.editar');
Route::put('material-electronico/update', [MaterialElectronicoController ::class,'update'])->name('material-eletronico.update');

Route::post('ocorrencia-electronico/registar', [OcorrenciaEletronico ::class,'store'])->name('ocorrencia-eletronico.registar');
Route::get('historico-ocorrencia-materia/listar/{id}', [OcorrenciaEletronico ::class,'index'])->name('ocorrencia-eletronico.listar');
Route::get('historico-ocorrencia-materia/editar/{id}', [OcorrenciaEletronico ::class,'edit'])->name('ocorrencia-eletronico.editar');
Route::put('historico-ocorrencia-materia/update', [OcorrenciaEletronico::class,'update'])->name('ocorrencia-eletronico.update');
Route::get('material-electronico/comprovativo/{id}', [MaterialElectronicoController::class,'comprovativo']);


});


Route::middleware(['CheckDirector','auth'])->group(function () {
//abates
Route::get('abate/veiculos/consultar', [VeiculoController::class,'consultarVeiculo']);
Route::get('abate/veiculos/pesquisar', [VeiculoController::class,'pesquisarVeiculos']);
Route::post('abate/veiculos/registar', [AbateVeiculo::class,'registarAbate']);
//abates material escritorio
Route::get('abate/MaterialEscritorio/consultar', [MaterialEscritorio::class,'consultarMaterial']);
Route::post('abate/MaterialEscritorio/registar', [ AbateController::class,'abateMatEscritorio']);
//abates material eletronico
Route::get('abate/MaterialEletronico/consultar', [MaterialElectronicoController::class,'consultar']);
Route::post('abate/MaterialEletronico/registar', [ AbateController::class,'abateMatElectronico']);
//abates edificios
Route::get('abate/edificio/consultar', [EdificioController::class,'consultar']);
Route::post('abate/edificio/registar', [ AbateController::class,'AbateEdificio']);
//abates terrenos
Route::get('abate/terrenos/consultar', [TerrenoController::class,'consultar']);
Route::post('abate/terrenos/registar', [ AbateController::class,'AbateTerreno']);
//residencia
Route::get('abate/residencia/consultar', [ResidenciaController::class,'consultar']);
Route::post('abate/residencia/registar', [AbateController::class,'AbateResidencia']);

});

//Route::middleware(['TecVeiculo','auth'])->group(function () {
//area técnica veiculo
Route::get('tecnica/veiculo/ocorrencia', [OcorrenciaVeiculo::class,'listarOcorrencias']);
Route::get('tecnica/veiculo/diagnosticar/{id}', [OcorrenciaVeiculo::class,'diagnosticar']);
Route::get('tecnica/veiculo/resolver/{id}', [OcorrenciaVeiculo::class,'resolver']);
Route::put('tecnica/veiculo/concluir', [OcorrenciaVeiculo::class,'concluir']);
Route::get('tecnica/veiculo/informacao/{id}', [OcorrenciaVeiculo::class,'informacao']);
//});


Route::middleware(['CheckTecMovel','auth'])->group(function () {
//area técnica movel
Route::get('tecnica/movel/ocorrencia', [OcorrenciaEletronico::class,'listarOcorrencias']);
Route::get('tecnica/movel/diagnosticar/{id}', [OcorrenciaEletronico::class,'diagnosticar']);
Route::get('tecnica/movel/resolver/{id}', [OcorrenciaEletronico::class,'resolver']);
Route::put('tecnica/movel/concluir', [OcorrenciaEletronico::class,'concluir']);
Route::get('tecnica/movel/informacao/{id}', [OcorrenciaEletronico::class,'informacao']);
});






//pdf
Route::get('/teste/pdf', [testePdfController::class,'teste']);

