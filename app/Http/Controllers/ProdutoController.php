<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoStoreFormRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store (ProdutoStoreFormRequest $request)
    {
        $produto = Produto::create([
          'nome' => $request->nome,
          'codigo' => $request->codigo,
          'preco' => $request->preco,
          'quantidade_estoque' => $request->quantidade_estoque

        ]);

        return response()->json([
            'store' => true,
            'menssagem' => 'cliente cadastrado',
            'data' => $produto
        ]);
    }

    public function index (Request $request)
    {
        $produto = Produto::all();
          
        return response()->json([
            'status'=>true,
            'data' =>  $produto        
           ]);

   
        
    }

    public function show ($id)
    {
        $produto = Produto::find($id);
        return response()->json([
            'status'=> true,
            'data' => $produto
        ]);

        return response()->json([
            'status' => false,
            'menssagem' => 'nao encontrado'
        ]);
    }





    public function update (Request $request, $id)
    {
        $produto = Produto::find($request->id);
        if($produto == null){
            return response()->json([
                'status' => false,
                'menssagem' => 'nao atualizado'
            ]);
        }
        if(isset($request->nome)){
            $produto->nome = $request->nome;
        }

        if(isset($request->codigo)){
            $produto->codigo = $request->codigo;
        }

        if(isset($request->preco)){
            $produto->preco = $request->preco;
        }

        if(isset($request->quantidade_estoque)){
            $produto->quantidade_estoque = $request->quantidade_estoque;
        }

        $produto->update();

        return response()->json([
            'status' => true,
            'menssagem' => 'atualizado',
            'data' => $produto
        ]);
        
    }


    public function delete(Request $request, $id){

        $produto = Produto::find($request->id);
        if($produto == null){
        return response()->json([
            'status' => false,
            'menssagem' => 'nao deletado',
            
    
        ]);
        }
    $produto->delete();
        return response()->json([
            'status' => true,
            'data' => $produto
    
        ]);
    
    
        }
}
