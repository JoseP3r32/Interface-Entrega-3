<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Event;
use App\Models\Emotion;
use App\Models\Mood;

use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin')->with('users', $users);
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

    public function edit(string $id)
    {
        $usuario = User::find($id);
        return view('usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin')->with('error', 'Usuario no encontrado');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('admin')->with('success', 'Usuario actualizado correctamente');
    }

    // Método para realizar un soft delete
    public function destroy($id)
    {
        
    }

    
    

}
