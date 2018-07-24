@extends('layouts.app',['current'=>'categorias'])

@section('body')

    <div class="card border">
        <div class="card-body">

                <h3 class="card-title">Cadastro de Produtos</h3>
                <table class="table table-ordered table-hover" id="tabelaProdutos">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Estoque</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-success" role="button" onClick="novoProduto()">Novo Produto</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto">
                    <div class="modal-header">
                        <h4 class="modal-title">Novo Produto</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group">
                            <label for="nomeProduto" class="control-label">Nome do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Nome do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço do Produto</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="precoProduto" name="precoProduto" placeholder="Preço do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qtdeProduto" class="control-label">Quantidade do Produto</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="qtdeProduto" name="qtdeProduto" placeholder="Quantidade do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="catProduto" class="control-label">Categoria do Produto</label>
                            <div class="input-group">
                                <select class="form-control" id="catProduto" name="catProduto">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">

       $.ajaxSetup({
           headers:{
               'X-CSRF-TOKEN':"{{csrf_token()}}"
           }
       });

        function novoProduto()
        {
            $('#nomeProduto').val('');
            $('#id').val('');
            $('#precoProduto').val('');
            $('#qtdeProduto').val('');
            $('#catProduto').val('');
            $('#dlgProdutos').modal('show');
        }

        function criarProduto()
        {
            prod = {

                nomeProduto:$('#nomeProduto').val(),
                precoProduto:$('#precoProduto').val(),
                qtdeProduto:$('#qtdeProduto').val(),
                catProduto:$('#catProduto').val()
            };
            $.post('/api/produtos', prod, function(data){
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaProdutos>tbody').append(linha);
            })

            console.log(prod);
        }

        $('#formProduto').submit(function (event) {
            event.preventDefault();
            if($('#id').val()== '')
            {
                criarProduto();

            }else
            {
                salvarEdicaoProduto();
            }

            $('#dlgProdutos').modal('hide');
        });


        function carregarCategorias()
        {
            $.getJSON('/api/categorias', function(data)
            {
                var i;
                for(i=0; i<data.length;i++)
                {
                    var opt = '<option value="'+data[i].id+'">'+data[i].nome+'</option>';
                    $('#catProduto').append(opt);
                }
            });
        }

        function montarLinha(p)
        {
            var linha = "<tr>"+
                            "<td>"+p.id+"</td>"+
                            "<td>"+p.nome+"</td>"+
                            "<td>"+p.preco+"</td>"+
                            "<td>"+p.categoria_id+"</td>"+
                            "<td>"+p.estoque+"</td>"+
                            "<td>"+
                                "<button class='btn btn-sm btn-primary' onclick='editarProduto("+p.id+")'>Editar</button>"+
                                " <button class='btn btn-sm btn-danger' onclick='removerProduto("+p.id+")'>Apagar</button>"+
                            "</td>"+
                        "</tr>";
            return linha;
        }

        function carregarProdutos()
        {
            $.getJSON('/api/produtos',function(produtos)
            {
                for(i=0;i<produtos.length;i++)
                {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            });
        }

        function removerProduto(id)
        {
            $.ajax({
                type:"DELETE",
                url:"/api/produtos/"+id,
                context: this,
                success: function () {
                    linhas = $("#tabelaProdutos>tbody>tr");
                    e = linhas.filter(function(i, elemento)
                    {
                        return elemento.cells[0].textContent == id;
                    });

                    if(e)
                    {
                       e.remove();
                    }
                },error: function (error) {
                    console.log(error);
                }
            });
        }

       function editarProduto(id)
       {
           $.getJSON('/api/produtos/'+id , function(data)
           {
             console.log(data);
               $('#id').val(data.id);
               $('#nomeProduto').val(data.nome);
               $('#precoProduto').val(data.preco);
               $('#qtdeProduto').val(data.estoque);
               $('#catProduto').val(data.categoria_id);
               $('#dlgProdutos').modal('show');
           });
       }

       function salvarEdicaoProduto()
       {
           prod = {
               id:$('#id').val(),
               nomeProduto:$('#nomeProduto').val(),
               precoProduto:$('#precoProduto').val(),
               qtdeProduto:$('#qtdeProduto').val(),
               catProduto:$('#catProduto').val()
           };

           $.ajax({
               type:"PATCH",
               url:"/api/produtos/"+prod.id,
               data: prod,
               context: this,
               success: function (data) {
                   prod = JSON.parse(data);
                   linhas = $('#tabelaProdutos>tbody>tr');
                   e= linhas.filter(function(i,e){
                       return(e.cells[0].textContent == prod.id);
                   });
                   if(e)
                   {
                        e[0].cells[0].textContent = prod.id;
                        e[0].cells[1].textContent = prod.nome;
                        e[0].cells[2].textContent = prod.preco;
                        e[0].cells[3].textContent = prod.categoria_id;
                        e[0].cells[4].textContent = prod.estoque;
                   }


               },
               error: function (error) {
                   console.log(error);
               },
           });
       }


        $(function ()
        {
            carregarCategorias();
            carregarProdutos();
        })
    </script>
@endsection