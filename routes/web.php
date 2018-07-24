<?php



Route::get('/', function () {
    return view('index');
});

/* --------------   ROTAS CATEGORIAS --------------*/

Route::get('/categorias','ControladorCategoria@index');

Route::get('/categorias/novo', 'ControladorCategoria@create');

Route::post('/categorias', 'ControladorCategoria@store');

Route::post('/categorias/{id}', 'ControladorCategoria@update');

Route::get('/categorias/apagar/{id}', 'ControladorCategoria@destroy');

Route::get('/categorias/editar/{id}', 'ControladorCategoria@edit');



/* --------------   ROTAS PRODUTOS --------------*/

Route::get('/produtos','ControladorProduto@indexView');

Route::get('/novoproduto','ControladorProduto@create');

Route::get('/produtos/editar/{id}','ControladorProduto@edit');

Route::post('/produtos','ControladorProduto@store');

Route::post('/produtos/{id}','ControladorProduto@update');

Route::get('/produtos/apagar/{id}','ControladorProduto@destroy');

