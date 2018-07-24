<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class ControladorProduto extends Controller
{

    public function index()
    {
        $prods = Produto::all();
        return $prods->toJson();
    }

    public function indexView()
    {

        $prods = Produto::all();
        $cats = Categoria::all();
        return view('produtos', compact('prods', 'cats'));

    }


    public function create()
    {
        $cats = Categoria::all()->sortBy('nome');
        return view('novoproduto', compact('cats'));
    }


    public function store(Request $request)
    {
        $prod = new Produto();
        $prod->nome = $request->input('nomeProduto');
        $prod->preco = $request->input('precoProduto');
        $prod->estoque = $request->input('qtdeProduto');
        $prod->categoria_id = $request->input('catProduto');
        $prod->save();

        return json_encode($prod);
    }


    public function show($id)
    {
        $prod = Produto::find($id);

        if(isset($prod))
        {

            return json_encode($prod);
        }else{
            return response('Produto não encontrado', 404);
        }
    }


    public function edit($id)
    {
        $prod = Produto::find($id);
        $cats = Categoria::all();

        if(isset($prod))
        {
            return view('/editarproduto', compact('prod','cats'));
        }else
        {
            return view('/produtos');
        }
    }


    public function update(Request $request, $id)
    {
        $prod = Produto::find($id);

        if(isset($prod))
        {
            $prod->nome = $request->input('nomeProduto');
            $prod->preco = $request->input('precoProduto');
            $prod->estoque = $request->input('qtdeProduto');
            $prod->categoria_id = $request->input('catProduto');
            $prod->save();

            return json_encode($prod);
        }else{
            return response('Produto não encontrado', 404);
        }



    }


    public function destroy($id)
    {
        $prod = Produto::find($id);

        if(isset($prod))
        {
            $prod->delete();
        }else{
            return response('Produto não encontrado', 404);
        }



    }
}
