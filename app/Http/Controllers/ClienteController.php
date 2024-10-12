<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function listar()
    { 
        $customers = Cliente::all();
        return ApiResponse::success('Lista de Clientes', $customers);
       
    
    }

    public function listarPeloId(int $id)
    {
        $customer = Cliente::findOrFail($id);
        return ApiResponse::success('Lista de solicitado', $customer);
    
    }

    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:200',
        ]);

        if ($validator->fails()) {
            return ApiResponse::error ('Erro de validação', $validator->errors());
            
        }

        $customer = cliente::create($request->all());
        return ApiResponse::success('Salvo com sucesso', $customer);

    }

    public function editar(Request $request ,int $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:200',
        ]);

        if ($validator->fails()) {
            return ApiResponse::error ('Erro de validação', $validator->errors());
            
        }

        $customer = cliente::findOrFail($id);
        $customer->update($request->all());

        return ApiResponse::success('Salvo com sucesso', $customer);
 
    }
    public function deletar(int $id)
    {
        $customer = Cliente::findOrFail($id);
        $customer->delete();
        return ApiResponse::success('Cliente removido com sucesso!',);
     
    }

}