<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdressController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user) : \Illuminate\Http\JsonResponse
    {

        request()->validate([
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
        ]);

        $adress = Adress::create([
            'user_id' => $user->id,
            'tipo_endereco' => request()->tipo_endereco, // 0 = residencial, 1 = comercial
            'cep' => request()->cep,
            'numero' => request()->numero,
            'complemento' => request()->complemento,
            'bairro' => request()->bairro,
            'cidade' => request()->cidade,
            'estado' => request()->estado,
            'logradouro' => request()->logradouro,
        ]);

        return response()->json([
            'message' => 'Enderço criado created successfully',
            'adress' => $adress,
        ], 201);
    }


    public function update(Request $request, Adress $adress) : \Illuminate\Http\JsonResponse
    {
        request()->validate([
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
        ]);

        $adress->update([
            'user_id' => request()->user_id,
            'id' => request()->id,
            'tipo_endereco' => request()->tipo_endereco, // 0 = residencial, 1 = comercial
            'cep' => request()->cep,
            'numero' => request()->numero,
            'complemento' => request()->complemento,
            'bairro' => request()->bairro,
            'cidade' => request()->cidade,
            'estado' => request()->estado,
            'logradouro' => request()->logradouro,
        ]);

        return response()->json([
            'message' => ' Adress updated successfully',
            'adress' => $adress,
        ], 201);
    }

}
