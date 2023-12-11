@extends('layout.template')
@section('title', 'Gestão de Património ENDE-Imóvel')


@section('content')

                 <div class="card">
                                    <h5 class="card-header">Registar Bem Móvel</h5>

                                    <div class="card-body">

                                        <form>

                                            <div class="row">

                                                <div class="form-group col-lg-6 col-md-12">

                                                    <label for="inputText3" class="col-form-label">Nº Imobilizado</label>
                                                    <input id="inputText3" type="text" class="form-control">
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 margin-input">
                                                    <label for="inputEmail">Descrição</label>
                                                    <input id="inputEmail" type="text" placeholder="name@example.com" class="form-control">
                                                    
                                                </div>
                     

                                                <div class="form-group col-lg-6">
                                                        <label for="inputText4" class="col-form-label">Valor de aquisição</label>
                                                        <input id="inputText4" type="number" class="form-control" placeholder="Numbers">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                        <label for="inputPassword">Data de Aquisição</label>
                                                        <input id="inputPassword" type="date" placeholder="Password" class="form-control">
                                                </div>


                                                <div class="form-group col-lg-6">
                                                        <label for="inputText4" class="col-form-label">Área Beneficiário</label>
                                                        <input id="inputText4" type="number" class="form-control" placeholder="Numbers">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">

                                                    <label for="input-select">Example Select</label>
                                                    <select class="form-control" id="input-select">
                                                        <option>Choose Example</option>
                                                        <option>teste</option>
                                                    </select>
                                               </div>

                                                <div class="form-group col-lg-6">
                                                        <label for="inputText4" class="col-form-label">Valor</label>
                                                        <input id="inputText4" type="number" class="form-control" placeholder="Numbers">
                                                </div>

                                                <div class="form-group col-lg-6 margin-input">
                                                        <label for="inputPassword">Área beneficiária</label>
                                                        <input id="inputPassword" type="password" placeholder="Password" class="form-control">
                                                </div>
                                           </div>

                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">File Input</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            
                                            <div class="text-right">
                                                <button class="btn btn-success "><a class="text-white" href="#" >Registar</a></button>
                                                <button class="btn btn-danger" type="reset">Cancelar</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                     </div>


@endsection