@extends('layouts.app',['current'=>'home'])

@section('body')

    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border border-primary">
                    <div class="card-body">
                        <h4 class="card-title"> Cadastro de Produtos </h4>
                        <p class="card-text">
                            Aqui Você cadastra todos os seus produtos
                            <a href="/produtos" class=" btn btn-primary"> Cadastre seus Produtos</a>
                        </p>
                    </div>
                </div>
                <div class="card border border-primary">
                    <div class="card-body">
                        <h4 class="card-title"> Cadastro de Categorias </h4>
                        <p class="card-text">
                            Aqui Você cadastra todos os suas Categorias
                            <a href="/categorias" class=" btn btn-primary"> Cadastre suas Categorias</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection