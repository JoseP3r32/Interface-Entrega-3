<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    public function index()
    {
        $users = User::all();
        $events = Event::all();
        $hayEvents = $events->where('deleted', '<>', 1)->isNotEmpty();

        return view('elementos.eventos')->with('events', $events)->with('users', $users)->with('hayEvents', $hayEvents);
    }

    public function create()
    {
       
        return view('elementos.create_event');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
                                   
        ]);

        

        $event = new event([
            'name' => $request->name,
            'description' => $request->description,
            
     
        ]);

        $event->user()->associate($user);
        
        $event->save();

        return redirect()->route('listar.events')->with('message', 'Evento creada satisfactoriamente');

    }

  
    public function update(Request $request)
    {
        $event = event::find($request->id);
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            
        ]);

          

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        
        if (!$event->user) {
            $event->user()->associate($user);
        }

        return redirect()->route('listar.events')->with('message', 'Evento editado satisfactoriamente');
    }

   
    public function edit($id)
    {
        $event = event::find($id);

        
        if (!$event) {
            return redirect()->route('listar.events')->with('error', 'Evento no encontrada.');
        }

        return view('elementos.edit-event', compact('event'));
    }

    public function deleteEvent(Request $request): RedirectResponse
    {
        try {
            $event = Event::findOrFail($request->input('idevent'));
            $event->delete();
        } catch (\Exception $e) {
            return redirect()->route('listar.events')->with('error', 'Error al eliminar el evento: ' . $e->getMessage());
        }

        return redirect()->route('listar.events')->with('message', 'Evento eliminado satisfactoriamente');
    }
}
