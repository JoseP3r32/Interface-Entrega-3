<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPdfMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use App\Models\Event;
use App\Models\Emotion;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $user = Auth::user();

                $elements = $this->getElementsForUser($user);

        $pdf = PDF::loadView('pdf.elementsPdf', compact('user', 'elements'));

        return $pdf->stream('user-elements.pdf');
    }

    

    public function getElementsForUser($user)
    {
        // Aquí deberías implementar la lógica para obtener y unificar los elementos de Mood, Event y Emotion
        // Por ejemplo, si quieres combinarlos y ordenarlos por fecha:
        $moods = Mood::where('user_id', $user->id)->get();
        $events = Event::where('user_id', $user->id)->get();
        $emotions = Emotion::where('user_id', $user->id)->get();

        $allElements = $moods->concat($events)->concat($emotions);
        $sortedElements = $allElements->sortBy('date');

        
        return $sortedElements;
    }

   




}