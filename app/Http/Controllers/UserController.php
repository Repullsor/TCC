<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Somente usúarios autenticados podem acessar
        $user->date_of_birth_formatted = Carbon::parse($user->date_of_birth)->format('d/m/Y'); // Formatação para exibir a data em pt-br

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

        $user->date_of_birth_formatted = Carbon::parse($user->date_of_birth)->format('d/m/Y');

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
            'date_of_birth' => 'required|date_format:d/m/Y',
            'gender' => 'required|string',
            'address' => 'nullable|string',
            'street' => 'nullable|string',
            'number' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'cep' => 'nullable|string',
            'phone_number' => 'required|celular_com_ddd',
            'cpf' => 'required|cpf',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'allergies' => 'nullable|string',
            'medical_conditions' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'required' => ':attribute é obrigatório',
            'string' => 'O campo :attribute deve ser uma string',
            'date_format' => 'O campo :attribute deve ser uma data válida',
            'numeric' => 'O campo :attribute deve conter apenas números',
            'celular_com_ddd' => 'O campo :attribute deve estar no formato correto',
            'image' => 'O campo :attribute deve ser uma imagem',
            'mimes' => 'O campo :attribute deve ser do tipo jpeg, png, jpg ou gif',
            'max' => 'O tamanho máximo para o campo :attribute é de 2 MB',
        ], [
            'name' => 'Nome',
            'date_of_birth' => 'Data de Nascimento',
            'gender' => 'O campo Sexo',
            'phone_number' => 'Número de Telefone',
            'cpf' => 'CPF',
            'profile_picture' => 'Foto de Perfil',
        ]);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
        
            $image->move(public_path('images/profile'), $imageName);
            $validatedData['profile_picture'] = $imageName;
        }
        
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
