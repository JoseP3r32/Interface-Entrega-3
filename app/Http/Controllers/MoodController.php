<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\mood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class MoodController extends Controller
{
    public function index()
    {
        $users = User::all();
        $moods = mood::all();
        $hayMoods = false;
        foreach ( $moods as $mood ) {
            if($mood->deleted !== 1) {
                $hayMoods = true;
            }
        }
        return view('elementos.moods')->with('moods', $moods)->with('users', $users)->with('hayMoods', $hayMoods);
    }

    public function create()
    {
       
        return view('elementos.create_mood');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'image' => 'required|image',
                       
        ]);

        $image_name = null;

        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $image_name);
        }

        $mood = new mood([
            'name' => $request->name,
            'description' => $request->description,
            'image' => 'images/'.$image_name,
            
        ]);

        $mood->user()->associate($user);
        
        $mood->save();

        return redirect()->route('listar.moods')->with('message', 'Estado de Animo creado satisfactoriamente');

    }

  
    public function update(Request $request)
    {
        $mood = mood::find($request->id);
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'image',
        ]);

        $image_name = $mood->image;

        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $image_name);
        }

        

        $mood->update([
            'name' => $request->name,
            'image' => 'images/'.$image_name,
        ]);

        // Asociar el usuario solo si no está asociado actualmente
        if (!$mood->user) {
            $mood->user()->associate($user);
        }

        return redirect()->route('listar.moods')->with('message', 'Estado de Animo editado satisfactoriamente');
    }


   
    public function edit($id)
    {
        $mood = mood::find($id);

        
        if (!$mood) {
            return redirect()->route('listar.moods')->with('error', 'Estado de Animo no encontrado.');
        }

        return view('elementos.edit-mood', compact('mood'));
    }

    public function deleteMood(Request $request): RedirectResponse
    {
        try {
            $mood = Mood::findOrFail($request->input('idmood'));
            $mood->delete();
        } catch (\Exception $e) {
            return redirect()->route('listar.moods')->with('error', 'Error al eliminar el estado de animo: ' . $e->getMessage());
        }

        return redirect()->route('listar.moods')->with('message', 'Estado de Animo eliminado satisfactoriamente');
    }
}
