<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Somente usúarios autenticados podem acessar

        return view('profile.index', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'cep' => 'nullable|string',
            'phone_number' => 'required|numeric|celular_com_ddd',
            'cpf' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'allergies' => 'nullable|string',
            'medical_conditions' => 'nullable|string',
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.index')->with('success', 'Perfil atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
