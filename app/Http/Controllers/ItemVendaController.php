<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function index(Request $request)
    {
        $itemVenda = ItemVenda::all();

        return response()->json([
            'status' => true,
            'data' =>  $itemVenda
        ]);
    }

    public function show($id)
    {
        $itemVenda = ItemVenda::find($id);
        return response()->json([
            'status' => true,
            'data' => $itemVenda
        ]);

        return response()->json([
            'status' => false,
            'menssagem' => 'nao encontrado'
        ]);
    }

    public function update(Request $request, $id)
    {
        $itemVenda = ItemVenda::find($request->id);
        if ($itemVenda == null) {
            return response()->json([
                'status' => false,
                'menssagem' => 'nao atualizado'
            ]);
        }
        if (isset($request->venda_id)) {
            $itemVenda->venda_id = $request->venda_id;
        }

        if (isset($request->produto_id)) {
            $itemVenda->produto_id = $request->produto_id;
        }

        if (isset($request->quantidade)) {
            $itemVenda->quantidade = $request->quantidade;
        }

        if (isset($request->preco_unitario)) {
            $itemVenda->preco_unitario = $request->preco_unitario;
        }

        if (isset($request->subtotal_item)) {
            $itemVenda->subtotal_item = $request->subtotal_item;
        }

        $itemVenda->update();

        return response()->json([
            'status' => true,
            'menssagem' => 'atualizado',
            'data' => $itemVenda
        ]);
    }

    public function delete(Request $request, $id)
    {

        $itemVenda = ItemVenda::find($request->id);
        if ($itemVenda == null) {
            return response()->json([
                'status' => false,
                'menssagem' => 'nao deletado',


            ]);
        }
        $itemVenda->delete();
        return response()->json([
            'status' => true,
            'data' => $itemVenda

        ]);
    }

}
