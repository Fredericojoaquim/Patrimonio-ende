<!doctype html>
<html lang="en">
 

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <link rel="SHORTCUT ICON" href="{{asset('img/logo.ico')}}">
    <title> @yield('title') </title>

</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="#"> <img class="logo" src="{{asset('img/logo.png')}}" alt=""> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                  
         
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i>
                                 @if(isset($total_notificacao) && $total_notificacao!=0 )

                                 {{$total_notificacao}}
                                
                                @endif


                                @if(isset($total_notificacao_mat_eletronico) && $total_notificacao_mat_eletronico!=0 )

                                 {{$total_notificacao_mat_eletronico}}
                                
                                @endif

                                @if(isset($total_notificao_eletronico) && $total_notificao_eletronico!=0 )

                                {{$total_notificao_eletronico}}
                               
                               @endif

                               @if(isset($total_notificao_terreno) && $total_notificao_terreno!=0 )

                               {{$total_notificao_terreno}}
                              
                              @endif
                            <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            @if(isset($not_veiculo))
                                                @foreach($not_veiculo as $n)

                                                <a href="{{url("veiculo/vida-util-vencido/$n->veiculo_id")}}" class="list-group-item list-group-item-action active">
                                                    <div class="notification-info">
                                                        <div class="notification-list-user-img"><img src="{{asset('assets/images/avatar-2.jpg')}}" alt="" class="user-avatar-md rounded-circle"></div>
                                                        <div class="notification-list-user-block"><span class="notification-list-user-name">Vida útil expirado</span>{{$n->descricao}}. Clique aqui para ver detalhes
                                                            <div class="notification-date">2 min ago</div>
                                                        </div>
                                                    </div>
                                                </a>
                                                    
                                                @endforeach
                                                
                                            @endif



                                            @if(isset($not_mat_escritorio))
                                            @foreach($not_mat_escritorio as $n)
                                           

                                            <a href="{{url("material-escritorio/vida-util-vencido/$n->material_escritorio_id")}}" class="list-group-item list-group-item-action active">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="{{asset('assets/images/avatar-2.jpg')}}" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Vida útil expirado</span>{{$n->descricao}}. Clique aqui para ver detalhes
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                                
                                            @endforeach
                                            
                                        @endif


                                        @if(isset($not_mat_eletronico))
                                        @foreach($not_mat_eletronico as $n)
                                       

                                        <a href="{{url("material-electronico/movel-vencido/$n->materiaeletronico_id")}}" class="list-group-item list-group-item-action active">
                                            <div class="notification-info">
                                                <div class="notification-list-user-img"><img src="{{asset('assets/images/avatar-2.jpg')}}" alt="" class="user-avatar-md rounded-circle"></div>
                                                <div class="notification-list-user-block"><span class="notification-list-user-name">Vida útil expirado</span>{{$n->descricao}}. Clique aqui para ver detalhes
                                                    <div class="notification-date">2 min ago</div>
                                                </div>
                                            </div>
                                        </a>
                                            
                                        @endforeach
                                        
                                    @endif


                                    @if(isset($not_terrenos))
                                    @foreach($not_terrenos as $n)
                                   

                                    <a href="{{url("terreno/terreno-vencido/$n->terreno_id")}}" class="list-group-item list-group-item-action active">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="{{asset('assets/images/avatar-2.jpg')}}" alt="" class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span class="notification-list-user-name">Vida útil expirado</span>{{$n->descricao}}. Clique aqui para ver detalhes
                                                <div class="notification-date">2 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                        
                                    @endforeach
                                    
                                @endif

  
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">View all notifications</a></div>
                                </li>
                            </ul>
                        </li>
                     
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(empty(Auth::user()->img))
                                <img src="{{asset('img/images.jpg')}}" alt="" class="user-avatar-md rounded-circle">
                                @else

                                    @if(isset($file))
                                    <img src="{{asset('img/'.$file)}}" alt="" class="user-avatar-md rounded-circle">  
                                    @else
                                    <img src="{{asset('img/'.Auth::user()->img)}}" alt="" class="user-avatar-md rounded-circle">
                                    @endif

                                @endif 
                               
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{Auth::user()->name}} </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="{{url('user/perfil')}}"><i class="fas fa-user mr-2"></i>Minha Conta</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                @auth
                                   <form action="/logout" method="POST">
                                        @csrf
                                        <a class="dropdown-item" a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                   </form>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->

        
        <div class="nav-left-sidebar sidebar-dark divscrool" >
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1_" aria-controls="submenu-1_"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                                <div id="submenu-1_" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('/dashboard')}}">Home</a>
                                        </li>
                                    </ul>
                                </div>  
                            </li>
                            
                          @can('gestor imovel')
                            
                          
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-f fa-home"></i>Gerir Imóveis</a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
           
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1_2" aria-controls="submenu-1_2">Terreno</a>
                                            <div id="submenu-1_2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('/terreno')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('imoveis/terreno/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1_2_" aria-controls="submenu-1_2_">Residencia</a>
                                            <div id="submenu-1_2_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('residencia/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('residencia/listar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1_3" aria-controls="submenu-1_3">Edifício</a>
                                            <div id="submenu-1_3" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('imoveis/edificio/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('imoveis/edificio/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                       
                                    </ul>
                                </div>
                            </li>
                            @endcan
                            

                            
                                
                           
                            
                            @can('gestor movel')
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-f fa-desktop"></i>Gerir Móveis</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1_9" aria-controls="submenu-1_3">Material de Escritório</a>
                                            <div id="submenu-1_9" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('material-escritorio/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('material-escritorio/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1_10" aria-controls="submenu-1_10">Material Electrónico</a>
                                            <div id="submenu-1_10" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('material-eletronico.registar')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('material-eletronico.consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                       
                                       



                                        
                                    </ul>
                                </div>
                            </li>
                            @endcan
                           
                           

                            @can('gestor de veiculo')
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-f fa-car"></i>Gerir Veículos</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('veiculo/create')}}">Registar</a>
                                            <a class="nav-link" href="{{url('veiculo/consultar')}}">Consultar</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endcan

                            
                            @can('técnico veículo')
                                
                          
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-f fa-folder"></i>Área Técnica Veículo</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                        
                                            <a class="nav-link" href="{{url('tecnica/veiculo/ocorrencia')}}">Consultar</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endcan
                         

                            @can('técnico movel')
                                
                           
                           <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4_" aria-controls="submenu-4_"><i class="fas fa-f fa-folder"></i>Área Técnica Móveis</a>
                            <div id="submenu-4_" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('tecnica/movel/ocorrencia')}}">Consultar</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endcan
                            
                        


                            
                        @can('Director')
                        
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5_" aria-controls="submenu-5_"><i class="fas fa-f fa-folder"></i>Gerir Abates</a>
                                <div id="submenu-5_" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6_" aria-controls="submenu-6_">Veiculos</a>
                                            <div id="submenu-6_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('abate/veiculos/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-0_" aria-controls="submenu-0_">Material electrónico</a>
                                            <div id="submenu-0_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('abate/MaterialEletronico/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-00_" aria-controls="submenu-00_">Material de escritório</a>
                                            <div id="submenu-00_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('abate/MaterialEscritorio/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8_" aria-controls="submenu-8_">Edificios</a>
                                            <div id="submenu-8_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('abate/edificio/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-88_" aria-controls="submenu-88_">Terrenos</a>
                                            <div id="submenu-88_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                   
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('abate/terrenos/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-87" aria-controls="submenu-87">Residencias</a>
                                            <div id="submenu-87" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                   
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('abate/residencia/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                       

                                        
                                       
                                    </ul>
                                </div>
                            </li>
                            @endcan  
                           
                          



                            @can('admin')
                                
                           
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-f fas fa-cog"></i>Configurações</a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6">Utlizadores</a>
                                            <div id="submenu-6" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('user/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('user/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8">Departamento</a>
                                            <div id="submenu-8" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('/departamento')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('/departamento/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-88" aria-controls="submenu-88">Fornecedor</a>
                                            <div id="submenu-88" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('imoveis/fornecedorMovel/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('fornecedor/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-87_" aria-controls="submenu-87_">Tipo de aquisição</a>
                                            <div id="submenu-87_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('tipoaquisicao/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('tipoaquisicao/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-100_" aria-controls="submenu-100_">Motivos de Abate</a>
                                            <div id="submenu-100_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('motivo-abate/create')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('motivo-abate/consultar')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-101_" aria-controls="submenu-101_">Tipo de Seguro</a>
                                            <div id="submenu-101_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-102_" aria-controls="submenu-101_">Pre-Definições</a>
                                            <div id="submenu-102_" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('')}}">Registar</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{url('')}}">Consultar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        
                                       
                                    </ul>
                                </div>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->


        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->


                    
                    @yield('content')
                    
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                  
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © 2023 ENDE. All rights reserved
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{url('assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{url('assets/libs/js/main-js.js')}}"></script>
    <!-- chart chartist js -->
    <script src="{{url('assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- sparkline js -->
    <script src="{{asset('assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{asset('assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- chart c3 js -->
    <script src="{{asset('assets/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
    <script src="{{asset('assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
    <script src="{{asset('assets/libs/js/dashboard-ecommerce.js')}}"></script>
    <script src="{{asset('js/meujs.js')}}"></script>
</body>
 
</html>