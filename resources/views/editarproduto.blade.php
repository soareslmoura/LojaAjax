@extends('layouts.app',['current'=>'produtos'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos/{{$prod->id}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input value="{{$prod->nome}}" type="text" class="form-control" name="nomeProduto" id="nomeProduto" >
                    <label for="precoProduto">Preço do Produto</label>
                    <input value="{{$prod->preco}}" type="text" class="form-control" name="precoProduto" id="precoProduto" >
                    <label for="estoqueProduto">Estoque</label>
                    <input value="{{$prod->estoque}}" type="text" class="form-control" name="estoqueProduto" id="estoqueProduto" >
                    <label for="categoriaProduto">Categoria</label>
                    <select class="custom-select" name="categoriaProduto">

            @foreach($cats as $c)
                @if($c->id == $prod->categoria_id)
                    <option style="background: lightgrey"; selected value="{{$c->id}}">{{$c->nome}}</option>
                @endif
            @endforeach

            @if(count($cats) > 0)
                @foreach($cats as $c)
                        <option value="{{$c->id}}">{{$c->nome}}</option>
                @endforeach
            @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection