<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Adress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResource
    {
        $query = User::query();
    
        if ($request->filled('id')) {
            $query->where('id', $request->input('id'));
        }
    
        if ($request->filled('nome')) {
            $query->where('name', 'like', '%' . $request->input('nome') . '%');
        }
    
        if ($request->filled('cpf')) {
            $query->where('cpf', 'like', '%' . $request->input('cpf') . '%');
        }
    
        $users = $query->get();
    
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'  => 'required',
            'cpf' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            
        ]);

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make('password'),
            'cpf' => request()->cpf,
            'nome_social' => request()->nome_social,
            'nome_pai' => request()->nome_pai,
            'nome_mae' => request()->nome_mae,
            'telefone' => request()->telefone,

        ]);

            

        return response()->json([
            'message' => 'user created successfully',
            'user'   => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {        
        return UserResource::make($user->load('adress'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();

        return response()->json([
            'message' => 'user deleted successfully',
        ], 200);
    }
}
