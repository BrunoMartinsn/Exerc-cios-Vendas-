<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*clientes */
Route::post('clientes', [ClienteController::class, 'store']);
Route::get('clientes', [ClienteController::class, 'index']);
Route::get('clientes/{id}', [ClienteController::class, 'show']);
Route::put('clientes/{id}', [ClienteController::class, 'update']);
Route::delete('clientes/{id}', [ClienteController::class, 'delete']);

/*produtos */
Route::post('produtos', [ProdutoController::class, 'store']);
Route::get('produtos', [ProdutoController::class, 'index']);
Route::get('produtos/{id}', [ProdutoController::class, 'show']);
Route::put('produtos/{id}', [ProdutoController::class, 'update']);
Route::delete('produtos/{id}', [ProdutoController::class, 'delete']);

/*venda */
Route::post('vendas', [VendaController::class, 'store']);
Route::get('vendas', [VendaController::class, 'index']);
Route::get('vendas/{id}', [VendaController::class, 'show']);
Route::put('vendas/{id}', [VendaController::class, 'update']);
Route::delete('vendas/{id}', [VendaController::class, 'delete']);

/*itens-vendas */
Route::post('itens-vendas', [ItemVendaController::class, 'store']);
Route::get('itens-vendas', [ItemVendaController::class, 'index']);
Route::get('itens-vendas/{id}', [ItemVendaController::class, 'show']);
Route::put('itens-vendas/{id}', [ItemVendaController::class, 'update']);
Route::delete('itens-vendas/{id}', [ItemVendaController::class, 'delete']);