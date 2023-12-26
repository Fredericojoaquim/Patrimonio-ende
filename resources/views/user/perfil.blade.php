@extends('layout.template')
@section('title', 'Utilizador')


@section('content')

<div class="card">

<div class="card-body">
    <div class="user-avatar text-center d-block">
        <img src="{{asset('img/images.jpg')}}" alt="User Avatar" class="rounded-circle user-avatar-xxl"> <br>
            <button class="my_link"  data-toggle="modal" data-target="#exampleModal">Alterar foto</button>
    </div>
    <div class="text-center">
        <h2 class="font-24 mb-0">{{Auth::user()->name}}</h2>
        <p>{{Auth::user()->getPermissionNames()->first()}}</p>
    </div>
</div>
<div class="card-body border-top">
    <h3 class="font-16">Informação de Contacto</h3>
    <div class="">
        <ul class="list-unstyled mb-0">
        <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{Auth::user()->email}}</li>
        <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i>(+244) {{Auth::user()->telefone}}</li>
    </ul>
    </div>
</div>



</div>





 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Foto</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="erro-registar" hidden>
                </div>
                <form action="{{url('#')}}" method="POST" id="form-registar">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="file" id="formFile">
                    </div>

                <div class="text-right">
                    <button class="btn btn-success" id="btn-registar">Alterar</button>
                    <button class="btn btn-danger" type="reset" ><a href="#" class="closebutton" data-dismiss="modal" aria-label="Close">Cancelar</a></button>
                </div>


                </form>
               
            </div>
           
        </div>
    </div>
</div>
 <!-- EndModal -->

@endsection