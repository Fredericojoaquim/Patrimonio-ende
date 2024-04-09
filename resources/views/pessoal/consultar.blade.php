@extends('layout.template')
@section('title', 'Pessoal')


@section('content')


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
                                    <h3 class="card-header">Pessoal</h3>

                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card">
                                                
                                                 
                                                   
                                                
                                                
                                                    <div class="table-responsive">
                                                        <table id="datatable" class="table table-striped table table-responsive" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nome</th>
                                                                    <th>Data nascimento</th>
                                                                    <th>Email</th>
                                                                    <th>Telefone</th>
                                                                    <th>Departamento</th>
                                                                    <th>Acções</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($pessoal))
                                                                    @foreach($pessoal as $p)
                                                                <tr>
                                                                    <td>{{$p->id}}</td>
                                                                    <td>{{$p->nome}}</td>
                                                                    <td>{{$p->datanasc}}</td>
                                                                    <td>{{$p->email}}</td>
                                                                    <td>{{$p->telefone}}</td>
                                                                    <td>{{$p->departamento}}</td>
                                                                   
                                                                    <td>
                                                                         <a href="{{url("pessoal/edit/$p->id")}}" class="btn btn-sm active"><i class="fas fa-edit"></i></a>
                                                                         
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
                    

                <p class="text-center">Tem certeza que deseja Bloquear este utilizador? </p>

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
                    

                <p class="text-center">Tem certeza que deseja desbloquear este utilizador? </p>

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
                    
     $(document).ready(function(){
        //codigo para inicializar a data table
      var table=$('#datatable').DataTable();   
    });
 </script>

@endsection