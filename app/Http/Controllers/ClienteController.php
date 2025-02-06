<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function store (StoreFormRequest $request)
    {
        $cliente = Cliente::create([
          'nome' => $request->nome,
          'email' => $request->email,
          'telefone' => $request->telefone,
          'endereco' => $request->endereco

        ]);

        return response()->json([
            'store' => true,
            'menssagem' => 'cliente cadastrado',
            'data' => $cliente
        ]);
    }

    public function index (Request $request)
    {
        $cliente = Cliente::all();
          
        return response()->json([
            'status'=>true,
            'data' =>  $cliente        
           ]);

   
        
    }

    public function show ($id)
    {
        $cliente = Cliente::find($id);
        return response()->json([
            'status'=> true,
            'data' => $cliente
        ]);

        return response()->json([
            'status' => false,
            'menssagem' => 'nao encontrado'
        ]);
    }


    public function update (UpdateFormRequest $request, $id)
    {
        $cliente = Cliente::find($request->id);
        if($cliente == null){
            return response()->json([
                'status' => false,
                'menssagem' => 'nao atualizado'
            ]);
        }
        if(isset($request->nome)){
            $cliente->nome = $request->nome;
        }

        if(isset($request->email)){
            $cliente->email = $request->email;
        }

        if(isset($request->telefone)){
            $cliente->telefone = $request->telefone;
        }

        if(isset($request->endereco)){
            $cliente->endereco = $request->endereco;
        }

        $cliente->update();

        return response()->json([
            'status' => true,
            'menssagem' => 'atualizado',
            'data' => $cliente
        ]);
        
    }

    public function delete(Request $request, $id){

    $cliente = Cliente::find($request->id);
    if($cliente == null){
    return response()->json([
        'status' => false,
        'menssagem' => 'nao deletado',
        

    ]);
    }
$cliente->delete();
    return response()->json([
        'status' => true,
        'data' => $cliente

    ]);


    }
}
