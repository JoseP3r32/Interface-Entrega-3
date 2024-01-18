<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\emotion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EmotionController extends Controller
{
    public function index()
    {
        $users = User::all();
        $emotions = emotion::all();
        $hayEmotions = false;
        foreach ( $emotions as $emotion ) {
            if($emotion->deleted !== 1) {
                $hayEmotions = true;
            }
        }
        return view('elementos.emociones')->with('emotions', $emotions)->with('users', $users)->with('hayEmotions', $hayEmotions);
    }

    public function create() 
    {
       
        return view('elementos.create_emotion');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|image',
                       
        ]);

        $image_name = null;

        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $image_name);
        }

        $emotion = new emotion([
            'name' => $request->name,
            'image' => 'images/'.$image_name,
            
        ]);

        $emotion->user()->associate($user);
        
        $emotion->save();

        return redirect()->route('listar.emotions')->with('message', 'Emoción creada satisfactoriamente');

    }

  
    public function update(Request $request)
    {
        $emotion = emotion::find($request->id);
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'image',
        ]);

        $image_name = $emotion->image;

        if ($request->hasFile('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $image_name);
        }

        

        $emotion->update([
            'name' => $request->name,
            'image' => 'images/'.$image_name,
        ]);

        // Asociar el usuario solo si no está asociado actualmente
        if (!$emotion->user) {
            $emotion->user()->associate($user);
        }

        return redirect()->route('listar.emotions')->with('message', 'Emoción editada satisfactoriamente');
    }


   
    public function edit($id)
    {
        $emotion = emotion::find($id);

        
        if (!$emotion) {
            return redirect()->route('listar.emotions')->with('error', 'Emoción no encontrada.');
        }

        return view('elementos.edit-emotion', compact('emotion'));
    }

    public function deleteEmotion(Request $request): RedirectResponse
    {
        try {
            $emotion = Emotion::findOrFail($request->input('idemotion'));
            $emotion->delete();
        } catch (\Exception $e) {
            return redirect()->route('listar.emotions')->with('error', 'Error al eliminar la emoción: ' . $e->getMessage());
        }

        return redirect()->route('listar.emotions')->with('message', 'Emoción eliminada satisfactoriamente');
    }
}