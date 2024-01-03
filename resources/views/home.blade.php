@extends('layout.template')
@section('title', 'Gestão de Património ENDE-Imóvel')


@section('content')
<div class="row">
    <h2>Bem-Vindo</h2>
</div>
<div class="row">
    @can('gestor imovel')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco"> Imóveis</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

    @can('gestor movel')
   
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <a class="" data-target="#submenu-2" aria-controls="submenu-2" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Móveis</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

    @can('gestor de veiculo')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a data-target="#submenu-3" aria-controls="submenu-3" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Veículos</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

    @can('admin')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Configurações</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

</div>


<div class="row">
    
   
   @can('técnico veículo')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a class="" data-target="#submenu-2" aria-controls="submenu-2" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Tecníco veículo</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan

    @can('técnico movel')
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">

        <a  data-target="#submenu-3" aria-controls="submenu-3" data-toggle="collapse" aria-expanded="false">
            <div class="card cor_template">
                <div class="card-body">
                    <h5 class="text-muted text-center texto_branco">Tecníco Móveis</h5>
                </div>
            </div>
        </a> 
    </div>
    @endcan
   
   

</div>

@endsection