@extends('layout.template')
@section('title', 'Utilizador')


@section('content')

<div class="card">

<div class="card-body">
    <div class="user-avatar text-center d-block">
        <img src="{{asset('img/images.jpg')}}" alt="User Avatar" class="rounded-circle user-avatar-xxl"> <br>
        <a href="#" class="my_link">Alterar foto</a>
    </div>
    <div class="text-center">
        <h2 class="font-24 mb-0">{{Auth::user()->name}}</h2>
        <p>{{Auth::user()->getPermissionNames()->first()}}</p>
    </div>
</div>
<div class="card-body border-top">
    <h3 class="font-16">Contact Information</h3>
    <div class="">
        <ul class="list-unstyled mb-0">
        <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{Auth::user()->email}}</li>
        <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i>(900) 123 4567</li>
    </ul>
    </div>
</div>
<div class="card-body border-top">
    <h3 class="font-16">Rating</h3>
    <h1 class="mb-0">4.8</h1>
    <div class="rating-star">
        <i class="fa fa-fw fa-star"></i>
        <i class="fa fa-fw fa-star"></i>
        <i class="fa fa-fw fa-star"></i>
        <i class="fa fa-fw fa-star"></i>
        <i class="fa fa-fw fa-star"></i>
        <p class="d-inline-block text-dark">14 Reviews </p>
    </div>
</div>


</div>

@endsection