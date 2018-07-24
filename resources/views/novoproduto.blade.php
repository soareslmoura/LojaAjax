@extends('layouts.app',['current'=>'produtos'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Entre com o nome do produto">
                    <label for="precoProduto">Preço do Produto</label>
                    <input type="text" class="form-control" name="precoProduto" id="precoProduto" >
                    <label for="estoqueProduto">Estoque</label>
                    <input type="text" class="form-control" name="estoqueProduto" id="estoqueProduto" >
                    <label for="categoriaProduto">Categoria</label>
                    <select class="custom-select" name="categoriaProduto">
                        <option disabled>Categorias</option>
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