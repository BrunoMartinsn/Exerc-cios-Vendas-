<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaStoreFormRequest;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(VendaStoreFormRequest $request)
    {
        


        
        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda' => date('Y-m-d H-i-s'),
            'subtotal' => 0,
            'desconto' => $request->desconto,
            'total' => 0 

        ]);

        $subtotal = 0;
        foreach ($request->itens as $item) {
            $subtotal += $item["quantidade"] * $item["preco_unitario"];


            $produto = Produto::find($item['produto_id']);
            $produto->quantidade_estoque = $produto->quantidade_estoque - $item["quantidade"];

            $item_venda = ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $item['produto_id'],
                'quantidade'=>$item['quantidade'],
                'preco_unitario'=> $item['preco_unitario'],
                'subtotal_item' =>$subtotal
            ]);

            $produto->update();
        }

        $venda->subtotal = $subtotal;
        $venda->total = $subtotal - $request->desconto;
        $venda->update();

        return response()->json([
            'store' => true,
            'menssagem' => 'cliente cadastrado',
            'data' => $venda
        ]);
    }

    public function index(Request $request)
    {
        $venda = Venda::all();

        return response()->json([
            'status' => true,
            'data' =>  $venda
        ]);
    }

    public function show($id)
    {
        $venda = Venda::find($id);
        return response()->json([
            'status' => true,
            'data' => $venda
        ]);

        return response()->json([
            'status' => false,
            'menssagem' => 'nao encontrado'
        ]);
    }



    public function update(Request $request, $id)
    {
        $venda = Venda::find($request->id);
        if ($venda == null) {
            return response()->json([
                'status' => false,
                'menssagem' => 'nao atualizado'
            ]);
        }
        if (isset($request->cliente_id)) {
            $venda->cliente_id = $request->cliente_id;
        }

        if (isset($request->data_venda)) {
            $venda->data_venda = $request->data_venda;
        }

        if (isset($request->subtotal)) {
            $venda->subtotal = $request->subtotal;
        }

        if (isset($request->desconto)) {
            $venda->desconto = $request->desconto;
        }

        if (isset($request->total)) {
            $venda->total = $request->total;
        }

        $venda->update();

        return response()->json([
            'status' => true,
            'menssagem' => 'atualizado',
            'data' => $venda
        ]);
    }


    public function delete(Request $request, $id)
    {

        $venda = Venda::find($request->id);
        if ($venda == null) {
            return response()->json([
                'status' => false,
                'menssagem' => 'nao deletado',


            ]);
        }
        $venda->delete();
        return response()->json([
            'status' => true,
            'data' => $venda

        ]);
    }
}
