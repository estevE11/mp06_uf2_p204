@extends('master')

@section('title', 'Formulari principal')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Calcular els teus biorritmes
                </div>
                <div class="card-body">
                    @if($correct == false)
                        <div class="alert alert-danger">El <b>NIF</b>  introduit no es correcte</div>
                    @endif

                    <form class="" action="/validate" method="get">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inpt-name">Nom</label>
                                    <input type="text" class="form-control" id="inpt-name" name="name">
                                </div>
                            </div>
                            <div class="col-6">                            
                                <div class="form-group">
                                    <label for="inpt-surnames">Cognoms</label>
                                    <input type="text" class="form-control" id="inpt-surnames" name="surnames">
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inpt-nif">NIF</label>
                                    <input type="text" class="form-control" id="inpt-nif" name="nif">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inpt-sex" >Sexe</label>
                                    <select class="form-control" id="inpt-sex" name="sex">
                                        <option disabled selected>--</option>
                                        <option>Dona</option>
                                        <option>Home</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inpt-state">Estat civil</label>
                                    <select class="form-control" id="inpt-state" name="state">
                                        <option disabled selected>--</option>
                                        <option>Solter</option>
                                        <option>Casat</option>
                                        <option>Complicat</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Calcular</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Clients
                </div>
                <div class="card-body">
                    @if(empty($clients))
                        <p>Actualment no hi ha cap client registrat</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sexe</th>
                                    <th>Nom</th>
                                    <th>NIF</th>
                                    <th>Estat civil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="client-sex" id='{{ substr($client['sex'], 0, 1) }}'>
                                                {{ $client['sex'] }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $client['name'] }} {{ $client['surname'] }} 
                                        </td>
                                        <td>
                                            {{ $client['nif'] }}
                                        </td>
                                        <td>
                                            {{ $client['state'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .client >  div {
        display: inline-block;
        margin-bottom: 5px;
    }

    .client-sex {
        padding: 5px 10px;
        border-radius: 10px;
        display: inline-block;
    }

    #H {
        background-color: #ffaaff;
    }

    #D {
        background-color: #00aaff;
    }
</style>

@endsection