@extends('layout.template')
@section('title', 'Utilizadores')


@section('content')
<form action="{{url('user/pesquisar')}}" >
    @csrf
    <div class="input-group rounded">
        <input type="search" name="nome"  class="form-control rounded" placeholder="nome do utilizador" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
    </div>
</form>

            @if(isset($erro))
            <div class="alert alert-danger" id="erro-registar">
                <p>{{$erro}}</p>
            </div>
            @endif

            @if (@isset($sms))
                <div class="alert alert-success" role="alert">
                     <p>{{$sms}}</p>
                </div>
            @endif
                    <div class="card">
                                    <h3 class="card-header">Listar Utilizador</h3>

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                
                                                 
                                                   
                                                
                                                
                                                    <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nome</th>
                                                                    <th>Email</th>
                                                                    <th>Perfil</th>
                                                                    <th>Telefone</th>
                                                                    <th>Estado</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($user))
                                                                    @foreach($user as $u)
                                                                <tr>
                                                                    <td>{{$u->codigo}}</td>
                                                                    <td>{{$u->name}}</td>
                                                                    <td>{{$u->email}}</td>
                                                                    <td>{{$u->perfil}}</td>
                                                                    <td>{{$u->telefone}}</td>
                                                                    <td>{{$u->estado}}</td>
                                                                    <td>
                                                                         <a href="{{url("user/editar/$u->codigo")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         @if($u->estado=='ativo')
                                                                         <a href="#" class="btn btn-sm  active" data-toggle="modal" onclick="retornaid({{$u->codigo}})" data-target="#BloquearModal">bloquear</a>
                                                                         @else
                                                                         <a href="#" class="btn btn-sm  active"  data-toggle="modal" onclick="retornaid2({{$u->codigo}})" data-target="#DesquearModal">desbloquear</a>
                                                                         @endif
                                                                        
                                                                     </td>
                                                                </tr>
                                                                @endforeach
                                                             @endif  
                                                            </tbody>
                                                        </table>
                                                    </div> 
                                    </div>
                    </div>

 <!-- Modal -->
 <div class="modal fade" id="BloquearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            
            <div class="modal-body">
                <form action="{{url('user/bloquear')}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    

                <p class="text-center">Tem certeza que deseja desbloquear este utilizador? </p>

                <div class="text-right">
                    <input id="user_id" name="user_id"  type="hidden">
                    <button class="btn btn-sm btn-success" type="submit">Confirmar</button>
                    <button class="btn btn-danger btn-sm"  data-dismiss="modal" aria-label="Close" >Cancelar</button>
                </div>


                </form>
               
            </div>
           
        </div>
    </div>
</div>
 <!-- EndModal -->



 <!-- Modal -->
 <div class="modal fade" id="DesquearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            
            <div class="modal-body">
                <form action="{{url('user/desbloquear')}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    

                <p class="text-center">Tem certeza que deseja bloquear este utilizador? </p>

                <div class="text-right">
                    <input id="id" name="user_id"  type="hidden">
                    <button class="btn btn-sm btn-success" type="submit">Confirmar</button>
                    <button class="btn btn-danger btn-sm"  data-dismiss="modal" aria-label="Close" >Cancelar</button>
                </div>


                </form>
               
            </div>
           
        </div>
    </div>
</div>
 <!-- EndModal -->

 <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
<script>

        function retornaid(id){
                            // alert(id);
             $('#user_id').val(id);
         }

         function retornaid2(id){
                            // alert(id);
             $('#id').val(id);
         }
                    
 
 </script>

@endsection