<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use App\Models\Emotion;
use App\Models\Event;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showMoods()
    {
        $moods = Mood::all();
        return view('listar-moods')->with(['moods' => $moods, 'categoria' => 'Moods']);
    }

    public function showEmotions()
    {
        $emotions = Emotion::all();
        return view('listar-emotions')->with(['emotions' => $emotions, 'categoria' => 'Emotions']);
    }

    public function showEvents()
    {
        $events = Event::all();
        return view('listar-events')->with(['events' => $events, 'categoria' => 'Events']);
    }

    public function showAllElement()
{
    $userId = auth()->id();

    $moods = Mood::where('deleted', '<>', 1)->where('user_id', $userId)->get();
    $emotions = Emotion::where('deleted', '<>', 1)->where('user_id', $userId)->get();
    $events = Event::where('deleted', '<>', 1)->where('user_id', $userId)->get();

    $allElements = $moods->concat($emotions)->concat($events);

    $sortedElements = $allElements->sortBy('date');

    $isEmpty = $sortedElements->isEmpty();

    return view('diario', compact('sortedElements', 'isEmpty'));

}

}